<?php

namespace App\Console\Commands;

use App\Dao\Models\Core\User;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dummy:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'untuk mengirimkan whatsapp otomatis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (range(1, 100) as $item) {
            User::factory(100)->create();
        }
    }
}
