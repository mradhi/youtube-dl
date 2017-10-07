# youtube-dl
 Youtube downloader helper for PHP

### Usage:

```php

$youtube = new Mate\Youtube\Youtube([
    'url'      => 'https://www.youtube.com/watch?v=HG713VfiXYAD',
    'filename' => 'test',
    'path'     => '/var/www/html/youtube-dl/mp3'
]);

/** @var Mate\Youtube\Entity\Video $video */
$video = $youtube->download();

echo $video->getFileSize();
echo $video->getTitle();
echo $video->getThumbnail();

// ...

```
