<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CommandConstants extends Command
{
    protected $signature = 'make:constants {model?}';  // Model is now optional, so we add a "?" for optional argument

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate column constants for a given model based on its table schema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->argument('model');

        // Handle "all" argument to process all models
        if ($modelName === 'all') {
            $this->processAllModels();
        } elseif ($modelName) {
            // Process a single model
            $this->processModel($modelName);
        } else {
            // If no model or "all" is passed, prompt user to specify a model or "all"
            $this->error('Please specify a model or use "all" to generate constants for all models.');
        }
    }

    private function processAllModels()
    {
        $modelDirectory = app_path('Models');
        $modelFiles = scandir($modelDirectory);

        $modelFiles = array_filter($modelFiles, function ($file) {
            return Str::endsWith($file, '.php') && $file !== 'Model.php'; // Avoid 'Model.php' base file
        });

        foreach ($modelFiles as $file) {
            $modelName = pathinfo($file, PATHINFO_FILENAME);
            $this->processModel($modelName);
        }

        $this->info('Column constants and TABLE_NAME generated for all models.');
    }

    private function processModel(string $modelName)
    {
        $modelClass = "App\\Models\\{$modelName}";

        if (! class_exists($modelClass)) {
            $this->error("Model {$modelName} does not exist.");
            return;
        }

        $model = new $modelClass;
        $table = $model->getTable();
        $columns = Schema::getColumnListing($table);

        // Generate the constants
        $constants = "\n\n    public const TABLE_NAME = '{$table}';\n\n";
        foreach ($columns as $column) {
            $constantName = strtoupper('COL_'.$column);
            $constants .= "    public const {$constantName} = '{$column}';\n";
        }

        $modelPath = app_path("Models/{$modelName}.php");
        $content = file_get_contents($modelPath);

        // Find the position after the class declaration to insert the constants
        $classPosition = strpos($content, 'class ' . $modelName);
        if ($classPosition === false) {
            $this->error("Could not find the class {$modelName} in the file.");
            return;
        }

        // Find the end of the class declaration
        $bracePosition = strpos($content, '{', $classPosition);
        if ($bracePosition === false) {
            $this->error("Could not find the opening brace for the class {$modelName}.");
            return;
        }

        // Check if the constants are already present in the model
        if (strpos($content, 'public const TABLE_NAME') !== false && strpos($content, 'public const COL_') !== false) {
            $this->info("Constants already exist in {$modelName}. Skipping insertion.");
            return;
        }

        // Insert the constants just after the opening brace of the class
        $content = substr_replace($content, $constants, $bracePosition + 1, 0);

        // Write the updated content to the model file
        file_put_contents($modelPath, $content);

        $this->info("Column constants and TABLE_NAME generated successfully for {$modelName}.");
    }
}
