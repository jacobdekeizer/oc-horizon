<?php namespace Jacob\Horizon;

use Backend\Facades\BackendAuth;
use Backend\Helpers\Backend;
use Backend\Models\User;
use Illuminate\Foundation\AliasLoader;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonServiceProvider;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /** @var Backend */
    private $backend;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->backend = $this->app->make(Backend::class);
    }

    public function pluginDetails(): array
    {
        return [
            'name' => 'Horizon',
            'description' => 'Horizon provides a beautiful dashboard and code-driven configuration for your October powered Redis queues. Horizon allows you to easily monitor key metrics of your queue system such as job throughput, runtime, and job failures.',
            'author' => 'Jacob',
            'iconSvg' => $this->backend->url('jacob/horizon/horizon/icon')
        ];
    }

    public function boot(): void
    {
        $this->app->register(HorizonServiceProvider::class);

        AliasLoader::getInstance()->alias('Horizon', Horizon::class);

        Horizon::auth(function ($request) {
            if (!BackendAuth::check()) {
                return false;
            }

            /** @var User $user */
            $user = BackendAuth::getUser();

            return $user->isSuperUser() || $user->hasPermission('jacob.horizon.access');
        });

        if (config('jacob.horizon::dark_mode')) {
            Horizon::night();
        }
    }

    public function registerSchedule($schedule): void
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    public function registerPermissions(): array
    {
        return [
            'jacob.horizon.access' => [
                'tab'   => 'Horizon',
                'label' => 'Access to the Horizon dashboard',
                'roles' => ['developer'],
            ],
        ];
    }

    public function registerNavigation(): array
    {
        return [
            'horizon' => [
                'label' => 'Horizon',
                'url' => $this->backend->url('jacob/horizon/horizon'),
                'iconSvg' => '/plugins/jacob/horizon/assets/horizon.svg',
                'order' => 500,
                'permissions' => ['jacob.horizon.access'],
            ]
        ];
    }
}
