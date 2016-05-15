<?php

class ThemeBootstrap extends \Dsc\Bootstrap
{

    protected $dir = __DIR__;

    protected $base = __DIR__;

    protected $namespace = 'Theme';

    /**
     * Register this app's view files for all global_apps
     * 
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
        parent::runAdmin();
        
        // Tell the admin that this is an available front-end theme
        \Dsc\System::instance()->get('theme')->registerTheme('Theme', $this->app->get('PATH_ROOT') . 'apps/Theme/');
        
        if (class_exists('\Modules\Factory')) 
        {
            // register this theme's module positions with the admin
            \Modules\Factory::registerPositions(array(
                'homepage-slider',
            	'homepage-row-1',
            	'homepage-row-2',
            	'homepage-row-3',
            	'homepage-row-4',
            	'homepage-row-5',
            	'footer-promo',
            ));
        }

        \Minify\Factory::registerPath($this->app->get('PATH_ROOT') . "public/theme/");
        $files = array(
        	'js/shop/returns.js',
        );
        
        foreach ($files as $file)
        {
            \Minify\Factory::js($file, array(
                'priority' => 1
            ));
        }

    }

    protected  function runCli() {
    	\Dsc\System::instance()->get('theme')->setTheme('Theme', $this->app->get('PATH_ROOT') . 'apps/Theme/');
    	\Dsc\System::instance()->get('theme')->registerViewPath($this->app->get('PATH_ROOT') . 'apps/Theme/Views/', 'Theme/Views');
    }
    /**
     * Triggered when the front-end global_app is run
     */
    protected function runSite()
    {	
        // link the theme to public folder
        if (!is_dir($this->app->get('PATH_ROOT') . 'public/theme'))
        {
            $public_theme = $this->app->get('PATH_ROOT') . 'public/theme';
            $theme_assets = realpath( $this->app->get('PATH_ROOT') . 'apps/Theme/Assets' );
            $res = symlink($theme_assets, $public_theme);
        }
        
        \Dsc\System::instance()->get('theme')->setTheme('Theme', $this->app->get('PATH_ROOT') . 'apps/Theme/');
        \Dsc\System::instance()->get('theme')->registerViewPath($this->app->get('PATH_ROOT') . 'apps/Theme/Views/', 'Theme/Views');
        
        // tell Minify where to find Media, CSS and JS files
        \Minify\Factory::registerPath($this->app->get('PATH_ROOT') . "public/theme/");
        //\Minify\Factory::registerPath($this->app->get('PATH_ROOT') . "public/theme/css/");
        //\Minify\Factory::registerPath($this->app->get('PATH_ROOT') . "public/");
        
        
        
        // add the media assets to be minified
        $files = array(
        	'css/bootstrap.min.css',
        	'fonts/font-awesome/css/font-awesome.min.css',
        	'fonts/lovelo/stylesheet.css',
            'css/owl.carousel.css',
            'css/owl.theme.css',
            'rs-plugin/css/settings.css',
            'css/custom.css'
        );
         
        foreach ($files as $file) 
        {
            \Minify\Factory::css($file);
        }

        if($this->app->get('DEBUG'))  {
        	$files = array(
        			'js/jquery-ias.min.js',
        			'js/jquery.validate.min.js',
        			'js/bootstrap.min.js',
        			'js/bootstrap-select.min.js',
        			'js/custom.js',
		        	'js/shop/returns.js',
        			'js/shop/site.js',
        			'js/social.js',
        	);
        } else {
        	$files = array(
        			'js/jquery-ias.min.js',
        			'js/jquery.validate.min.js',
        			'js/bootstrap.min.js',
        			'js/bootstrap-select.min.js',
					'js/custom.js',
		        	'js/shop/returns.js',
        			'js/shop/site.js',
        			'js/social.min.js',
        	);
        }
        
        foreach ($files as $file)
        {
            \Minify\Factory::js($file, array(
                'priority' => 1
            ));
        }
   
        \Dsc\System::instance()->getDispatcher()->addListener(\Theme\Listeners\Error::instance());
        
        parent::runSite();
    }
}
$app = new ThemeBootstrap();
