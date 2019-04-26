start:
	docker-compose up -d

stop:
	docker-compose stop

destroy:
	docker-compose down

craft-setup: start
	docker-compose -f docker-compose.yml exec web sh -c "php craft setup"

craft-install-api: start
	docker-compose -f docker-compose.yml exec web sh -c "php craft install/plugin restful"