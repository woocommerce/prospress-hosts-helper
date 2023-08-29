> IMPORTANT: This code is made available in the hope that it will be useful, but **without any warranty**. See the GNU General Public License included with the code for more details. Automattic or WooCommerce support services are also not available to assist with the use of this code.

# Prospress Hosts Helper

This library provides an easy interface to identify certain known characteristics of managed WP hosts.

## Requirements

This library requires **PHP 5.3+** due to the usage of namespaces.

## Recognized Hosts

There are currently 4 recognized hosting environments:

1. [Pantheon](https://pantheon.io)
1. [SiteGround](https://www.siteground.com)
1. [WP Engine](https://wpengine.com)
1. All other hosts

***Note:** Prospress does not endorse any particular hosting provider.*

## Autoloading

### Composer Autoloader

Before making use of this library, you'll need to initialize [Composer](https://getcomposer.org):

```bash
composer install
```

Your code can then `require` the `vendor/autoloader.php` file to autoload the classes used within this library.

### Custom Autoloader

If you'd prefer not to use Composer for any reason, you can make use of a custom [PSR-4 Autoloader](https://www.php-fig.org/psr/psr-4/). You can write your own, or use an existing one. A good option for an existing autoloader is the one implemented in [WP CLI](https://github.com/wp-cli/wp-cli/blob/master/php/WP_CLI/Autoloader.php). You will then need to register the `Prospress\Hosts` namespace with this library's `src/` directory.

## Usage

To get a class implementation that provides information about the current host, you should use the `Prospress\Hosts\Helper::getHost()` method. This will provide you with a class instance based on the detected hosting environment.

There are currently 2 uses of this library:

1. Determine the script timeout of the current environment.
1. Determine whether database queries of a certain character length are killed. If they are killed, there are methods available for unhooking and re-hooking the killing functionality.

### Script Timeout

To get the script timeout for the current host, you can make use of the `getTimeout()` method:

```php
<?php

use Prospress\Hosts\Helper;

$timeout = Helper::getHost()->getTimeout();
```

The `getTimeout()` method is part of the `Prospress\Hosts\HostInterface` interface. All of the class objects that can be returned by `Helper::getHost()` implement this interface.

### Query Killing

*This only applies to WP Engine*

It is possible to determine if the current host has a query killer in place:

```php
<?php

use Prospress\Hosts\Helper;

$are_queries_killed = Helper::areQueriesKilled();
```

Using the `Helper::areQueriesKilled()` method is safe for all hosting providers, and is the recommended way of determining whether queries are killed in the current environment.

This library also facilitates the circumvention of query killing for plugins that know what they're doing. If the hosting provider has some kind of query killing in place, then the class instance returned by `Helper::getHost()` will implement the `Prospress\Hosts\KillsQueries` interface *in addition to* the `HostInterface` mentioned above. This interface provides 3 methods:

1. `areQueriesKilled()` &ndash; Returns a `bool` value for whether queries are killed or not.
1. `unhookQueryKiller()` &ndash; This will remove the query killer from its hook in WordPress.
1. `rehookQueryKiller()` &ndash; This will add the query killer code back to its hook in WordPress.

These helper methods are intended to allow a developer to selectively remove the query killer. Specifically, the query killer should be removed **immediately before** your database query, and then added back again **immediately after** your query is complete. Here's an example of what that might look like:

```php
<?php

use Prospress\Hosts\Helper;

global $wpdb;

if ( Helper::areQueriesKilled() ) {
    Helper::getHost()->unhookQueryKiller();
}

$result = $wpdb->query(/* your long query here */);

if ( Helper::areQueriesKilled() ) {
    Helper::getHost()->rehookQueryKiller();
}
```

<hr>
<p align="center">
<img src="https://cloud.githubusercontent.com/assets/235523/11986380/bb6a0958-a983-11e5-8e9b-b9781d37c64a.png" width="160">
</p>
