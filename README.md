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

## Configuration

Declare a global function `getFoxlisGeoConfig` with params like in common config `src/Config/common.php`:

```php
function getFoxlisGeoConfig()
{
    return [
        // Your params here
    ];
}
```

* foxlis_geo_field_session - save result to user session.
* foxlis_geo_field_bot_filter - don't detect geo-location for bots.
* foxlis_geo_field_protocol - protocol "http" or "https".
* foxlis_geo_field_development_fake_ip_enable - use fake ip for development.
* foxlis_geo_field_development_fake_ip - fake ip value.
* foxlis_geo_field_account - [account key](https://foxlis.com/geo/activation) to get account info.
* foxlis_geo_bots_list - bots list (for matching in the `$_SERVER['HTTP_USER_AGENT']`).
