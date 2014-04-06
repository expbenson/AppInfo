AppInfo
=======

Read information from App package.

Installation
------------
### Using composer

```js
{
    "require": {
    	"rodneyrehm/plist": "dev-master",
        "tufanbarisyildirim/php-apk-parser": "dev-master",
        "expbenson/app-info": "dev-master"
    }
}
```

### Usage

```php
// Test 1
$app = Expbenson\AppInfo\AppFactory::Create('test.apk');

echo sprintf(
	"Name:\t%s\nVersion:\t%s\nVersionCode:\t%s\n",
	$app->getName(),
	$app->getVersion(),
	$app->getVersionCode()
);
// Test 2
$ipa = Expbenson\AppInfo\IosApp('ios.ipa');
echo sprintf(
	"Name:\t%s\nVersion:\t%s\nVersionCode:\t%s\n",
	$app->getName(),
	$app->getVersion(),
	$app->getVersionCode()
);
```


