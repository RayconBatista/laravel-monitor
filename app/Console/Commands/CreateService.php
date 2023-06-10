<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folderPath = app_path('Services');

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $fileName = $name . '.php';
        $filePath = $folderPath . '/' . $fileName;

        if (File::exists($filePath)) {
            $this->error('Service already exists!');
            return;
        }

        File::put($filePath, $this->generateServiceContent($name));

        $this->info('Service created successfully!');
    }

    protected function generateServiceContent($name)
    {
        return "<?php\n\nnamespace App\Services;\n\nclass {$name}\n{\n    // Your service code here\n}\n";
    }
}
