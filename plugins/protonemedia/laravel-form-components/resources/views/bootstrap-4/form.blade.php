<form {{ env('APP_SPA') && $spa ? 'hx-boost=true hx-target=#content' : '' }} action="{{ $action }}"
    method="{{ $spoofMethod ? 'POST' : $method }}" {!! $attributes->merge([
        'class' => $hasError() ? 'form-submit needs-validation' : 'form-submit needs-validation',
    ]) !!} @if ($upload) enctype="multipart/form-data" @endif>

    @unless(in_array($method, ['HEAD', 'GET', 'OPTIONS']))
    @csrf
    @endunless

    @if($spoofMethod)
    @method($method)
    @endif

    <div class="page-action">
        <h5 class="action-container">
            <div class="button">
                @yield('action')
            </div>
        </h5>
    </div>

    {!! $slot !!}

    @once
        @push('footer')
            @stack('javascript')
        @endpush
    @endonce

</form>
