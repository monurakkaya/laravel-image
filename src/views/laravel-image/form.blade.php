<form method="post"
      action="{{ route('laravel-image::upload', ['imageable_type' => get_class($model), 'imageable_id' => $model->id]) }}"
      enctype="multipart/form-data">
    <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
        <label><strong>@lang('laravel-image.views.new_images')</strong></label>
        <input type="file" multiple required name="images[]" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">@lang('laravel-image.views.save')</button>
        {{ csrf_field() }}
    </div>
</form>
