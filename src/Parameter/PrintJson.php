<?php


namespace Mate\Youtube\Parameter;


class PrintJson extends Parameter
{
    public static function key(): string
    {
        return 'print-json';
    }

    public function value()
    {
        return false;
    }
}