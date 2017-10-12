<?php


namespace Mate\Youtube\Parameter;

class EmbedThumbnail extends Parameter {

	public static function key(): string
	{
		return 'embed-thumbnail';
	}

	public function value()
	{
		return false;
	}
}
