<?php


namespace Mate\Youtube\Parameter;

class ExtractAudio extends Parameter
{
    public static function key(): string
    {
        return 'extract-audio';
    }

    public function value()
    {
        return false;
    }
}