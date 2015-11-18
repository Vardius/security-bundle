<?php
/**
 * This file is part of the tactic-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vardius\Bundle\SecurityBundle\Annotation\Reader;

use Doctrine\Common\Annotations\AnnotationReader;
use Vardius\Bundle\SecurityBundle\Annotation\Owner;

/**
 * Class OwnerConverter
 * @package Vardius\Bundle\SecurityBundle\Annotation\Reader
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class OwnerConverter
{
    /** @var AnnotationReader */
    protected $reader;
    /** @var string */
    protected $annotationClass = 'Vardius\\Bundle\\SecurityBundle\\Annotation\\Owner';

    /**
     * OwnerConverter constructor.
     * @param AnnotationReader $reader
     */
    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param $object
     * @return array
     */
    public function convert($object)
    {
        $reflectionObject = new \ReflectionObject($object);

        $owners = [];
        foreach ($reflectionObject->getProperties() as $property) {
            /** @var Owner $annotation */
            $annotation = $this->reader->getPropertyAnnotation($property, $this->annotationClass);
            if (null !== $annotation) {
                $owners[] = $annotation->value;
            }
        }

        foreach ($reflectionObject->getMethods() as $method) {
            $annotation = $this->reader->getMethodAnnotation($method, $this->annotationClass);
            if (null !== $annotation) {
                $owners[] = $method->invoke($object);
            }
        }

        return $owners;
    }

}
