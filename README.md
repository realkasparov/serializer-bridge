Serializer Bridge
=================

## Installation
Serializer uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

The simple following command will install `serializer-bridge` into your project. It also add a new
entry in your `composer.json` and update the `composer.lock` as well.


```bash
composer require fdevs/serializer-bridge
```

## Use with symfony framework

### add bundle to AppKernel

```php
<?php
//app/AppKernel.php
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new FDevs\Bridge\Serializer\FDevsSerializerBundle(),
        ];
    }

}
```

---
Created by [4devs](http://4devs.pro/) - Check out our [blog](http://4devs.io/) for more insight into this and other open-source projects we release.
