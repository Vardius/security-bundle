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

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Voter
 * @package Vardius\Bundle\SecurityBundle\Security\Authorization\Voter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class Voter extends AbstractVoter
{
    /** @var VoterTypePool */
    protected $typesPool;
    /** @var  SupportedClassPool */
    protected $classesPool;
    /** @var  string */
    protected $userClass;

    /**
     * Voter constructor.
     * @param VoterTypePool $typesPool
     * @param SupportedClassPool $classesPool
     * @param string $userClass
     */
    public function __construct(VoterTypePool $typesPool, SupportedClassPool $classesPool, $userClass)
    {
        $this->typesPool = $typesPool;
        $this->classesPool = $classesPool;
        $this->userClass = $userClass;
    }

    /**
     * @inheritDoc
     */
    protected function getSupportedAttributes()
    {
        return $this->typesPool->getTypes()->getKeys();
    }

    /**
     * @inheritDoc
     */
    protected function getSupportedClasses()
    {
        return $this->classesPool->getClasses();
    }

    /**
     * @inheritDoc
     */
    protected function isGranted($attribute, $object, $user = null)
    {
        if (!$user instanceof UserInterface) {
            return false;
        }

        if (!$user instanceof $this->userClass) {
            throw new \LogicException('Security system is not configured properly. The user is not an instance of ' . $this->userClass . ' class!');
        }

        $type = $this->typesPool->getType($attribute);

        return $type->isGranted($object, $user);
    }

}
