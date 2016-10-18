<?php 
namespace Chopperparts\Site\Controllers;

class ContactUs extends \Dsc\Controller 
{
    public function index()
    {   
    	    	
        \Base::instance()->set('pagetitle', 'Contact Us');
        \Base::instance()->set('subtitle', '');

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->setVariant('home')->render('Chopperparts/Site/Views::contactus/index.php');
    }
    
}
