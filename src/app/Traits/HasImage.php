<?php
namespace Monurakkaya\LaravelImage\Traits;

use claviska\SimpleImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Monurakkaya\LaravelImage\Models\Image;

trait HasImage
{

    /*
     * Directory name that files to be stored
     */
    protected $directory = 'images';

    /*
     * Image quality
     */
    protected $quality = 100;

    /*
     * Dimensions for poster image
     */
    protected $poster = [
        'width' => 1920,
        'height' => 1080
    ];

    /*
     * Dimensions for thumbnail
     */
    protected $thumbnail = [
        'width' => 450,
        'height' => 300
    ];



    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function defaultImage()
    {
        return $this->morphOne(Image::class, 'imageable')->orderBy('is_default', desc);
    }

    public function makeDefault(Image $image)
    {
        $this->images()->update([
            'is_default' => false
        ]);

        $image->is_default = true;
        $image->save();
    }

    public function deleteImage(Image $image)
    {
        if (Storage::exists($image->thumb)) {
            Storage::delete($image->thumb);
        }

        if (Storage::exists($image->poster)) {
            Storage::delete($image->poster);
        }
    }

    public function uploadImages($images)
    {
        if (!is_array($images)) {
            $images = [$images];
        }
        foreach ($images as $uploaded_image) {
            $image = new Image();
            $image->imageable()->associate($this);
            $image->is_default = false;
            try {
                $file = new SimpleImage($uploaded_image);
                if ($this->poster !== false) {
                    $poster = clone $file;
                    $poster->bestFit($this->poster['width'], $this->poster['height']);
                    $path = $this->directory . DIRECTORY_SEPARATOR . 'posters' . DIRECTORY_SEPARATOR. date('Y/m/d');
                    $filename = uniqid().'.jpg';
                    Storage::put($path . DIRECTORY_SEPARATOR . $filename, $file->toString(null, $this->quality));
                    $image->poster = $path . DIRECTORY_SEPARATOR . $filename;
                }

                if ($this->thumbnail !== false) {
                    $thumbnail = clone $file;
                    $thumbnail->bestFit($this->thumbnail['width'], $this->thumbnail['height']);
                    $path = $this->directory . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR. date('Y/m/d');
                    $filename = uniqid().'.jpg';
                    Storage::put($path . DIRECTORY_SEPARATOR . $filename, $file->toString(null, $this->quality));
                    $image->thumbnail = $path . DIRECTORY_SEPARATOR . $filename;
                }
                $image->save();
            }catch (\Exception $exception) {
                continue;
            }
        }
    }


}
