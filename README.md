WordPress<span>.</span>org API Client
=========================

Client for retrieving information from the WordPress<span>.</span>org API. Documentation for the WordPress<span>.</span>org API is located [here](https://codex.wordpress.org/WordPress.org_API).

<br />

Installation
------------

```
composer require camrymps/wordpress.org-api
```

<br />

Getting Started
-----

```php
use camrymps/WordpressOrgAPI/WordPress as WordPressClient;

$client = new WordPressClient;
$client = new WordPressClient(true); // Returns all responses as associative arrays (optional)
```

<br />

Usage
-------

`checkVersion()`

Returns information on currently supported Wordpress versions.

```php
$client->checkVersion();
```

<br />

`searchThemes([$params])`

Returns a list of themes with their associated information.

```php
$client->searchThemes();
```
```php
$client->searchThemes([
    "search" => "foo",
    "fields" => [
        "description" => true
    ]
]);
```

<br />

`getTheme($slug[, $params])`

Returns information about a specific theme.

```php
$client->getTheme("twentyseventeen");
```
```php
$client->getTheme("twentyseventeen", [
    "fields" => [
        "description" => true
    ]
]);
```

<br />

`getHotThemeTags([$params])`

Returns a list of the most popular theme tags.

```php
$client->getHotThemeTags()
```
```php
$client->getHotThemeTags([
    "number" => 10
]);
```

<br />

`getThemeFeatureList()`

Returns a list of valid theme tags.

```php
$client->getThemeFeatureList();
```

<br />

`searchPlugins([$params])`

Returns a list of plugins with their associated information.

```php
$client->searchPlugins();
```
```php
$client->searchPlugins([
    "search" => "foo",
    "fields" => [
        "description" => true
    ]
]);
```

<br />

`getPlugin($slug[, $params])`

Returns information about a specific plugin.

```php
$client->getPlugin("jetpack");
```
```php
$client->getPlugin("jetpack", [
    "fields" => [
        "description" => true
    ]
]);
```

<br />

`getHotPluginTags([$params])`

Returns a list of the most popular plugin tags.

```php
$client->getHotPluginTags();
```
```php
$client->getHotPluginTags([
    "number" => 10
]);
```

<br />

`getPopularImportPlugins()`

Returns a list of popular import plugins in the WordPress Plugin Directory.

```php
$client->getPopularImportPlugins();
```

<br />

Parameters
----------

For an in-depth list of parameters that can be used with the methods above, please refer to the Wordpress<span>.</span>org API located [here](https://codex.wordpress.org/WordPress.org_API).

<br />

Async
-----

All methods can be used asynchronously simply by adding "Async" to the end of the method name. For example:

```php
$promise = $client->getThemeAsync("twentyseventeen");

$promise->then(
    function($theme) {
        var_dump($theme);
    }
);
```