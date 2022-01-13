<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
 public function getPath(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
 {
  return $this->getBasePath($media);
 }

 public function getPathForConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
 {
  return $this->getBasePath($media) . 'conversions/';
 }

 public function getPathForResponsiveImages(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
 {
  return $this->getBasePath($media) . 'responsive/';
 }

 public function getBasePath(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
 {
  return $media->model_type . '\\' . $media->model_id . '\\' . $media->collection_name . '\\' . $media->id . '\\';
 }
}