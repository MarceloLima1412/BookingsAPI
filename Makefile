up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

build-clean:
	docker-compose build --no-cache --force-rm --compress
