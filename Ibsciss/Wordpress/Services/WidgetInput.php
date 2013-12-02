<?php
namespace Ibsciss\Wordpress\Services;

class WidgetInput extends Input
{
    
    /**
     * Current widget object
     * @var WP_widget 
     */
    protected $instance = null;
    
    protected $value = array();
       
    public function __construct($instance = null, $value = array())
    {
        if(!is_null($instance))
            $this->setInstance($instance);

        if(!empty($value))
            $this->setValue($value);
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function setInstance(\WP_widget $instance)
    {
        $this->instance = $instance;
    }

    public function getNameAttribute($attr)
    {
        //check if an instance has been defined
        if(is_null($this->instance))
            throw new Exception ('A widget instance MUST BE set (in constructor or method "setInstance") before calling other functions');
        
        return $this->instance->get_field_name(parent::getNameAttribute($attr));
    }
    
    public function getIdAttribute($attr) 
    {
        return $this->instance->get_field_id(parent::getIdAttribute($attr));
    }
    
    public function getValueAttribute($attr) 
    {
        if(isset($this->value[$attr['original_name']]))
            return $this->value[$attr['original_name']];
        
        return parent::getValueAttribute($attr);
    }
        
}

?>