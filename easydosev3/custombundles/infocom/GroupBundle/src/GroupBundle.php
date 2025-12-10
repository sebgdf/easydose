<?php

namespace GroupBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GroupBundle extends Bundle
{
     public function getPath(): string
    {
        return __DIR__;
    }
}
