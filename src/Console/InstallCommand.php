<?php

namespace LaravelBi\LaravelBi\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bi:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laravel Bi';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Bi Assets / Config...');
        $this->callSilent('vendor:publish', ['--tag' => 'bi-config']);
        $this->callSilent('vendor:publish', ['--tag' => 'bi-assets']);

        $this->comment('Publishing Bi Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'bi-provider']);

        $this->registerBiServiceProvider();

        $this->comment('Generating User Dashboard...');
        $this->callSilent('bi:dashboard', ['name' => 'UserDashboard']);
        copy(__DIR__ . '/../../stubs/user-dashboard.stub', app_path('Bi/Dashboards/UserDashboard.php'));

        $this->setAppNamespace();

        $this->info('Laravel Bi installed successfully.');
    }

    /**
     * Register the Nova service provider in the application configuration file.
     *
     * @return void
     */
    protected function registerBiServiceProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\EventServiceProvider::class," . PHP_EOL,
            "{$namespace}\\Providers\EventServiceProvider::class," . PHP_EOL . "        {$namespace}\Providers\BiServiceProvider::class," . PHP_EOL,
            file_get_contents(config_path('app.php'))
        ));
    }

    /**
     * Set the proper application namespace on the installed files.
     *
     * @return void
     */
    protected function setAppNamespace()
    {
        $namespace = $this->laravel->getNamespace();

        $this->setAppNamespaceOn(app_path('Bi/Dashboards/UserDashboard.php'), $namespace);
        $this->setAppNamespaceOn(app_path('Providers/BiServiceProvider.php'), $namespace);
    }

    /**
     * Set the namespace on the given file.
     *
     * @param  string  $file
     * @param  string  $namespace
     * @return void
     */
    protected function setAppNamespaceOn($file, $namespace)
    {
        file_put_contents($file, str_replace(
            'App\\',
            $namespace,
            file_get_contents($file)
        ));
    }
}
