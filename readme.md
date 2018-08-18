## Installation

`composer require monurakkaya/laravel-image`

## Configuration

```
php artisan vendor:publish --tag=laravel-image
php artisan migrate
```

It will create the imageables table. 

## Usage

Change 

`use Illuminate\Database\Eloquent\Model;`  line to

`use Monurakkaya\LaravelImage\Support\Image as Model;` 

Then in your model :

`$model->uploadImages($request->file('input_name'))` 

If you want to remove images after model has been deleted, simply add 

`Model::observe(Monurakkaya\LaravelImage\Observers\ImageObserver)`

in your 

`app/Providers/AppServiceProvider.php` boot method

```php
    public function boot()
    {
        Model::observe(Monurakkaya\LaravelImage\Observers\ImageObserver);
    }
```


## Configuration

There is two type of images thumbnail, poster. 

Default, poster dimensions 1920x1080 and thumbnail 450x300.

If you want to change these dimensions simply add public properties to your related model 

```php
    class Gallery extends Model {
    
        protected $poster = [
            'width' => 800,
            'height' => 800 
        ];
        
        protected $thumbnail = false; // Package won't generate a thumbnail for uploaded images.
    }
```

## Querying

Images Collection
```php
    $gallery = Gallery::with('images')->first();
    $gallery->images; //returns image collection.
```

Make Default Image
```php
    $image = $gallery->images()->first();
    $gallery->makeDefault($image);
```

Get Default Image
```php
    $gallery = Gallery::with('defaultImage')->first();
    $gallery->defaultImage; //returns image model
```
Delete an Image
```php
    $gallery->removeImage($image)
```


## Component
This package comes with built in image management panel. It can be useable with `@laravel-image` component

```php
    @laravel-image([
        'model' => $gallery
    ])@endlaravelimage
```

(Requires bootstrap3)

Here is a screenshot 

![component](http://monurakkaya.com/laravel-image/component.png)

## Translation

Refer to `/resources/lang/en/laravel-image.php`
