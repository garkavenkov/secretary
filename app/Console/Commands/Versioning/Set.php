<?php

namespace App\Console\Commands\Versioning;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class Set extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'versioning:set {version} {--tagged}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set application version';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $version = $this->argument('version');

        $current_version_number = Config::get('app.version');

        if ($current_version_number === $version) {
            $this->error('Application is already has this version!');
            exit();
        }

        $str_current_version = "'version' => '$current_version_number',";
        $str_new_version = "'version' => '$version',";

        $app_config_path = config_path() . '/app.php';
        $app_config = file_get_contents($app_config_path);

        $app_config = str_replace($str_current_version, $str_new_version, $app_config ,$count);
        try {
            $msg = '';
            $res = file_put_contents($app_config_path, $app_config);
            if ($res) {
                $msg = "Version has been successfully setted.";
            }
            // Set git tag
            if ($this->option('tagged')) {
                exec("git tag v$version", $output, $retval);
                $msg .= " Git tag has bees setted";
            }
            $this->info($msg);
        } catch (Exception $e){
            $this->error($e->getMessage());
        }
    }
}
