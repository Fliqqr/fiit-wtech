db:
	php artisan db:wipe
	php artisan migrate
	php artisan db:seed

dev: db
	npm install && npm run build
	composer run dev