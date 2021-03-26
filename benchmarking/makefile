TEST_CLIP=example.mp4
MAIN_DIR=..
TEST_CLIP_LONG=example_long.mp4

.PHONY: benchmark-cv-long
benchmark-cv-long: $(MAIN_DIR)/$(TEST_CLIP_LONG)
	cd $(MAIN_DIR);\
	pwd;\
	python3 -m auto_editor $(TEST_CLIP_LONG) --no_open --render opencv

.PHONY: benchmark-av-long
benchmark-av-long: $(MAIN_DIR)/$(TEST_CLIP_LONG)
	cd $(MAIN_DIR);\
	python3 -m auto_editor $(TEST_CLIP_LONG) --no_open --render av

# .PHONY: benchmark-all
# benchmark-all: $(MAIN_DIR)/$(TEST_CLIP) $(MAIN_DIR)/$(TEST_CLIP_LONG)
