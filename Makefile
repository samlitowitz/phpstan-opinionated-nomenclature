DOCKER_SERVICE=php74

check: composer.json
	docker-compose run --rm --entrypoint=composer ${DOCKER_SERVICE} run check
