<?php namespace Distillerie;

use Illuminate\Support\ServiceProvider;

class DistillerieServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['link'] = $this->app->share(function() { return new Libraries\Link\Link; });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('link');
    }

}