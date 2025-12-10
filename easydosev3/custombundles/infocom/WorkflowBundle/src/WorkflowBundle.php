<?php

namespace WorkflowBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WorkflowBundle extends Bundle
{
     public function getPath(): string
    {
        return __DIR__;
    }
}
