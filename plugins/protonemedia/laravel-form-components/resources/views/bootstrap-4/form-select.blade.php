<div class="form-group {{ $col }} {{ $errors->has($name) ? 'has-error' : '' }}">
    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />

    @if((!empty($prepend) or !empty($append)))
    <div class="input-group">
    @endif

    @if(!empty($prepend))
        <label class="input-group-text" for="{{ $id }}">{{ __($prepend) }}</label>
    @endif

    <select
        @if($isWired())
            wire:model{!! $wireModifier() !!}="{{ $name }}"
        @endif

        name="{{ $name }}"

        @if($multiple)
            multiple
        @endif

        data-placeholder="{{ $placeholder }}"

        @if($label && !$attributes->get('id'))
            id="{{ $id() }}"
        @endif

        @php
        $class = 'form-control';
        if($api){
            $class = $class.' '.$api;
        }
        if($search){
            $class = $class.' search';
        }
        @endphp

        {!! $attributes->merge([
            'class' => $class,
        ]) !!}>

        @if($placeholder)
        <option value="">
            {{ $placeholder ?? '- Silahkan Pilih -' }}
        </option>
        @endif

        @forelse($options as $key => $option)
            <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>
                {{ $option }}
            </option>
        @empty
            {!! $slot !!}
        @endforelse
    </select>

    @if(!empty($append))
        <label class="input-group-text" for="{{ $id }}">{{ __($append) }}</label>
    @endif

	@if((!empty($prepend) or !empty($append)))
	</div>
	@endif

    {!! $help ?? null !!}

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif

    @if($api)
    @push('javascript')
        <script>
            $(".{{ $api }}").select2({
                ajax: {
                    dataType: 'json',
                    allowClear: true,
                    minimumResultsForSearch: Infinity,
                    url: "{{ route($api) }}",
                    delay: 300,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });
        </script>
    @endpush
    @endif

</div>