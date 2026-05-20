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
		wp rewrite structure "/%postname%/" --hard >/dev/null; \
		wp theme activate $(THEME_SLUG); \
		for p in crumb mayo bread fetch-meditation nacc bmlt-workflow; do \
			if [ -d wp-content/plugins/$$p ]; then wp plugin activate $$p || true; fi; \
		done; \
		for slug in home meetings events cleantime daily-meditation helpline public members about newcomer for-families professionals literature minutes subcommittees meeting-changes service-guides meeting-list; do \
			id=$$(wp post list --post_type=page --name=$$slug --field=ID); \
			if [ -z "$$id" ]; then \
				title=$$(echo $$slug | tr "-" " " | awk "{for(i=1;i<=NF;i++) \$$i=toupper(substr(\$$i,1,1)) substr(\$$i,2)}1"); \
				id=$$(wp post create --post_type=page --post_status=publish --post_title="$$title" --post_name=$$slug --porcelain); \
			fi; \
			case $$slug in \
				meetings)         tpl="page-templates/meeting-finder.php" ;; \
				events)           tpl="page-templates/events.php" ;; \
				cleantime)        tpl="page-templates/cleantime.php" ;; \
				daily-meditation) tpl="page-templates/meditation.php" ;; \
				helpline)         tpl="page-templates/helpline.php" ;; \
				public)           tpl="page-templates/for-public.php" ;; \
				members)          tpl="page-templates/for-members.php" ;; \
				*)                tpl="" ;; \
			esac; \
			if [ -n "$$tpl" ]; then wp post meta update $$id _wp_page_template $$tpl >/dev/null; fi; \
		done; \
		for slot in meeting_finder:meetings about:about newcomer:newcomer helpline:helpline cleantime:cleantime meditation:daily-meditation events:events public:public members:members families:for-families professionals:professionals literature:literature minutes:minutes subcommittees:subcommittees meeting_changes:meeting-changes service_guides:service-guides; do \
			key=$${slot%%:*}; pslug=$${slot##*:}; \
			pid=$$(wp post list --post_type=page --name=$$pslug --field=ID); \
			if [ -n "$$pid" ]; then wp theme mod set lantern_link_$$key $$pid >/dev/null; fi; \
		done; \
		home_id=$$(wp post list --post_type=page --name=home --field=ID); \
		wp option update show_on_front page; \
		wp option update page_on_front $$home_id; \
		echo "Done. Open http://localhost:8080  (admin / admin)"'

.PHONY: open
open:  ## Open the site in a browser
	@command -v open >/dev/null && open http://localhost:8080 || echo "Visit http://localhost:8080"
