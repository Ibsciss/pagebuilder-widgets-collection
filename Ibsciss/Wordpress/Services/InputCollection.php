<?php
namespace Ibsciss\Wordpress\Services;

class InputCollection extends Input
{
    /**
     * Name of the current collection
     * @var string
     */
    protected $collectionName = '';
    
    protected $currentId = 0;
    
    protected $autoincrement = true;
        
    public function __construct($collectionName = '') 
    {
        if(!empty($collectionName))
            $this->setCollectionName ($collectionName);
    }
    
    public function setCollectionName($collectionName)
    {
        $this->collectionName = mb_strtolower($collectionName);
    }
    
    public function getNameAttribute($attr) {
        //check if collectionName is defined
        if(empty($this->collectionName))
            throw new Exception('Collection\'s name is not defined, use setCollectionName method or define it in the constructor');
        
        return ''.$this->collectionName.'['.$this->currentId.']['.parent::getNameAttribute($attr).']';
    }
    
    public function renderBeforeCollectionItem()
    {
        Template::render('form/collection-before', array(
            'collection_name' => $this->collectionName,
            'collection_id' => $this->currentId,
        ));
    }
    
    public function renderAfterCollectionItem()
    {
        Template::render('form/collection-after', array(
            'collection_name' => $this->collectionName,
            'collection_id' => $this->currentId,
        ));
    }
    
    public function setCurrentId($id)
    {
        $this->currentId = $id;
        $this->autoincrement = false;
        return $this->currentId;
    }
    
    public function getCurrentId()
    {
        return $this->currentId;
    }
    
    public function increment()
    {
        if(!$this->autoincrement)
            throw new Exception('Identifier autoincrement is disabled by the use of currentId');
            
        $this->currentId++;
    }
    
    public function resetCurrentId()
    {
        $this->currentId = 0;
    }
}
