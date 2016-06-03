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

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter as BaseVoter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Voter
 * @package Vardius\Bundle\SecurityBundle\Security\Authorization\Voter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class Voter extends BaseVoter
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
    public function __construct(VoterTypePool $typesPool, SupportedClassPool $classesPool, string $userClass)
    {
        $this->typesPool = $typesPool;
        $this->classesPool = $classesPool;
        $this->userClass = $userClass;
    }

    /**
     * @inheritDoc
     */
    public function supports($attribute, $subject):bool
    {
        $supportedClass = $this->classesPool->getClasses();
        $attributes = $this->typesPool->getTypes()->getKeys();

        return $subject instanceof $supportedClass && in_array($attribute, $attributes);
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute($attribute, $object, TokenInterface $token):bool
    {
        $user = $token->getUser();

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
