<?php
namespace Tommyprmbd\LaravelRbacModule\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

final class InstallCommand extends Command
{
    /**
     * the name and signatur of the console command.
     * 
     * @var string
     */
    protected $signature = "rbac-module:install";


    /**
     * the console command description
     * 
     * @var string
     */
    protected $description = "Install permission, role & user modules.";

    /**
     * execute command
     */
    public function handle() {
        $this->installModels();
        $this->installControllers();
        $this->installResources();
        $this->installRoutes();
    }

    /**
     * install models
     * 
     * @return void
     */
    protected function installModels() {
        (new Filesystem)->ensureDirectoryExists(app_path('Models'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Models', app_path('Models'));
    }

    /**
     * install controllers
     * 
     * @return void
     */
    protected function installControllers() {
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Http/Controllers', app_path('Http/Controllers'));
    }

    /**
     * install resources
     * 
     * @return void
     */
    protected function installResources() {
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views', resource_path('views'));
    }

    /**
     * install route
     * 
     * @return void
     */
    protected function installRoutes() {
        $newRoutes = "\n
/**
 * Added by package Laravel RBAC Module.
 */
" . <<<'EOT'
Route::resources([
    'permissions' => App\Http\Controllers\PermissionController::class,
    'roles' => App\Http\Controllers\RoleController::class,
    'users' => App\Http\Controllers\UserController::class,
]);
EOT . "\n";
        file_put_contents(base_path('routes/web.php'), $newRoutes, FILE_APPEND);
    }
}