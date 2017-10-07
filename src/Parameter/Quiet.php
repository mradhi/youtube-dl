<?php


namespace Mate\Youtube\Parameter;


class Quiet extends Parameter
{

    public static function key(): string
    {
        return 'quiet';
    }

    public function value()
    {
        return false;
    }
}