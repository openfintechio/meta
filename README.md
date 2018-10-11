## Openfintech metadata information

This package contains metadata information about images from openfintech.

### Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

var_dump($metadata = \Oft\Provider\Metadata::getResourceMetadata('currencies', 'PPGBP'));
``` 