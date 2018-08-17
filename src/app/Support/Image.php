<?php
/**
 * Created by PhpStorm.
 * User: monur
 * Date: 17.08.2018
 * Time: 19:52
 */

namespace Monurakkaya\LaravelImage\Support;

use Illuminate\Database\Eloquent\Model;
use Monurakkaya\LaravelImage\Traits\HasImage;

class Image extends Model
{
    use HasImage;
}
