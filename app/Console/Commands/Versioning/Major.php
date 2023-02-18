<?php

namespace App\Console\Commands\Versioning;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class Major extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'versioning:major {--tagged}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increase version major number';

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
            die("Wrong semantic versioning format");
        }

        // Increase major version. Reset minor and patch
        $parts[0]++;
        $parts[1] = 0;
        $parts[2] = 0;

        $new_version = implode('.', $parts);

        $params['version'] =  $new_version;
        if ($this->option('tagged')) {
            $params['--tagged'] = true;
        }
        $this->call('versioning:set', $params);
    }
}
