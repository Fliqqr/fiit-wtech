db:
	php artisan db:wipe
	php artisan migrate
	php artisan db:seed

dev: db
	composer run dev