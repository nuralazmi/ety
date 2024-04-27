<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name : The name of the repository}';
    protected $description = 'Create a new repository';

    /**
     * @return void
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $remove_repository = str_replace('Repository', '', $name);
        $interfaceName = $remove_repository . 'Interface';
        $modelName = $remove_repository;
        $filename = $name . '.php';
        $path = $this->getRepositoryPath($name);

        if (File::exists($path)) {
            $this->error('Repository already exists!');
            return;
        }

        $stub = $this->getRepositoryStub();
        $stub = str_replace('{{$repositoryName}}', $name, $stub);
        $stub = str_replace('{{$interfaceName}}', $interfaceName, $stub);
        $stub = str_replace('{{$modelName}}', $modelName, $stub);

        File::put($path, $stub);

        $this->info("Repository created successfully: $filename");
    }

    /**
     * @param $name
     * @return string
     */
    protected function getRepositoryPath($name): string
    {
        $directory = app_path('Repositories');
        if (!File::exists($directory)) {
            File::makeDirectory($directory);
        }
        return $directory . '/' . $this->getRepositoryFileName($name);
    }

    /**
     * @param $name
     * @return string
     */
    protected function getRepositoryFileName($name): string
    {
        return $name . '.php';
    }

    /**
     * @return string
     */
    protected function getRepositoryStub(): string
    {
        return File::get(app_path('Console/Commands/Stubs/repository.stub'));
    }
}
