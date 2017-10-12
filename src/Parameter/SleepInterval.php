<?php


namespace Mate\Youtube\Parameter;


class SleepInterval extends Parameter {

	public static function key(): string
	{
		return 'sleep-interval';
	}

	public function value()
	{
		return 2;
	}
  
}
