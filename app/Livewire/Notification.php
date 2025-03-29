<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $user_id;

    public function getListeners()
    {
        if (env('BROADCAST_DRIVER') == null) {
            return [];
        }

        return [
            'echo-private:broadcast,SendBroadcast' => 'notification',
        ];
    }

    public function notification($value)
    {
        $data = $value['data'];
        $type = $value['type'];
        $user_id = $value['user_id'];

        if ($user_id == 0 || $user_id == auth()->user()->id) {
            $this->alert($type, $data['body']);
        }
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
