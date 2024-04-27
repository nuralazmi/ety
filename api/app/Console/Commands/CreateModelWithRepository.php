<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateModelWithRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:rim {name : Model name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @return void
     */
    public function handle(): void
    {
        $modelName = $this->argument('name');

        $this->call('make:model', [
            'name' => $modelName,
        ]);

        $this->call('make:repository', [
            'name' => "{$modelName}Repository",
        ]);

        $this->call('make:interface', [
            'name' => "{$modelName}Interface",
        ]);

        $this->call('make:migration', [
            'name' => "create_{$modelName}_table",
            '--create' => Str::plural(strtolower($modelName)),
        ]);

        $this->updateAppServiceProvider($modelName);
    }

    /**
     * @param $modelName
     * @return void
     */
    protected function updateAppServiceProvider($modelName): void
    {
        $repositoryClassName = "{$modelName}Repository";
        $interfaceClassName = "{$modelName}Interface";
        $providerPath = app_path('Providers/AppServiceProvider.php');
        $providerContents = File::get($providerPath);

        // İlgili satırları oluştur
        $repositoryUseStatement = "use App\Repositories\\$repositoryClassName;";
        $interfaceUseStatement = "use App\Interfaces\\$interfaceClassName;";
        $repositoryBinding = "\$this->app->bind($interfaceClassName::class, $repositoryClassName::class);";

        // İlgili satırları AppServiceProvider sınıfına ekle
        $providerContents = Str::replaceFirst('use Illuminate\Support\ServiceProvider;', "use Illuminate\Support\ServiceProvider;\n$repositoryUseStatement\n$interfaceUseStatement", $providerContents);
        $providerContents = Str::replaceFirst('//', "$repositoryBinding\n\n//", $providerContents);

        File::put($providerPath, $providerContents);

        $this->info('AppServiceProvider updated successfully.');
    }
}
