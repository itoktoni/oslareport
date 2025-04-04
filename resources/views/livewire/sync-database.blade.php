<div class="nav-item profile">

    @php
        $syncStatus = Cache::get('sync');
    @endphp

    <div>
        <button wire:click="triggerSync"
            class="btn btn-{{ $syncStatus }} btn-sm mr-2 position-relative"
            {{ $syncStatus === SyncStatusType::Pending ? 'disabled' : '' }}
            >

            <span class="d-inline-flex align-items-center" wire:loading.remove>
                @if ($syncStatus === SyncStatusType::Sync)
                    Synced
                @else
                    Syncronize
                @endif
            </span>

        </button>

        <div wire:poll.10s="updateStatus"></div>

        @if ($syncStatus === SyncStatusType::Pending)
            <div wire:init="triggerSync"></div>
        @endif
    </div>

</div>
