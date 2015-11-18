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
