# Testing Data

## run the following command to get the right relation between testing data

```
$ php artisan migrate:fresh && php artisan db:seed --class=CharacterlevelSeeder && php artisan db:seed --class=CharactertypeSeeder && php artisan migrate --seed 
``` 

### order is molto importante! :)