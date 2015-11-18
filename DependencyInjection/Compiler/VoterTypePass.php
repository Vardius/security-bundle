<?php
/**
 * This file is part of the tactic-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vardius\Bundle\SecurityBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class VoterTypePass
 * @package Vardius\Bundle\SecurityBundle\DependencyInjection\Compiler
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class VoterTypePass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('vardius_security.voter_type_pool')) {
            return;
        }

        $definition = $container->getDefinition(
            'vardius_security.voter_type_pool'
        );

        $types = $container->findTaggedServiceIds(
            'vardius_security.voter_type'
        );
        foreach ($types as $id => $type) {
            $definition->addMethodCall(
                'addType',
                [new Reference($id)]
            );
        }
    }
}
