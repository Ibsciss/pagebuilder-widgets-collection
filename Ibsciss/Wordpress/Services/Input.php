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
        $attr = $this->prepareAttr(array_merge($attr, array('label' => $label)));

        self::display('text', array(
            'label' => $label,
            'id' => $attr['id'],
            'value' => $attr['value'],
            'name' => $attr['name'],
            'attr' => $attr
        ));
    }
    
    public function Select($label, $options, $attr = array())
    {
        $attr = $this->prepareAttr(array_merge($attr, array('label' => $label)));
        
        self::display('select', array(
            'label' => $label,
            'options' => $options,
            'id' => $attr['id'],
            'value' => $attr['value'],
            'name' => $attr['name'],
            'attr' => $attr
        ));
    }

    public function Label($label, $inputId)
    {
            return self::render('label', array(
                'label' => $label,
                'id' => $inputId
            ));
    }
    
    public function collection($collectionName)
    {
        return new InputCollection($collectionName);
    }
    
    /**
     * Extract and complet $attr array
     * @param array[] $attr
     * @return array[]
     */
    public function prepareAttr($attr)
    {
        //@warning : invoke order is important : original_name MUST BE the first called method.
        $attr['original_name'] = $this->getOriginalName($attr);
        $attr['name'] = $this->getNameAttribute($attr);
        $attr['id'] = $this->getIdAttribute($attr);
        $attr['value'] = $this->getValueAttribute($attr);
        return $attr;
    }
    
    public final function getOriginalName($attr)
    {
        return (isset($attr['name']) && !empty($attr['name'])) ? $attr['name'] : self::sanitize_label($attr['label']);
    }
    
    public function getNameAttribute($attr)
    {
        return (isset($attr['name']) && !empty($attr['name'])) ? $attr['name'] : self::sanitize_label($attr['label']);
    }
    
    public function getIdAttribute($attr)
    {
        return (isset($attr['id']) && !empty($attr['id'])) ? $attr['id'] : $attr['name'];
    }
    
    public function getValueAttribute($attr)
    {
        if(!isset($attr['value']) || empty($attr['value']))
            if(isset($attr['default_value']) && !empty($attr['default_value']))
                return $attr['default_value'];
            
        return '';
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