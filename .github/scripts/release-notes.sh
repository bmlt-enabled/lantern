#!/usr/bin/env bash
#
# release-notes.sh — extract a CHANGELOG.md section for the current git tag.
#
# Usage:
#   ./.github/scripts/release-notes.sh <tag> [path/to/CHANGELOG.md]
#
# Looks for a section heading of the form `## [<version>]` where <version> is
# the tag with any leading `v` and any pre-release suffix stripped. Writes the
# section body to stdout, with the heading line itself omitted. Stops at the
# next `## [` heading.
#
# Examples:
#   tag "v1.2.0"        → section "## [1.2.0]"
#   tag "1.2.0-beta1"   → section "## [1.2.0]"
#   tag "2025.05.16"    → section "## [2025.05.16]"
#
# Exits non-zero (with a fallback notice on stdout) if the section is missing.

set -euo pipefail

TAG="${1:-${GITHUB_REF_NAME:-}}"
CHANGELOG="${2:-CHANGELOG.md}"

if [[ -z "${TAG}" ]]; then
    echo "usage: $0 <tag> [CHANGELOG.md]" >&2
    exit 2
fi

if [[ ! -f "${CHANGELOG}" ]]; then
    echo "CHANGELOG file not found: ${CHANGELOG}" >&2
    exit 2
fi

# Strip leading "v" and any "-beta…" / "-rc…" suffix to find the base version.
VERSION="${TAG#v}"
BASE="${VERSION%%-*}"

# Escape regex metacharacters (just dots, in practice) for safe interpolation.
ESCAPED="$(printf '%s' "${BASE}" | sed 's/[.[\]]/\\&/g')"

NOTES="$(awk -v ver="${ESCAPED}" '
    /^## \[/ {
        if (found) { exit }
        if ($0 ~ "^## \\[" ver "\\]") { found = 1; next }
        next
    }
    found
' "${CHANGELOG}")"

# Trim leading / trailing blank lines.
NOTES="$(printf '%s\n' "${NOTES}" | awk 'NF{found=1} found' | awk '
    { lines[NR] = $0; last = NR }
    END {
        end = last
        while (end > 0 && lines[end] ~ /^[[:space:]]*$/) { end-- }
        for (i = 1; i <= end; i++) print lines[i]
    }
')"

if [[ -z "${NOTES}" ]]; then
    echo "_No CHANGELOG.md entry found for version \`${BASE}\`. See [CHANGELOG.md](CHANGELOG.md) for the full history._"
    exit 0
fi

printf '%s\n' "${NOTES}"
