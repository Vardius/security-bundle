<?php
/**
 * This file is part of the vardius/security-bundle package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vardius\Bundle\SecurityBundle\Security\Authorization\Voter;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class SupportedClassPool
 * @package Vardius\Bundle\SecurityBundle\Security\Authorization\Voter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class SupportedClassPool
{
    /** @var ArrayCollection */
    protected $classes;

    /**
     * SupportedClassPool constructor.
     */
    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param string $class
     */
    public function addClass($class)
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
        }
    }

    /**
     * @param ArrayCollection $classes
     * @return SupportedClassPool
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
        return $this;
    }

}
