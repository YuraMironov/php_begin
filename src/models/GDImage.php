<?php 
namespace Models;

class GDImage extends ImageClass
{
   var $image;
   var $image_type;
   var $mime_type;

   public function __construct($filename) 
   {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
         $this->mime_type .= 'image/jpeg';
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
         $this->mime_type .= 'image/gif';
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
         $this->mime_type .= 'image/png';
      }
   }
   public function getMimeType()
   {
      return $this->mime_type;
   }
   public function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) 
   {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   public function output($image_type=IMAGETYPE_JPEG) 
   {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   public function getWidth() 
   {
      return imagesx($this->image);
   }
   public function getHeight() 
   {
      return imagesy($this->image);
   }
   public function cutUpAndDown($center_height)
   {
      $y = ($this->getHeight() - $center_height) / 2;
      $new_image = imagecreatetruecolor($this->getWidth(), $center_height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, $y, $this->getWidth(), $center_height, $this->getWidth(), $center_height);
      $this->image = $new_image;
   }
   public function cutLeftAndRight($center_width)
   {
      $x = ($this->getWidth() - $center_width) / 2;
      $new_image = imagecreatetruecolor($center_width, $this->getHeight());
      imagecopyresampled($new_image, $this->image, 0, 0, $x, 0, $center_width, $this->getHeight(), $center_width, $this->getHeight());
      $this->image = $new_image;
   }
   public function resize($width,$height) 
   {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }
}