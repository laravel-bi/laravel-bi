<?php

namespace LaravelBi\LaravelBi\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class DashboardCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bi:dashboard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Laravel Bi dashboard class';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $model     = $this->laravel->getNamespace() . 'Models\\' . $this->option('model');
        $shortName = $this->argument('name');

        return str_replace(
            [
                'DummyClass',
                'dummyName',
                'DummyModel'
            ], [
                Str::studly($name),
                Str::camel($shortName),
                Str::studly($model)
            ], parent::buildClass($name)
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Bi\Dashboards';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../stubs/dashboard.stub';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_REQUIRED, 'The model class being represented.']
        ];
    }
}
