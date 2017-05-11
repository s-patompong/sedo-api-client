# sedo-api-client
Library to talk with Sedo API

## Laravel Installation
1. Add this code to your /config/app.php - providers array `SedoClient\SedoServiceProvider::class`
2. Run `php artisan vendor:publish` to publish configuration file, it will be located at /config/sedo.php
3. Add this to .env file

```
SEDO_USERNAME=
SEDO_PASSWORD=
SEDO_PARTNER_ID=
SEDO_SIGN_KEY=
```
