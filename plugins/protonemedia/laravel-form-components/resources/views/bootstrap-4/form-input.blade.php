@php
$class = 'form-control';
@endphp

<div class="@if($type === 'hidden') d-none @else form-group @endif{{ $col }} {{ $errors->has($name) ? 'has-error' : '' }}">
    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />

    @if(!empty($prepend) or !empty($append) or !empty($button) or !empty($icon) or !empty($toggle))
        <div class="input-group">
    @endif

    @if(!empty($prepend))
        <span class="input-group-text">
            {!! $prepend !!}
        </span>
    @endif

    @if(!empty($toggle))
        <span class="input-group-text filter cursor">{{ __($toggle) }}</span>
    @endif

    <input

    {!! $attributes->merge(['class' => $class]) !!}

    type="{{ $type }}"

    @if($isWired())
        wire:model{!! $wireModifier() !!}="{{ $name }}"
    @else
        value="{{ $type == 'password' ? '' : $value }}"
    @endif

    name="{{ $name }}"

    @if(!empty($placeholder))
        placeholder="{{ $placeholder }}"
    @endif

    @if($label && !$attributes->get('id'))
        id="{{ $id() }}"
    @endif
    />

    @if(!empty($append))
        <div class="input-group-text">
            {!! $append !!}
        </div>
    @endif

    @if(!empty($button))
        <button class="btn btn-default" type="submit">{{ __($button) }}</button>
    @endif

    @if(!empty($icon))
        <button class="btn btn-default" type="submit">
            <i class="bi bi-{{ $icon }}"></i>
        </button>
    @endif

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif

    @if(!empty($prepend) or !empty($append) or !empty($button) or !empty($icon))
        </div>
    @endif

{!! $help ?? null !!}

</div>
