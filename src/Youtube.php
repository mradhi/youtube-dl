<?php


namespace Mate\Youtube;

use Mate\Youtube\Entity\Video;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Youtube
{
    protected $options;

    protected $path;

    protected $filename;

    public function __construct( array $options = array() )
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    private function configureOptions( OptionsResolver $resolver ): void
    {
        $resolver->setDefaults([
            'name'       => 'youtube-dl',
            'url'        => null,
            'filename'   => '',
            'path'       => '',
            'parameters' => [
                'audio-format'  => 'mp3',
                'extract-audio' => true,
                'output'        => '/var/www/html/youtube-dl/uploads/test',
                'audio-quality' => 6,
                'quiet'         => true,
                'print-json'    => true,
                'no-warning'    => true,
                'no-call-home'  => true
            ]
        ]);
    }

    public function download(): Video
    {
        $command = $this->generateCommand();
        $process = new Process($command);
        $process->run();


        if ( !$process->isSuccessful() ) {
            throw new ProcessFailedException($process);
        }

        $videoData = json_decode($process->getOutput(), true);

        return new Video($videoData);
    }

    private function generateCommand(): string
    {
        $parameters = $this->options['parameters'];
        $url        = Helper::ExtractID($this->options['url']);

        $parameters['output'] = $this->options['path'] . DIRECTORY_SEPARATOR . $this->options['filename'];

        $command = new Command($this->options['name'], $url, $parameters);

        return $command->render();
    }

    public function get( $option )
    {
        return $this->options[ $option ];
    }
}