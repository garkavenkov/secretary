<?php

namespace App\Console\Commands\Versioning;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class Patch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'versioning:patch {--tagged}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increase version patch number';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $version = Config::get('app.version');

        $parts = explode('.', $version);

        if (count($parts) < 3) {
            die("Wrong semantic version format");
        }

        // increase  patch
        $parts[2]++;

        $new_version = implode('.', $parts);

        $params['version'] =  $new_version;
        if ($this->option('tagged')) {
            $params['--tagged'] = true;
        }
        $this->call('versioning:set', $params);
    }
}
