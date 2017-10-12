<?php


namespace Mate\Youtube;

use Mate\Youtube\Parameter\AudioFormat;
use Mate\Youtube\Parameter\AudioQuality;
use Mate\Youtube\Parameter\EmbedThumbnail;
use Mate\Youtube\Parameter\ExtractAudio;
use Mate\Youtube\Parameter\NoCallHome;
use Mate\Youtube\Parameter\NoPart;
use Mate\Youtube\Parameter\NoWarning;
use Mate\Youtube\Parameter\Output;
use Mate\Youtube\Parameter\PrintJson;
use Mate\Youtube\Parameter\Quiet;
use Mate\Youtube\Parameter\SleepInterval;

class Command
{
    protected $name;

    protected $url;

    protected $parameters = array();

    public function __construct( $name, $url, $parameters )
    {
        $this->name = $name;
        $this->url = $url;
        $this->parameters = $parameters;
    }

    public function render(): string
    {
        $commands = [ $this->name ];

        foreach ($this->parameters as $key => $value) {

            if ( array_key_exists($key, self::availableParameters()) ) {
                $parameterClass = self::availableParameters()[ $key ];

                if ( is_bool($value) ) {
                    if ( !$value ) {
                        continue;
                    }

                    $commands[] = ( new $parameterClass() )->render();
                    continue;

                }

                $commands[] = ( new $parameterClass($value) )->render();
            }
        }

        $preCommand = implode(' ', $commands);

        return sprintf('%s "%s"', $preCommand, $this->url);
    }

	public static function availableParameters(): array
	{
		return [
			'audio-format'   => AudioFormat::class,
			'audio-quality'  => AudioQuality::class,
			'extract-audio'  => ExtractAudio::class,
			'no-call-home'   => NoCallHome::class,
			'no-warning'     => NoWarning::class,
			'output'         => Output::class,
			'print-json'     => PrintJson::class,
			'quiet'          => Quiet::class,
			'sleep-interval' => SleepInterval::class,
			'embedThumbnail' => EmbedThumbnail::class,
			'no-part'        => NoPart::class
		];
	}
}
