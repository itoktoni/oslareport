<?php

namespace App\Livewire;

use App\Dao\Enums\Core\SyncStatusType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SyncDatabase extends Component
{
    public $syncStatus = SyncStatusType::Pending;

    protected $listeners = ['triggerSync'];

    public function mount()
    {
        $this->updateStatus();
    }

    public function triggerSync()
    {
        $this->syncStatus = SyncStatusType::Pending;
        Cache::put('sync', $this->syncStatus);
    }

    public function updateStatus()
    {
        $sync = Cache::get('sync');
        Log::info('sync', ['status' => $sync, 'time' => Carbon::now()->toDateTimeString()]);
    }

    public function render()
    {
        return view('livewire.sync-database');
    }
}
