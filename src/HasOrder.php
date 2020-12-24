<?php

namespace Ggmm\Model;

trait HasOrder
{
    public function scopeOrdered($query)
    {
        if (isset($this->hasOrder)) {
            if (! is_array($this->hasOrder)) {
                throw new \Exception('Expected hasOrder variable to be an array');
            }
            foreach ($this->hasOrder as $field => $direction) {
                if (is_numeric($field)) {
                    $field = $direction;
                    $direction = 'ASC';
                }
                $query->orderBy($field, $direction);
            }
        }

        return $query;
    }
}
