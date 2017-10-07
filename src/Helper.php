<?php


namespace Mate\Youtube;

use Symfony\Component\Process\Exception\LogicException;

class Helper
{
    public static function ExtractID($url): string
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);

        $videoID = $match[1];

        if (!$videoID) {
            throw new LogicException('Invalid URL');
        }

        return $videoID;
    }

    public static function buildURL($url): string
    {
        $videoID = self::ExtractID($url);

        return sprintf('https://www.youtube.com/watch?v=%s', $videoID);
    }
}