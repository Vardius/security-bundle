Vardius - Security Bundle
======================================

Configuration
----------------
1. Check the access
2. Register supported class
3. Using Annotations
4. Register custom type

### 1. Check the access
To check if the user has access to a specific object according to your custom conditions (e.g. they must be the owner of the object). You can use `isOwner` rule.

``` php
class DemoController extend Controller
{    
    public function indexAction($product)
    {        
        if(!$product){
            $product = new Product();
        }        
        
        $this->denyAccessUnlessGranted('isOwner', $product, 'Unauthorized access!');
    }
}
```

In case to make it work, you have to do following steps:
 * Register object class for voter (In our case $product)
 * Annotate property which will be used to check if user is owner

### 2. Register supported class
When registering class, it tells Symfony that vardius voter should be called whenever an object of one of the given classes is passed to isGranted().
In case of registering class for vardius security voter inject `vardius_security.voter.supported_class_pool` into your service or controller and add class to the pool

``` php
use Vardius\Bundle\SecurityBundle\Security\Authorization\Voter\SupportedClassPool;

class CustomService
{
    protected $pool;
    
    public function __construct(SupportedClassPool $pool)
    {
        $this->pool = pool;
    }
    
    public function registerClass()
    {
        $this->pool->addClass('AppBundle\Entity\Product'));
    }
}
```

You can do this also in controller before checking access

``` php
class DemoController extend Controller
{    
    public function indexAction($product)
    {
        $pool = $this->get('vardius_security.voter.supported_class_pool');
        $pool->addClass('AppBundle\Entity\Product'));
        
        if(!$product){
            $product = new Product();
        }        
        
        $this->denyAccessUnlessGranted('isOwner', $product, 'Unauthorized access!');
    }
}
```

### 3. Using Annotations
Use annotations to tell vardius-security bundle where the owner is stored in the object. Voter will compare this property value with current user.
You can annotate more then on property and|or methods.

``` php
use Vardius\Bundle\SecurityBundle\Annotation\Owner;

class Product
{
    $name;
    
    /**
     * @Owner()
     */
    $user;
    
    /**
     * @Owner()
     */
    $admin;
    
    $client;
    
    /**
     * @Owner()
     */
    getOwner(){
        return $this->client;
    }
}
```

### 4. Register custom type
There is currently only one voter type available: `isOwner`
You can create more custom voter and register them simple by creating VoterType class and implement VoterTypeInterface

For example we will create a custom voter type that will check if object is private.

``` php
use Vardius\Bundle\SecurityBundle\Security\Authorization\Voter\VoterTypeInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class PrivateType implements VoterTypeInterface
{    
    /**
     * @inheritDoc
     */
    public function isGranted($object, $user = null)
    {
        if($object->isPrivate()){
            return VoterInterface::ACCESS_DENIED;
        }

        return VoterInterface::ACCESS_GRANTED;
    }

    /**
     * @inheritDoc
     */
    public function getAttribute()
    {
        return 'isPrivate';
    }
}
```

Remember that you have to register your type as a service

<service id="app.voter_type.private" class="AppBundle/Voter/PrivateType" public="false">

    <tag name="vardius_security.voter_type" />
</service>