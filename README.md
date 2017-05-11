# sedo-api-client
Library to talk with Sedo API

## Laravel Installation
1. Add this code to your /config/app.php - providers array `SedoClient\SedoServiceProvider::class`
2. Run `php artisan vendor:publish` to publish configuration file, it will be located at /config/sedo.php (Note: You don't need to do this if you don't want to change anything in the configuration file.)
3. Add this to .env file and change them to your credentials

```
SEDO_USERNAME=
SEDO_PASSWORD=
SEDO_PARTNER_ID=
SEDO_SIGN_KEY=
```

### Usage
You can inject the class to your method or use resolve helper
```
Route::get('/inject', function (SedoClient\Sedo $sedo) {
    dd($sedo);
});

Route::get('/inject-domain', function (SedoClient\SedoDomain $sedoDomain) {
    dd($sedoDomain);
});

Route::get('/inject-resolve', function () {
    $sedo = resolve('SedoClient\Sedo');
    dd($sedo);
});
```