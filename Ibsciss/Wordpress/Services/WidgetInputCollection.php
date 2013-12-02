<?php
namespace Ibsciss\Wordpress\Services;

class WidgetInputCollection extends InputCollection implements \Iterator
{

    protected $value = array();
    protected $instance = null;
    protected $lastLoop = false;
    
    /*
     * Define collections' form generation strategy :
     *  - default = forme generation for each collection + one more
     *  - page builder = page builder doesn't give the data to the form method, so we generate an amount of item in advance.
     */
    protected $formCollectionStrategy = 'pagebuilder';
    //for the pagebuilder strategy define the number of prerendered items
    protected $numberOfPreRenderedForm = 10;
    
    public function __construct($collectionName = '', $instance = null, $value = array()) 
    {
        parent::__construct($collectionName);
        
        if(!is_null($instance))
            $this->setInstance($instance);
        if(!empty($value))
            $this->setValue($value);
        
        if($this->formCollectionStrategy == 'pagebuilder')
            Template::register_admin_js ('pagebuilder-collection');
    }
    
    public function setLargeCollection($preRenderItemNumber = 25)
    {
        if($this->formCollectionStrategy == 'default')
            throw new Exception ('The "setLargCollection" method can be called only with the pagebuilder strategy');
        
        $this->numberOfPreRenderedForm = $preRenderItemNumber;
    }
    
    public function prepareAttr($attr) {
        $attr = parent::prepareAttr($attr);
        $attr['data-collection-name'] = $this->collectionName;
        $attr['data-collection-id'] = $this->getCurrentId();
        
        return $attr;
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

        //a little trick to hack wordpress widget field name creation (no bracket at the beginning and end of the name), 
        //use getOriginalName to don't get the InputCollection::getNameAttribute method
        return $this->instance->get_field_name(''.$this->collectionName.']['.$this->currentId.']['.$this->getOriginalName($attr).'');
    }
    
    public function getIdAttribute($attr) 
    {
        return $this->instance->get_field_id(parent::getIdAttribute($attr));
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getValueAttribute($attr) 
    {
        if(isset($this->value[$this->getCurrentId()]))
            if(isset($this->value[$this->getCurrentId()][$attr['original_name']]))
                return $this->value[$this->getCurrentId()][$attr['original_name']];
            
        return parent::getValueAttribute($attr);
    }
    
    public function current() 
    {
        $this->renderBeforeCollectionItem();
        return $this;
    }

    public function key() 
    {
        return $this->getCurrentId();
    }

    public function next() 
    {
        $this->renderAfterCollectionItem();
        return $this->increment();
    }

    public function rewind() 
    {
        return $this->resetCurrentId();
    }

    public function valid() 
    {
        if($this->formCollectionStrategy == 'default'){
            $maxId = count($this->value);

            //if last loop : flag to create a fresh new form to add an item to the collection
            if($this->getCurrentId() == $maxId)
                $this->lastLoop = true;

            //else : all is ok 
            return $this->getCurrentId() < $maxId+1;
        }else{
            return $this->getCurrentId()< $this->numberOfPreRenderedForm+1;
        }
    }

}
