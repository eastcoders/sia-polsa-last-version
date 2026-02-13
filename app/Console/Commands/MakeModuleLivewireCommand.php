<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;

class MakeModuleLivewireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-livewire {module} {name} {--inline}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Livewire component inside a module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $moduleName = $this->argument('module'); // e.g. Akademiks
        // Ensure module name has correct casing based on folder if possible, but Module::find handles it usually.
        // But for file paths, we might want studly case.
        $module = Module::find($moduleName);
        if (!$module) {
            $this->error("Module [{$moduleName}] does not exist!");
            return 1;
        }
        $moduleName = $module->getName(); // Get canonical name

        $componentName = $this->argument('name'); // e.g. Mahasiswa/Create
        $inline = $this->option('inline');

        // Normalize component name to forward slashes
        $componentName = str_replace(['\\', '.'], '/', $componentName);

        // Prepare names
        $className = Str::studly(class_basename($componentName));
        $namespacePath = Str::beforeLast($componentName, '/');
        
        if ($namespacePath === $componentName) {
            $namespacePath = ''; // No subdirectory
        }
        
        // Full Class Namespace
        $classNamespace = "Modules\\{$moduleName}\\Livewire" . ($namespacePath ? "\\" . str_replace('/', '\\', $namespacePath) : "");
        
        // File Paths
        // We need to resolve the path relative to module path.
        // Nwidart modules usually map 'app' to 'app' or 'src' depending on structure.
        // In this project: `Modules/Akademiks/app/Livewire`.
        
        $modulePath = $module->getPath();
        $classRelPath = 'app/Livewire/' . ($namespacePath ? $namespacePath . '/' : '') . $className . '.php';
        $classPath = $modulePath . '/' . $classRelPath;
        
        // View Name logic
        // We need to construct the view name for 'livewire.view-name' format.
        $viewNameParts = explode('/', $componentName);
        $viewNameParts = array_map(function($part) {
            return Str::kebab($part);
        }, $viewNameParts);
        $viewName = implode('.', $viewNameParts);
        
        $viewRelPath = 'resources/views/livewire/' . str_replace('.', '/', $viewName) . '.blade.php';
        $viewPath = $modulePath . '/' . $viewRelPath;

        // Create Class
        if (File::exists($classPath)) {
            $this->error("Class already exists at {$classPath}");
            return 1;
        }

        $this->ensureDirectoryExists($classPath);
        $this->createClassFile($classPath, $classNamespace, $className, $moduleName, $viewName, $inline);

        $this->info("Class created: {$classPath}");

        // Create View if not inline
        if (!$inline) {
            if (File::exists($viewPath)) {
                $this->error("View already exists at {$viewPath}");
            } else {
                $this->ensureDirectoryExists($viewPath);
                $this->createViewFile($viewPath);
                $this->info("View created: {$viewPath}");
            }
        }

        // Output Registration Info
        $lowerModuleName = Str::lower($moduleName);
        $componentAlias = "{$lowerModuleName}::{$viewName}";
        $fullClassName = $classNamespace . '\\' . $className;

        $this->info("\nDone! 1 Step Remaining: Register the component in your ServiceProvider:");
        $this->line("<comment>Modules/{$moduleName}/app/Providers/{$moduleName}ServiceProvider.php</comment>");
        $this->info("\nprotected function registerLivewireComponents(): void");
        $this->info("{");
        $this->info("    \Livewire\Livewire::component(");
        $this->info("        '{$componentAlias}',");
        $this->info("        \\{$fullClassName}::class");
        $this->info("    );");
        $this->info("}");

        return 0;
    }

    protected function ensureDirectoryExists($path)
    {
        $directory = dirname($path);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
    }

    protected function createClassFile($path, $namespace, $className, $moduleName, $viewName, $inline)
    {
        $lowerModuleName = Str::lower($moduleName);
        $view = $inline ? 
            'return <<<\'blade\'' . PHP_EOL . '        <div>' . PHP_EOL . '            {{-- In work, do what you enjoy. --}}' . PHP_EOL . '        </div>' . PHP_EOL . '        blade;' 
            : "return view('{$lowerModuleName}::livewire.{$viewName}');";
        
        $content = <<<PHP
<?php

namespace {$namespace};

use Livewire\Component;
use Livewire\Attributes\Layout;

class {$className} extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        {$view}
    }
}
PHP;
        File::put($path, $content);
    }

    protected function createViewFile($path)
    {
        $content = <<<BLADE
<div>
    <h3>The <code>{$path}</code> livewire component is loaded from the <code>{$path}</code> module.</h3>
</div>
BLADE;
        File::put($path, $content);
    }
}
