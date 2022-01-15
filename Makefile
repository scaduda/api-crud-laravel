deploy_dev:
	ls .env >> /dev/null 2>&1 || \cp .env.example .env # apenas substitui caso não exista
	./vendor/bin/sail up
	# docker exec -it crud-laravel sed -i  -e '/profiler/d' -e '/connect_back/d'  -e '/remote_enable/d' /opt/docker/etc/php/php.webdevops.ini
	# docker exec crud-laravel chmod 777 /app/.env
	# docker exec crud-laravel chmod 777 -R /app/storage
	# docker exec crud-laravel chmod 777 -R /app/public
	# docker exec crud-laravel chmod 777 -R /app/storage/logs

