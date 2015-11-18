<?php
/**
 * This file is part of the tactic-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vardius\Bundle\SecurityBundle\Security\Authorization\Voter\Type;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Vardius\Bundle\SecurityBundle\Annotation\Reader\OwnerConverter;
use Vardius\Bundle\SecurityBundle\Security\Authorization\Voter\VoterTypeInterface;

/**
 * Class OwnerType
 * @package Vardius\Bundle\SecurityBundle\Security\Authorization\Voter\Type
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class OwnerType implements VoterTypeInterface
{
    /** @var  OwnerConverter */
    protected $converter;

    /**
     * OwnerType constructor.
     * @param OwnerConverter $converter
     */
    public function __construct(OwnerConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @inheritDoc
     */
    public function isGranted($object, $user = null)
    {
        $owners = $this->converter->convert($object);

        if (empty($owners)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        foreach ($owners as $owner) {
            if ($owner !== $user) {
                return VoterInterface::ACCESS_DENIED;
            }
        }

        return VoterInterface::ACCESS_GRANTED;
    }

    /**
     * @inheritDoc
     */
    public function getAttribute()
    {
        return 'isOwner';
    }
}
