<?php 
namespace Katiedilse\Models;


class Pitcrew extends \Dsc\Mongo\Collections\Nodes 
{
   
    
    protected $__collection_name = 'tashaschuh.pitcrew.register';
    protected $__type = 'tashaschuh.register';
    protected $__config = array(
        'default_sort' => array(
            'metadata.created.time' => 1
        ),
    );
    
    protected function fetchConditions()
    {
        parent::fetchConditions();
        
       
        return $this;
    }
    
    protected function beforeValidate()
    {
       
        
        return parent::beforeValidate();
    }
    
    /**
     * Gets the type
     */
    public function type()
    {
        return $this->__type;
    }
   
    
  
    
  
}