<h1 align="center"> oauth </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require cblink-service/oauth -vvv
```


## Configure

config/services.php

```php
return [
    // ...
    
    // add
    'service-oauth' => [
        'base_url' => '',
        'token' => ''
    ]
];
```

config/auth.php
```php
<?php
return [
    'guards' => [
        // ...

        // add
        'service' => [
            'driver' => 'service'
        ]
    ]
];
```


## Usage

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cblink-service/oauth/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cblink-service/oauth/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT