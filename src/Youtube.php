<?php


namespace Mate\Youtube;

use Mate\Youtube\Entity\Video;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class Youtube
{
    protected $options;

    protected $path;

    protected $filename;

    public function __construct( array $options = array() )
    {
        $resolver = new OptionsResolver();
        $this->configureOptions( $resolver );

        $this->options = $resolver->resolve( $options );
    }

    private function configureOptions( OptionsResolver $resolver ): void
    {
        $resolver->setDefaults( [
            'name'       => 'youtube-dl',
            'url'        => null,
            'filename'   => '',
            'path'       => '',
            'parameters' => [
                'audio-format'    => 'mp3',
                'embed-thumbnail' => true,
                'sleep-interval'  => 2,
                'extract-audio'   => true,
                'output'          => '/var/www/html/youtube-dl/uploads/test',
                'audio-quality'   => 6,
                'quiet'           => true,
                'print-json'      => false,
                'no-warning'      => true,
                'no-call-home'    => true,
                'no-part'         => true
            ]
        ] );
    }

    public function download( \Closure $middleware ): Video
    {
        $command = $this->generateCommand();
        $builder = new ProcessBuilder( $this->generateSimulatedParameters() );

        $builder->setPrefix( $this->getCommandPrefix() );

        $simulatedProcess = $builder->getProcess();

        $simulatedProcess->setIdleTimeout( 6000 );
        $simulatedProcess->setTimeout( 6000 );

        $simulatedProcess->run();

        $video = new Video( json_decode( $simulatedProcess->getOutput(), true ), $this->options );

        try {
            $middleware( $video );
        } catch ( \Exception $exception ) {
            throw new \Exception( $exception->getMessage() );
        }

        unset( $builder );

        $process = new Process( $command );

        $process->run();

        return $video;
    }

    private function generateCommand(): string
    {
        $parameters = $this->getParameters();
        $url        = $this->getUrl();

        $parameters[ 'output' ] = $this->options[ 'path' ] . DIRECTORY_SEPARATOR . $this->options[ 'filename' ];

        $command = new Command( $this->getCommandPrefix(), $url, $parameters );

        return $command->render();
    }

    private function generateSimulatedParameters(): array
    {
        $result     = [];
        $parameters = $this->getSimulatedCommandParameters();
        $url        = $this->getUrl();

        foreach ( $parameters as $key => $value ) {
            if ( !$value ) {
                continue;
            }

            $result[] = sprintf( '--%s', $key );
        }

        $result[] = sprintf( '%s', $this->getUrl() );
        $result[] = '-s';

        return $result;
    }


    private function getSimulatedCommandParameters(): array
    {
        return [
            'dump-single-json' => true,
            'quiet'            => true,
            'no-warning'       => true,
            'no-call-home'     => true
        ];
    }

    public function getUrl()
    {
        return Helper::buildURL( $this->options[ 'url' ] );
    }

    public function getCommandPrefix()
    {
        return $this->options[ 'name' ];
    }

    public function getParameters()
    {
        return $this->options[ 'parameters' ];
    }

    public function get( $option )
    {
        return $this->options[ $option ];
    }
}
