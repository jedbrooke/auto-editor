TEST_CLIP=example.mp4
MAIN_DIR=..
TEST_CLIP_LONG=example_long.mp4

.PHONY: benchmark-cv-long
benchmark-cv-long: $(MAIN_DIR)/$(TEST_CLIP_LONG)
	cd $(MAIN_DIR);\
	pwd;\
	python3 -m auto_editor $(TEST_CLIP_LONG) --no_open --render opencv

.PHONY: benchmark-cv-short
benchmark-cv-short: $(MAIN_DIR)/$(TEST_CLIP)
	cd $(MAIN_DIR);\
	pwd;\
	python3 -m auto_editor $(TEST_CLIP) --no_open --render opencv

.PHONY: benchmark-av-long
benchmark-av-long: $(MAIN_DIR)/$(TEST_CLIP_LONG)
	cd $(MAIN_DIR);\
	python3 -m auto_editor $(TEST_CLIP_LONG) --no_open --render av --video_codec libx264

.PHONY: benchmark-av-short
benchmark-av-short: $(MAIN_DIR)/$(TEST_CLIP)
	cd $(MAIN_DIR);\
	python3 -m auto_editor $(TEST_CLIP) --no_open --render av --video_codec libx264

.PHONY: benchmark-auto-long
benchmark-auto-long: $(MAIN_DIR)/$(TEST_CLIP_LONG)
	cd $(MAIN_DIR);\
	python3 -m auto_editor $(TEST_CLIP_LONG) --no_open --render auto --video_codec libx264

.PHONY: benchmark-auto-short
benchmark-auto-short: $(MAIN_DIR)/$(TEST_CLIP)
	cd $(MAIN_DIR);\
	python3 -m auto_editor $(TEST_CLIP) --no_open --render auto

.PHONY: benchmark-all-long
benchmark-all-long: $(MAIN_DIR)/$(TEST_CLIP_LONG)
	python3 monitor_cpu.py "make benchmark-cv-long"
	mv usage.png cv-long.png
	python3 monitor_cpu.py "make benchmark-av-long"
	mv usage.png av-long.png
	python3 monitor_cpu.py "make benchmark-auto-long"
	mv usage.png auto-long.png