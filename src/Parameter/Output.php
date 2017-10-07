<?php


namespace Mate\Youtube\Parameter;


class Output extends Parameter
{
    protected $value;

    public function __construct($value = '/')
    {
        $this->value = sprintf('"%s', $value) . '.%(ext)s"';
    }

    public static function key(): string
    {
        return 'output';
    }

    public function value()
    {
        return $this->value;
    }
}