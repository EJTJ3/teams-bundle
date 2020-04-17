# EJTJ3TeamsBundle

Symfony bundle integration of the [ejtj3/teams](https://github.com/ejtj3/teams) library.

## Documentation

All the how to manipulate the Teams client is on the [EJTJ3/teams documentation](https://github.com/ejtj3/teams#create-a-simple-card).

## Prerequisites

This version of the project requires:
* PHP 7.2+
* Symfony 3.4+

## Installation

First of all, you need to require this library through composer:

``` bash
$ composer require ejtj3/teams-bundle
```

Then, enable the bundle on the `AppKernel` class:

``` php
// config/bundles.php

<?php

return [
    EJTJ3\TeamsBundle\EJTJ3TeamsBundle::class => ['dev' => true, 'test' => true],
];

```

## Configuration


Configure the bundle to your needs:

```yaml
ejtj3_teams:
    endpoint: 'https://...'
```


## Usage
The Teams client instance can be retrieved from the `ejtj3_teams.client` service.

Here is an example:

```php
<?php

declare(strict_types=1);

namespace App\Controller;

use EJTJ3\Teams\Card;
use EJTJ3\Teams\Client;
use EJTJ3\Teams\Exception\InvalidPayloadWebHookException;
use Symfony\Component\HttpFoundation\Response;

class TestController
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index(): Response
    {
        $card = new Card('Hello teams!');

        try {
            $this->client->send($card);
        } catch (InvalidPayloadWebHookException $e) {
            return new Response($e->getMessage());
        }

        
        return new Response('Card has been send');
    }
}
```

All the how to manipulate the Teams client is on the [EJTJ3/teams documentation](https://github.com/ejtj3/teams#create-a-simple-card).