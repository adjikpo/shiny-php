start:
	docker-compose up -d

cleanBranch:
	git branch --merged | egrep -v "(^\*|main|master|dev)" | xargs git branch -d

fix:
	docker run -v $(PWD):/var/www/html/ -w /var/www/html phpqa/php-cs-fixer fix --dry-run www
	