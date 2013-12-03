<?php
namespace Ibsciss\Wordpress\Widgets;


use Ibsciss\Wordpress\Services\Template;
use Ibsciss\Wordpress\Services\WidgetInput;

abstract class Widget extends \WP_widget{

    /**
     * Widgets to init, contains all widget name declared with the register function.
     * @var array
     */
    static $widgetsCollectionToInit = array();

    /**
     * Caching for class name
     * @var array
     */
    private static $widgetsNameCache = array();

    /**
     * @param $widgetClassName string, use the magic __CLASS__ constant in the widget constructor
     */
    public static function register($widgetClassName){
        require_once $widgetClassName.'.php';
        self::$widgetsCollectionToInit[] = $widgetClassName;
    }

    /**
     * Auto building widget name and id from class name (@see self::getClassName()).
     * Init templating.
     *
     * @param string $widget_id
     * @param string $widget_name
     */
    public function __construct ($widget_name = '', $widget_description = '')
    {
        $widget_id = self::getClassName().'-ibsciss-widget';
        $widget_name = (!empty($widget_name)) ?$widget_name.' (PB Collection)' : self::getClassName(true).' (PB Collection)';
        $options = (!empty($widget_description)) ? array('description' => $widget_description) : array();

        parent::__construct($widget_id, $widget_name, $options);
    }
    /**
     * Init all widgets defined is the widgetsCollection attribute
     * Register all css & js as defined;
     */
    public static function init(){
        foreach(self::$widgetsCollectionToInit as $widget){
            add_action( 'widgets_init', function() use ($widget){
                register_widget('Ibsciss\\Wordpress\\Widgets\\'.$widget);
            });
        }
        Template::init();
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        $title = \apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        self::render(self::getClassName().'-widget', $instance);

        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance){
        return $new_instance;
    }

    public function render($tplName, $args)
    {
        Template::render('widgets/'.$tplName, $args);
    }

    /**
     * Display widget's admin.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Saved values from database.
     */
    public function form($instance)
    {
        //protection againt barbaric developper :) (like me) -- if null is saved in DB => the system is broken
        $instance = is_array ($instance) ? $instance : array();
                
        self::render(self::getClassName().'-form', array_merge($instance, array(
            'input' => new WidgetInput($this, $instance)
        )));
    }

    /**
     * Shortcut
     *
     * @see Template::register_assets()
     *
     * @param $assets array('css', 'admin_css', 'js', 'admin_js');
     */
    public function register_assets($assets)
    {
        Template::register_assets($assets);
    }

    /**
     * Return current className by LSB get_called_class() without the namespace.
     * Option tu Ucfirst the className
     * Caching strategy
     *
     * @param bool $ucfirst indicate if return string's first letter is uppercase
     * @return string
     */
    protected static function getClassName($ucfirst = false)
    {
        $classFullName = get_called_class();

        //remove namespaces
        if(!isset(self::$widgetsNameCache[$classFullName])){
            $arrayClassName = explode('\\',$classFullName);
            self::$widgetsNameCache[$classFullName] = end($arrayClassName);
        }

        if($ucfirst)
            return ucfirst(self::$widgetsNameCache[$classFullName]);

        return mb_strtolower(self::$widgetsNameCache[$classFullName]);
    }
    
    protected static function recursiveRemoveEmptyArray($array)
    {
        if(empty($array)) return array();
        
        $return = array();
        $intKey = true;
        foreach($array as $key => $item){
            if(!is_int($key)) $intKey = false;

            //curent item is empty
            if(empty($item)) continue;
            
            //recursive call
            $childrenValues = (is_array($item)) ? self::recursiveRemoveEmptyArray($item) : $item;
            
            //if empty children continue :
            if(empty($childrenValues)) continue;
                            
            $return[$key] = $childrenValues;
        }
        if($intKey)$return = array_values($return);
        return $return;
    }

} 