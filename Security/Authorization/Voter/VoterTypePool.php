<?php
/**
 * This file is part of the tactic-api package.
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
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param VoterTypeInterface $type
     */
    public function addType(VoterTypeInterface $type)
    {
        $this->types->set($type->getAttribute(), $type);
    }

    /**
     * @param string $id
     * @return VoterTypeInterface
     */
    public function getType($id)
    {
        return $this->types->get($id);
    }

}