<?php
namespace Chat\Message;

use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
        $this->publishing();
    }

    protected function publishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/message.php' => config_path('message.php')
            ], 'config'); 

            $this->publishes([
                __DIR__.'/../database/migrations' => base_path('database/migrations')
            ], 'migrations');
        }

        $this->publishes([
            __DIR__.'/resources/assets/components' => base_path('resources/assets/js/components'),
        ]);
        
        $this->publishes([
            __DIR__.'/resources/assets' => base_path('resources/assets/js'),
        ]);

        $this->publishes([
            __DIR__.'/resources/assets/app.js' => base_path('resources/assets/js/app.js'),
        ]);

        $this->publishes([
            __DIR__.'/public/css' => base_path('public/css'),
        ]);
    }

    public function register()
    {
        // register our controller
        $this->app->make('Chat\Message\ChatController');
        $this->loadViewsFrom(__DIR__.'/views', 'chat');
    }

}
