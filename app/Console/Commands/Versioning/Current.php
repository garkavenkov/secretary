<?php

namespace App\Console\Commands\Versioning;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class Current extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'versioning:current';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Current version of application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $version = Config::get('app.version');

        echo "Current version is: $version" . PHP_EOL;
    }
}
