<?php

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
     public function getPath(): string
    {
        return __DIR__;
    }
}
