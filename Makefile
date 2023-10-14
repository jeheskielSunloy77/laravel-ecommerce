start:
	./vendor/bin/sail up

stop:
	./vendor/bin/sail down

cli:
	docker exec -it $$(docker ps | grep "sail-8.2/app" | awk '{print $$1}') /bin/bash