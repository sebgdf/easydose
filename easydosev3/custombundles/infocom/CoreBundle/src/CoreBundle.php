<?php

namespace CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CoreBundle extends Bundle
{
     public function getPath(): string
    {
        return __DIR__;
    }
}
