<?php

namespace Monurakkaya\LaravelImage\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'imageables';

    protected $casts = [
        'is_default' => 'boolean'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
