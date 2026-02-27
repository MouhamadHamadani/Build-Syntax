<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    public function optimizeAndStore($image, $path)
    {
        $img = Image::make($image)
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode('webp', 85);
            
        Storage::put($path, $img);
        
        return $path;
    }
}