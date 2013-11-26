<?php

namespace Ibsciss\Wordpress\Services;

class Input {

    /**
     * Display a generic Text Input with its label
     * @param string $label
     * @param array $attr optionals attributes (id, value, name, default_value).
     */
    public function Text($label, $attr = array())
    {
        $attr = self::prepareAttr(array_merge($attr, array('label' => $label)));

        self::display('text', array(
            'label' => $label,
            'id' => $attr['id'],
            'value' => $attr['value'],
            'name' => $attr['name']
        ));
    }
    
    public function Select($label, $options, $attr)
    {
        $attr = self::prepareAttr(array_merge($attr, array('label' => $label)));
        
        self::display('select', array(
            'label' => $label,
            'options' => $options,
            'id' => $attr['id'],
            'value' => $attr['value'],
            'name' => $attr['name']
        ));
    }

    public function Label($label, $inputId)
    {
            return self::render('label', array(
                'label' => $label,
                'id' => $inputId
            ));
    }
    
    /**
     * Extract and complet $attr array
     * @param array[] $attr
     * @return array[]
     */
    public static function prepareAttr($attr)
    {
        $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ? $attr['name'] : self::sanitize_label($attr['label']);
        $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ? $attr['id'] : $attr['name'];
        
        //if empty value change value by default value
        if(!isset($attr['value']) || empty($attr['value']))
            if(isset($attr['default_value']) && !empty($attr['default_value']))
                $attr['value'] = $attr['default_value'];
                    
        return $attr;
    }
    
    /**
     * Remove all whitespace and replace by "_"
     * @param string $string
     * @return string
     */
    protected static function sanitize_label($string)
    {
        return mb_strtolower(preg_replace('/\s+/', '_', $string));
    }

    protected static function render($inputName, $vars)
    {
        return Template::render('form/'.$inputName, $vars, true);
    }

    protected static function display($inputName, $vars)
    {
        $label = (!isset($vars['label']) || empty($vars['label'])) ? '' : self::render('label', $vars);

        $input = self::render('input-'.$inputName, $vars);

        Template::render('form/input-layout', array(
            'label' => $label,
            'input' => $input
        ));
    }

} 