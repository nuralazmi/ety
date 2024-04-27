<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeInterface extends Command
{
    protected $signature = 'make:interface {name : The name of the interface}';
    protected $description = 'Create a new interface';

    /**
     * @return void
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $filename = $this->getInterfaceFileName($name);
        $path = $this->getInterfacePath($name);

        if (File::exists($path)) {
            $this->error('Interface already exists!');
            return;
        }

        $stub = $this->getInterfaceStub();
        $interfaceContents = str_replace('{{interface}}', $name, $stub);

        File::put($path, $interfaceContents);

        $this->info("Interface created successfully: $filename");
    }

    /**
     * @param $name
     * @return string
     */
    protected function getInterfacePath($name): string
    {
        $directory = app_path('Interfaces');
        if (!File::exists($directory)) {
            File::makeDirectory($directory);
        }
        return $directory . '/' . $this->getInterfaceFileName($name);
    }


    /**
     * @param $name
     * @return string
     */
    protected function getInterfaceFileName($name): string
    {
        return $name . '.php';
    }

    /**
     * @return string
     */
    protected function getInterfaceStub(): string
    {
        return File::get(app_path('Console/Commands/Stubs/interface.stub'));
    }

}
