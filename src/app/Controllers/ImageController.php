<?php
/**
 * Created by PhpStorm.
 * User: monur
 * Date: 18.08.2018
 * Time: 18:01
 */

namespace Monurakkaya\LaravelImage\Controllers;

use Monurakkaya\LaravelImage\Models\Image;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ImageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function destroy(Image $image)
    {
        $image->delete();
        return redirect(url()->previous());
    }

    public function makeDefault(Image $image)
    {
        $image->imageable->makeDefault($image);
        return redirect(url()->previous());
    }

    public function upload(Request $request)
    {
        try {
            $model = $request->imageable_type::find($request->imageable_id);
            if ($model) {
                $model->uploadImages($request->file('images'));
            } else {
                dd(trans('laravel_image.errors.model_not_found'));
            }
        } catch (\Exception $exception) {
            dd(trans('laravel_image.errors.model_not_found'));
        }
        return redirect()->back();
    }
}
