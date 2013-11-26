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
       
    public function __construct($instance, $value)
    {
        $this->setInstance($instance);
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
    
    /**
     * @inherit
     */
    public function Text($label, $attr = array()) 
    {        
        $attr['name'] = (isset($attr['name'])) ? $attr['name'] : self::sanitize_label($label);
        parent::Text($label, $this->prepareAttrForWidget($attr));
    }
    
    /**
     * @inherit
     */
    public function Select($label, $options, $attr = array())
    {
        $attr['name'] = (isset($attr['name'])) ? $attr['name'] : self::sanitize_label($label);
        parent::Select($label, $options, $this->prepareAttrForWidget($attr));
    }
    
    public function prepareAttrForWidget($attr) {
        //value must be below name because of supercharging.
        $attr['value'] = (isset($this->value[$attr['name']])) ? $this->value[$attr['name']] : '';
        $attr['id'] = $this->instance->get_field_id($attr['name']);
        $attr['name'] = $this->instance->get_field_name($attr['name']);
        return $attr;
    }
        
}

?>