THEME_SLUG := katalyst
DIST_DIR := dist
THEME_DIR := $(DIST_DIR)/$(THEME_SLUG)
ZIP_FILE := $(DIST_DIR)/$(THEME_SLUG).zip

.PHONY: build clean

build: clean
	@mkdir -p "$(THEME_DIR)"
	@tar \
		--exclude='./.git' \
		--exclude='./.github' \
		--exclude='./.agents' \
		--exclude='./.codex' \
		--exclude='./.tokensave' \
		--exclude='./dist' \
		--exclude='./uploads' \
		--exclude='./.DS_Store' \
		--exclude='./Thumbs.db' \
		--exclude='./AGENTS.md' \
		--exclude='./Makefile' \
		--exclude='./KATALYST Landing.html' \
		--exclude='./KATALYST Wireframes.html' \
		-cf - . | tar -xf - -C "$(THEME_DIR)"
	@(cd "$(DIST_DIR)" && zip -qr "$(THEME_SLUG).zip" "$(THEME_SLUG)")
	@echo "Built $(ZIP_FILE)"

clean:
	@rm -rf "$(DIST_DIR)"
