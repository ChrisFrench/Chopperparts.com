<?php
namespace Theme\Listeners;

class Error extends \Dsc\Singleton
{
    public function onError( $event )
    {
        $f3 = \Base::instance();
            
        
      if($f3->get('DEBUG') == 0) {
        
        if ($f3->get('ERROR.code') == '404')
        {

        	
            if ($f3->get('APP_NAME') == 'site') 
            {
                $response = $event->getArgument('response');
				
                if(!empty($response->action)) {
                	return;
                }


				$this->app->set('criteoLocation', 'listing');
                $html = \Dsc\System::instance()->get('theme')->render('Theme\Views::404.php');
                
                $response->action = 'html';
                $response->html = $html;
        
             
                $event->setArgument('response', $response);                
            }
            
        } else {
        	
        	//all other errors
        	if ($f3->get('APP_NAME') == 'site')
        	{
        		
        		$html = 'ERROR: '. $f3->get('ERROR.text') . '| ' . $f3->get('ERROR.status');
        		$html .= '<br> <hr>';
        		
        		
        		
        		$trace=debug_backtrace(FALSE);
        		
        		$html .= \Dsc\Debug::dump($trace);

        		$response = $event->getArgument('response');
        	
        		if(!empty($response->action)) {
        			return;
        		}
        	
        		$html = \Dsc\System::instance()->get('theme')->render('Theme\Views::Error.php');
        	
        		$response->action = 'html';
        		$response->html = $html;
        	
        		 
        		$event->setArgument('response', $response);
        	}
        	
        	
        	
        }
       }
    }
}