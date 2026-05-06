.PHONY: up down shell

up:
	docker compose up -d --build

down:
	docker compose down

shell:
	docker compose exec -it development /bin/sh