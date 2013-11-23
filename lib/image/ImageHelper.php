<?php

class ImageHelper
{
	public function createThumbnail($imagePath, $width=250, $height=250, $thumbnailPath = null)
	{
		if ($thumbnailPath == null)
		{
			$thumbnailPath = $imagePath;
		}
		
		self::resizeImage($imagePath, $thumbnailPath, $width, $height);
	}
	
	public function resizeImage($src, $dest, $width, $height)
	{
		$source = imagecreatefromjpeg($src);

		$width_source = imagesx($source);
		$height_source = imagesy($source);		
		$scale = max(array($width_source/$width, $height_source/$height));
		
		$destination = imagecreatetruecolor($width_source/$scale, $height_source/$scale);
		
		$width_destination = imagesx($destination);
		$height_destination = imagesy($destination);

		imagecopyresampled($destination, $source, 0, 0, 0, 0, $width_destination, $height_destination, $width_source, $height_source);

		imagejpeg($destination, $dest);
	}
}

?>