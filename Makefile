start:
	docker-compose up -d

cleanBranch:
	git branch --merged | egrep -v "(^\*|main|master|dev)" | xargs git branch -d