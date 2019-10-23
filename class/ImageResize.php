<?php

class ImageResize
{
    private $filename;
    private $image;
    private $imageInfo;

    public function __construct($filename)
    {
        if (file_exists($filename)) {
            $this->filename = $filename;
            $this->imageInfo = getimagesize($this->filename);
        } else {
            return false;
        }
    }

    public function load()
    {
        if ($this->getImageType() == 'image/jpeg') {
            $this->image = imagecreatefromjpeg($this->filename);
        }

        if ($this->getImageType() == 'image/png') {
            $this->image = imagecreatefrompng($this->filename);
        }
    }

    public function save($newFileName, $permissions = null)
    {
        if ($this->getImageType() == 'image/jpeg') {
            imagejpeg($this->image, $newFileName);
        }

        if ($this->getImageType() == 'image/png') {
            imagepng($this->image, $newFileName);
        }

        if ($permissions != null) {
            chmod($this->filename, $permissions);
        }

        return $newFileName;
    }

    public function scaleAndCropWidth($width, $height)
    {
        $this->resize($height, $height);
        $this->crop($width, $height);
    }

    public function scaleAndCropHeight($width, $height)
    {
        $this->resize($width, $width);
        $this->crop($width, $height);
    }

    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getHeight() * $ratio;
        $this->resize($width, $height);
    }

    public function scale($scale)
    {
        $width = $this->getWidth() * $scale/100;
        $height = $this->getheight() * $scale/100;
        $this->resize($width, $height);
    }

    private function crop($width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopy($newImage, $this->image, 0, 0, 0, 0, $this->getWidth(), $this->getHeight());
        $this->image = $newImage;
    }

    private function resize($width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $newImage;
    }

    private function getImageType()
    {
        return $this->imageInfo['mime'];
    }

    private function getWidth()
    {
        return $this->imageInfo[0];
    }

    private function getHeight()
    {
        return $this->imageInfo[1];
    }
}