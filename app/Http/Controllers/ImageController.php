<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Intervention\Image\Laravel\Facades\Image as ImageIntervention;

class ImageController extends Controller
{
    public function upload(Request $request, int $id)
    {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $newName = 'original_p_img'. '_' . uniqid(). '.' . $ext;
        $destination = 'products';
        // Guardar la imagen en un directorio
        $imagePath = $file->storeAs($destination, $newName);
        $thumbnailPath = $this->thumbnail_webp($file, 300);

        $image = new Image;
        $image->product_id = $id;
        $image->original = $imagePath;
        $image->medium = $imagePath;
        $image->thumbnail = $thumbnailPath;
        $image->save();

        return $image;
    }

    public function thumbnail_webp($path, $width)
    {
        $newName = 'thumbnail_p_img'. '_' . uniqid() . '.webp';
        $destination = 'products/'.$newName;
		$image = ImageIntervention::read($path);

        $image->scale(width:$width);
        // encoding jpeg data
        return $image->toWebp(60)->save($destination);
    }
}
