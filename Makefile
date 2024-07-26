
#!make

.PHONY: up
up: 
	docker compose -p comerce up

.PHONY: build
build: 
	docker compose -p comerce up --build

.PHONY: down
down: 
	docker compose -p comerce down

.PHONY: prune
prune: 
	docker container prune
	docker volume prune