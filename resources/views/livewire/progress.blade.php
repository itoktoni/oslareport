<div>
    @if (!empty($batch) && $pending > 0)

    <div wire:poll class="progress">

        <div class="bar" style="width: {{ $percent }}%"></div>

    </div>

    @endif

</div>