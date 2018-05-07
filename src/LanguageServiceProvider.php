<?php

namespace Pinfort\LaravelLangSelector;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // config
        $this->publishes([
            __DIR__.'/config/language.php' => config_path('language.php'),
        ]);

        // view
        $this->loadViewsFrom(__DIR__.'/views', 'LaravelLangSelector');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/LaravelLangSelector'),
        ]);

        View::composer('LaravelLangSelector::lang_menu', 'Pinfort\LaravelLangSelector\ViewComposers\UserLanguageComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
