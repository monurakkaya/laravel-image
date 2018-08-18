<form class="dropdown" method="post" action="{{ route('laravel-image::destroy', compact('image')) }}">
    <button data-toggle="dropdown" class="btn btn-raised bg-indigo btn-xs">
        <i class="icon-chevron-down"></i>
    </button>
    <ul class="dropdown-menu">
        @if (!$image->is_default)
            <li>
                <a role="update" href="{{ route('laravel-image::makeDefault', compact('image')) }}">
                    <i class="icon-check2 position-left"></i> <span>@lang('laravel-image.views.make_default')</span>
                </a>
            </li>
        @endif

        <li>
            <a role="destroy">
                <i class="icon-trash position-left"></i> <span>@lang('laravel-image.views.delete')</span>
            </a>
        </li>
    </ul>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

</form>
