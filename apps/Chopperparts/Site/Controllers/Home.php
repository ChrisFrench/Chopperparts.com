<?php 
namespace Chopperparts\Site\Controllers;

class Home extends \Dsc\Controller 
{
    public function index()
    {   
    	    	
        \Base::instance()->set('pagetitle', 'Home');
        \Base::instance()->set('subtitle', '');

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->setVariant('home')->render('Chopperparts/Site/Views::home/index.php');
    }
    
}
