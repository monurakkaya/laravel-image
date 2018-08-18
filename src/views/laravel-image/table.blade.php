<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>@lang('laravel-image.table.actions')</th>
                <th>@lang('laravel-image.table.image')</th>
                <th>@lang('laravel-image.table.created_at')</th>
                <th>@lang('laravel-image.table.is_default')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($model->images as $image)
                <tr>
                    <td>@include('laravel-image::actions', compact('image'))</td>
                    <td>
                        @if ($model->thumbnail !== false)
                            <a href="{{ Storage::url($image->thumbnail) }}" target="_blank">
                                <img src="{{ Storage::url($image->thumbnail) }}" width="100" height="100">
                            </a>
                        @elseif ($model->poster !== false)
                            <a href="{{ Storage::url($image->poster) }}" target="_blank">
                                <img src="{{ Storage::url($image->poster) }}" width="100" height="100">
                            </a>
                        @else
                            @lang('laravel-image.errors.does_not_support')
                        @endif
                    </td>
                    <td>{{ $image->created_at->format('d/m/Y H:i') }}</td>
                    <td><i class="icon-{{ $image->is_default ? 'check2 text-success' : 'cross text-danger' }}"></i></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">@lang('laravel-image.errors.empty')</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
