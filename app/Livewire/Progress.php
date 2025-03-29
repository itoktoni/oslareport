<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\Url;
use Livewire\Component;

class Progress extends Component
{
    #[Url]
    public $batch = '';

    public $percent = 0;

    public $pending = 0;

    public function render()
    {
        $bus = Bus::findBatch($this->batch);
        if ($bus) {
            $job = ($bus->totalJobs - $bus->pendingJobs);
            $this->pending = intval($bus->pendingJobs);
            $this->percent = intval(($job / $bus->totalJobs) * 100);
        }

        return view('livewire.progress');
    }
}
