VERSION = $(shell grep "<version>" component/*.xml|cut  -d ">" -f 2|cut -d "<" -f 1)

zip:
	@echo "Creating zip file for version $(VERSION)"
	@(cd component && zip -r ../attachments-import-$(VERSION).zip *)

all: zip
