<?php


namespace Mate\Youtube\Parameter;


class NoCallHome extends Parameter
{
    public static function key(): string
    {
        return 'no-call-home';
    }

    public function value()
    {
        return false;
    }
}