<?php


namespace Mate\Youtube\Parameter;


class AudioQuality extends Parameter
{
    protected $value;

    public function __construct($value = 6)
    {
        $this->value = $value;
    }

    public static function key(): string
    {
        return 'audio-quality';
    }

    public function value()
    {
        return $this->value;
    }
}