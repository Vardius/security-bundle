<?php

namespace Vardius\Bundle\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vardius\Bundle\SecurityBundle\DependencyInjection\Compiler\VoterTypePass;

class VardiusSecurityBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new VoterTypePass());
    }
}
