# HttpData

HttpData is a simple package for encoding and decoding data to be sent via http requests.

## Installation

### Composer

From the command line, run:

```
composer require datrim/http-data
```

## Usage

### The Basics

With the package now installed, you may use the two classes like so:

### Encoding data (compressed)

```php
<?php

use Datrim\HttpData\HttpDataEncoder;

$data = [
	'name' => 'MyData',
	'value' => 'My data value'
];
```

To encode data compressed (default)

```php
$encoder = new HttpDataEncoder($data);
```

or, if the data should be transmitted uncompressed.

```php
	$encoder = new HttpDataEncoder($data, false);
```

Then to get the encoded data:

```php 	
$encoded Data = $encoder->data();
```

### Decoding data

```php
<?php

use Datrim\HttpData\HttpDataDecoder;

$decoder = new HttpDataDecoder($encodedData);
$decodedData = $decoder->data();
```

That's it!

### License

The HttpData package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
