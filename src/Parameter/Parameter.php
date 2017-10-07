<?php

namespace Mate\Youtube\Parameter;

abstract class Parameter
{
    /**
     * @return string
     */
    abstract public static function key(): string;

    /**
     * @return mixed
     */
    abstract public function value();


    public function render(): string
    {
        if ($this->value()) {
            $value = (string)$this->value();

            return sprintf('--%s %s', $this->key(), $value);
        }

        return sprintf('--%s', $this->key());
    }
}