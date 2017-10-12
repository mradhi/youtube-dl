<?php

namespace Mate\Youtube\Entity;


class Video
{
    protected $data = array();

    protected $options = array();


    public function __construct(array $data = array(), array $options = array())
    {
        $this->data    = $data;
        $this->options = $options;
    }

    /**
     * @return null|string
     */
    public function getTitle(): string
    {
        return $this->data['title'];
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->data['display_id'];
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->data['categories'];
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->data['tags'];
    }

    /**
     * @return null|int
     */
    public function getDislikeCount(): ?int
    {
        return $this->data['dislike_count'];
    }

    /**
     * @return null|int
     */
    public function getLikeCount(): ?int
    {
        return $this->data['like_count'];
    }

    /**
     * @return null|int
     */
    public function getViewCount(): ?int
    {
        return $this->data['view_count'];
    }

    /**
     * @return null|int
     */
    public function getFileSize(): ?int
    {
        return $this->data['filesize'];
    }

    /**
     * @return null|string
     */
    public function getUploader(): ?string
    {
        return $this->data['uploader'];
    }

    /**
     * @return null|string
     */
    public function getUploaderId(): ?string
    {
        return $this->data['uploader_id'];
    }

    /**
     * @return null|string
     */
    public function getThumbnail(): ?string
    {
        return $this->data['thumbnail'];
    }

    public function getShortFileName(): ?string
    {
        return sprintf('%s.%s', $this->options['filename'], $this->getFormat());
    }

    public function getPath(): ?string
    {
        return $this->options['path'];
    }

    public function getFormat(): ?string
    {
        return $this->options['parameters']['audio-format'];
    }

    public function getFileName(): ?string
    {
        return $this->getPath() . DIRECTORY_SEPARATOR . $this->getShortFileName();
    }

    public function getDuration(): ?int
    {
    	return $this->data['duration'];
    }
}
