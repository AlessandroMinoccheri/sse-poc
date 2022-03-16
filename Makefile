up: # Starts the project
	docker-compose up -d
	cd backend && symfony server:start --port=8070 -d

down: # Stops the project
	docker-compose stop
	cd backend && symfony local:server:stop

