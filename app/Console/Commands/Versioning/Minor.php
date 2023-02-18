<?php

namespace App\Console\Commands\Versioning;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class Minor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'versioning:minor {--tagged}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increase version minor number';

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

        // increase minor version and reset patch
        $parts[1]++;
        $parts[2] = 0;

        $new_version = implode('.', $parts);

        $params['version'] =  $new_version;
        if ($this->option('tagged')) {
            $params['--tagged'] = true;
        }

        $this->call('versioning:set', $params);

    }
}
