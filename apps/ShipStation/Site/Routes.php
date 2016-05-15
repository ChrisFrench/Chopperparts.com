<?php

namespace ShipStation\Site;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */

class Routes extends \Dsc\Routes\Group{
	
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){

		$this->setDefaults(
				array(
					'namespace' => '\ShipStation\Site\Controllers',
					'url_prefix' => '/shipstation'
				)
		);
		$this->add( '', 'GET', array(
								'controller' => 'Orders',
								'action' => 'getHandler'
								));
		$this->add( '', 'POST', array(
			'controller' => 'Orders',
			'action' => 'postHandler'
		));
		
		
	}
	
}