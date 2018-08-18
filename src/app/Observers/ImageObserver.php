<?php

namespace Monurakkaya\LaravelImage\Observers;

use Illuminate\Database\Eloquent\Model;
use Monurakkaya\LaravelImage\Models\Image;

class ImageObserver
{
    /**
     * Handle to the User "created" event.
     *
     * @param  Model $model
     * @return void
     */
    public function created(Model $model)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  Model $model
     * @return void
     * @return void
     */
    public function updated(Model $model)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  Model $model
     * @return void
     */
    public function deleted(Model $model)
    {
        if ($model instanceof Image) {
            $model->imageable->deleteImage($model);
        } else {
            foreach ($model->images as $image) {
                $model->deleteImage($image);
            }
        }

    }
}
