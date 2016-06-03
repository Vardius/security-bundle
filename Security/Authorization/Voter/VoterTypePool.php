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
 * Class VoterTypePool
 * @package Vardius\Bundle\SecurityBundle\Security\Authorization\Voter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class VoterTypePool
{
    /** @var ArrayCollection */
    protected $types;

    /**
     * VoterTypePool constructor.
     */
    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTypes():ArrayCollection
    {
        return $this->types;
    }

    /**
     * @param VoterTypeInterface $type
     * @return VoterTypePool
     */
    public function addType(VoterTypeInterface $type):self
    {
        $this->types->set($type->getAttribute(), $type);
        return $this;
    }

    /**
     * @param string $id
     * @return VoterTypeInterface
     */
    public function getType(string $id):VoterTypeInterface
    {
        return $this->types->get($id);
    }
}
