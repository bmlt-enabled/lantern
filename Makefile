COMMIT := $(shell git rev-parse --short=8 HEAD 2>/dev/null || echo "dev")
BASENAME := $(shell basename $(PWD))
THEME_SLUG := lantern
ZIP_FILENAME := $(or $(ZIP_FILENAME), $(THEME_SLUG).zip)
BUILD_DIR := $(or $(BUILD_DIR),build)
ZIP_FILE := $(BUILD_DIR)/$(ZIP_FILENAME)

help:  ## Print the help documentation
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

$(ZIP_FILE):
	mkdir -p $(BUILD_DIR)
	cd lantern && zip -r ../$(ZIP_FILE) . -x "*.DS_Store" -x "*.git*"

.PHONY: build
build: $(ZIP_FILE)  ## Build theme zip (build/lantern.zip) ready for upload

.PHONY: clean
clean:  ## Remove build artifacts
	rm -rf $(BUILD_DIR) logs

.PHONY: lint
lint:  ## PHP -l on every theme file
	@find lantern -name "*.php" -print0 | xargs -0 -n1 php -l | grep -v "No syntax errors" || echo "all clean"

.PHONY: dev
dev:  ## Docker compose up (foreground, logs visible)
	docker compose up

.PHONY: up
up:  ## Docker compose up in detached mode
	docker compose up -d

.PHONY: down
down:  ## Docker compose down
	docker compose down

.PHONY: restart
restart: down up  ## Restart the stack

.PHONY: nuke
nuke:  ## Docker compose down including volumes (wipes WordPress install)
	docker compose down -v
	rm -rf logs

.PHONY: logs
logs:  ## Tail container logs
	docker compose logs -f

.PHONY: mysql
mysql:  ## MySQL CLI inside the db container
	docker exec -it $(BASENAME)-db-1 mariadb -u root -psomewordpress wordpress

.PHONY: bash
bash:  ## Bash shell inside the wordpress container
	docker exec -it -w /var/www/html $(BASENAME)-wordpress-1 bash

.PHONY: wp
wp:  ## Run a wp-cli command inside the wordpress container (CMD="plugin list")
	docker exec -it -u www-data -w /var/www/html $(BASENAME)-wordpress-1 wp $(CMD)

.PHONY: install
install:  ## One-shot: install WordPress, activate the theme + BMLT plugins, create pages
	@docker exec -it -u www-data -w /var/www/html $(BASENAME)-wordpress-1 bash -c '\
		wp core is-installed --quiet 2>/dev/null || \
		wp core install \
			--url="http://localhost:8080" \
			--title="Lantern Demo" \
			--admin_user=admin \
			--admin_password=admin \
			--admin_email=admin@example.test \
			--skip-email; \
		wp theme activate $(THEME_SLUG); \
		for p in crumb mayo bread fetch-meditation nacc bmlt-workflow; do \
			if [ -d wp-content/plugins/$$p ]; then wp plugin activate $$p || true; fi; \
		done; \
		for slug in meetings events cleantime daily-meditation helpline public members about newcomer; do \
			wp post exists --post_type=page --field=ID --name=$$slug >/dev/null 2>&1 || \
			wp post create --post_type=page --post_status=publish --post_title="$$(echo $$slug | tr "-" " " | sed -e "s/.*/\u&/")" --post_name=$$slug >/dev/null; \
		done; \
		wp option update show_on_front page; \
		wp option update page_on_front $$(wp post list --post_type=page --name=home --field=ID 2>/dev/null || wp post create --post_type=page --post_status=publish --post_title=Home --post_name=home --porcelain); \
		echo "Done. Open http://localhost:8080  (admin / admin)"'

.PHONY: open
open:  ## Open the site in a browser
	@command -v open >/dev/null && open http://localhost:8080 || echo "Visit http://localhost:8080"
