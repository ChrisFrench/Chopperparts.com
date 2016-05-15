<?php
namespace Theme\Listeners;

class Error extends \Dsc\Singleton
{
    public function onError( $event )
    {
        $f3 = \Base::instance();
        //fixing google base links
        if(strpos($f3->hive()['PATH'],'&source=GoogleBase') ) {
        	$path = $f3->hive()['PATH'];
        	$path = str_replace('&source=GoogleBase', '?source=GoogleBase',$path);
        	\Base::instance()->reroute($path);
        }
       
        
     
        
      if($f3->get('DEBUG') == 0) {
        
        if ($f3->get('ERROR.code') == '404')
        {

        	// reroute old ymm/category links
        	$parsedUrl = parse_url(\Dsc\Url::full());
        	if (preg_match('/^(\d{4}-.+)_([a-zA-Z-]{3,})$/', substr($parsedUrl['path'], 1), $matches)) {
        		$oldYmmSlug = $matches[1];
        		$oldCategorySlug = $matches[2];
        	} else if (isset($parsedUrl['query'])) {
        		parse_str($parsedUrl['query'], $query);
        	
        		if (isset($query['ymm_view_category'])) {
        			$oldYmmSlug = substr($parsedUrl['path'], 1);
        			$oldCategorySlug = str_replace(' ', '-', $query['ymm_view_category']);
        		}
        	}
        	
        	if (!empty($oldYmmSlug) && !empty($oldCategorySlug)) {
        		$ymm = (new \RallyShop\Models\YearMakeModels())
        		->setCondition('old.slug', $oldYmmSlug)
        		->getItem();
        	
        		if (!empty($ymm)) {
        			$category = (new \RallyShop\Models\Categories())
        			->setCondition('old.slug', $oldCategorySlug)
        			->getItem();
        	
        			if (!empty($category)) {
        				$this->app->reroute('/shop/category' . $category->path . '?ymm=' . $ymm->slug);
        			} else {
        				$this->app->reroute('/shop/vehicle/' . $ymm->slug);
        			}
        			return;
        		}
        	}
        	
        	
        	
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

        		
        		
        		(new \GithubApp\Models\Issues)->createIssueFromError($f3->get('ERROR.text'), $html);
        		
        		
        	//	$emailSent = \Dsc\System::instance()->get('mailer')->send('chris.french@rallysportdirect.com', $f3->get('IP'). ' DEMO SITE ERROR' . $f3->get('ERROR.code'), array($html) );
        		 
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