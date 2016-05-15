<?php
class ChopperpartsBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $base = __DIR__;
    protected $namespace = 'Chopperparts';
    
    /**
     * Register this app's view files for all global_apps
     * @param string $global_app
     */
    protected function registerViewFiles($global_app)
    {
        \Dsc\System::instance()->get('theme')->registerViewPath($this->dir . '/' . $global_app . '/Views/', $this->namespace . '/' . $global_app . '/Views');
    }

    /**
     * Triggered when the admin global_app is run
     */
    protected function runAdmin()
    {
        // register the modules path
        \Modules\Factory::registerPath( \Base::instance()->get('PATH_ROOT') . "apps/Chopperparts/Modules/" );
        
        parent::runAdmin();  
    }
	
   
    
    /**
     * Triggered when the front-end global_app is run
     */
    protected function runSite()
    {   
    	
    	
     	
        parent::runSite();
       
    
    }
}
$app = new ChopperpartsBootstrap();