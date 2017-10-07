<?php


namespace Mate\Youtube\Parameter;


class NoWarning extends Parameter
{
    public static function key(): string
    {
        return 'no-warning';
    }

    public function value()
    {
        return false;
    }
}