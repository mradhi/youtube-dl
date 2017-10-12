<?php


namespace Mate\Youtube\Parameter;


class NoPart extends Parameter {

	public static function key(): string
	{
		return 'no-part';
	}

	public function value()
	{
		return false;
	}
  
}
