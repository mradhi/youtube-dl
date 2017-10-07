<?php


namespace Mate\Youtube\Parameter;


class AudioFormat extends Parameter
{
    protected $value;

    public function __construct($value = 'mp3')
    {
        $this->value = $value;
    }

    public static function key(): string
    {
        return 'audio-format';
    }

    public function value()
    {
        return $this->value;
    }


}