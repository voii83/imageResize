<?php
require_once 'class/Debug.php';
require_once 'class/ImageResize.php';
require_once 'class/FileNameHelper.php';


$path = 'img/image.png';
$newPath = FileNameHelper::getNewFileName($path);
$image = new ImageResize($path);
$image->load();
$image->scale(25);
$img = $image->save($newPath);

?>

<img src="<?= $img ?>" alt="">
