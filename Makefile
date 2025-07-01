DC_LOCAL_FILE=./docker-compose.yml

init:
	cp -n $(APP_DIR)/.env.example $(APP_DIR)/.env || echo ".env already exists"
	docker network create $(NETWORK_NAME) || echo Created
	$(MAKE) build
	docker-compose -f $(DC_LOCAL_FILE) up -d --remove-orphans --force-recreate
	sleep 1
	docker-compose -f $(DC_LOCAL_FILE) exec -T php /bin/bash -c "COMPOSER_MEMORY_LIMIT=-1 composer install --prefer-dist --no-ansi --no-scripts --no-interaction --no-progress"
	docker-compose -f $(DC_LOCAL_FILE) exec -T php /bin/bash -c "php artisan migrate:fresh"
	docker-compose -f $(DC_LOCAL_FILE) exec -T php /bin/bash -c "php artisan db:seed"
	docker-compose -f $(DC_LOCAL_FILE) exec -T php /bin/bash -c "php artisan scribe:generate"

