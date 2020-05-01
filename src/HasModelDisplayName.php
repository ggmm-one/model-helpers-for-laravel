<?php

namespace Ggmm\Model;

use Illuminate\Support\Str;

trait HasModelDisplayName
{
    public function getModelDisplayName() : string
    {
        return __($this->modelDisplayName ?? implode(' ', preg_split('/(?=[A-Z])/', Str::after(get_class($this), '\\'))));
    }
}
