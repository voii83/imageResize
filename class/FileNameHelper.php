<?php

class FileNameHelper
{
    public static function getNewFileName($path)
    {
        $segmentsPath = explode('/', $path);
        $fileName = array_pop($segmentsPath);
        $newFileName = 'resize_' . $fileName;
        array_push($segmentsPath, $newFileName);
        $newPath = implode('/', $segmentsPath);

        return $newPath;
    }
}