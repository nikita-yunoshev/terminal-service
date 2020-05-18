init:
	docker build -t terminal-service . && docker run -d --name terminal-service-container -it terminal-service
start:
	docker start terminal-service-container
stop:
	docker stop terminal-service-container
exec:
	docker exec -it terminal-service-container /bin/bash