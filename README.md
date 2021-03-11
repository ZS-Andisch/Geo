## Credits

This plug-in use [Foxlis Geo API](https://foxlis.com/geo).

## Installation

Require `foxliscom/geo` using composer.

## Usage

```php
use Foxliscom\Geo\FoxlisGeo;

// Get City
echo FoxlisGeo::location()->getCity();

// Get Country
echo FoxlisGeo::location()->getCountry();

// Get Continent
echo FoxlisGeo::location()->getContinent();

// Get Subdivisions List
$subdivisions = FoxlisGeo::location()->getSubdivisions();

// Get Location Data
$locationData = FoxlisGeo::location()->getLocation();

// Get Accuracy Radius
echo $locationData->getAccuracyRadius();

// Get Latitude
echo $locationData->getLatitude();

// Get Longitude
echo $locationData->getLongitude();

// Get Time Zone
echo $locationData->getTimeZone();

// Get Account Info
FoxlisGeo::account()->getData();
```

Multilanguage example:

```php
// Russian
echo FoxlisGeo::location()->getCity()->ru;

// Spanish
echo FoxlisGeo::location()->getCity()->es;

// English
echo FoxlisGeo::location()->getCity()->en;

// German
echo FoxlisGeo::location()->getCity()->de;

// French
echo FoxlisGeo::location()->getCity()->fr;

// Japanese
echo FoxlisGeo::location()->getCity()->ja;

// Portuguese
echo FoxlisGeo::location()->getCity()->ptBR;

// Chinese
echo FoxlisGeo::location()->getCity()->zhCN;
```

## Configuration

If you need to configure this plug-in - declare a global function `getFoxlisGeoConfig` with params like in common config `src/Config/common.php`:

```php
function getFoxlisGeoConfig()
{
    return [
        // Your params here
    ];
}
```
* `foxlis_geo_field_language` - default language `default en`.
    * English `en`
    * Chinese `zh-CN`
    * French `fr`
    * Russian `ru`
    * German `de`
    * Spanish `es`
    * Japanese `ja`
    * Portuguese `pt-BR`
* `foxlis_geo_field_session` - save result to user session `default true`.
* `foxlis_geo_field_bot_filter` - don't detect geo-location for bots `default true`.
* `foxlis_geo_field_protocol` - protocol "http" or "https" `default "http"`.
* `foxlis_geo_field_development_fake_ip_enable` - use fake ip for development `default false`.
* `foxlis_geo_field_development_fake_ip` - fake ip value `default "23.55.115.223"`.
* `foxlis_geo_field_account` - [account key](https://foxlis.com/geo/activation) to get account info.
* `foxlis_geo_bots_list` - bots list (for matching in the `$_SERVER['HTTP_USER_AGENT']`).
