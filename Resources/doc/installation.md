Vardius - Security Bundle
======================================

Installation
----------------
1. Download using composer
2. Enable the VardiusSecurityBundle

### 1. Download using composer

Install the package through composer:

``` bash
    $ php composer.phar require vardius/security-bundle:*
```

As in **Symfony 2.8** voters has been simplified a bit more thanks to the new Voter class
For `symfony >=2.6` use version `0.1.*` and from `symfony >=2.8` you can use version `>=0.2`. From `symfony >=0.3` it is a must.

### 2. Enable the VardiusSecurityBundle
Enable the bundle in the kernel:

``` php
    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Vardius\Bundle\SecurityBundle\VardiusSecurityBundle(),
        );
            
        // ...
    }
```

Add to config.yml:

``` yaml
//User entity class (required)
    vardius_security:
        userClass: AppBundle\Entity\User
```
