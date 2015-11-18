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

/**
 * Class VoterTypeInterface
 * @package Vardius\Bundle\SecurityBundle\Security\Authorization\Voter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
interface VoterTypeInterface
{
    /**
     * @param $object
     * @param null $user
     * @return bool
     */
    public function isGranted($object, $user = null);

    /**
     * @return string
     */
    public function getAttribute();
}
