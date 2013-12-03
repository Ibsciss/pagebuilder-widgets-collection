<?php
namespace Ibsciss\Wordpress\Services;
use Ibsciss\Wordpress\Services\Input as Input;

class Template {

    public static $viewsPath = 'views';
    public static $publicPath = 'public';

    private static $viewsPathCache = array();
    private static $jsRegister = array('admin' => array(),
                                        'front' => array());
    private static $cssRegister =  array('admin' => array(),
                                        'front' => array());

    /**
     * @param $templateName string
     * @param $templatesVars array
     */
    public static function render($templateName, $templatesVars, $returnString = false)
    {
        $templatePath = self::computePath($templateName);

        extract($templatesVars, EXTR_OVERWRITE);

        if($returnString)
            ob_start();

        //load template
        require $templatePath;

        if($returnString)
            return ob_get_clean();
    }

    public static function register_js($jsFileName, $context = 'front')
    {
        self::$jsRegister[$context][$jsFileName] = $jsFileName.'.js';
    }

    public static function register_css($cssFileName, $context = 'front')
    {
        self::$cssRegister[$context][$cssFileName] = $cssFileName.'.css';
    }

    public static function register_admin_css($cssFileName)
    {
        self::register_css($cssFileName, 'admin');
    }

    public static function register_admin_js($jsFileName)
    {
        self::register_js($jsFileName, 'admin');
    }

    /**
     * Shortcut for multiple assets registration
     * @param $assets array('css', 'admin_css', 'js', 'admin_js');
     */
    public static function register_assets($assets)
    {
        if(isset($assets['css']))
            self::register_css($assets['css']);

        if(isset($assets['admin_css']))
            self::register_admin_css($assets['admin_css']);

        if(isset($assets['js']))
            self::register_js($assets['js']);

        if(isset($assets['admin_js']))
            self::register_admin_js($assets['admin_js']);
    }

    /**
     * @param $templateName string
     * @return string path to file template
     * @throws \Exception
     */
    protected static function computePath($templateName)
    {
        //return caching templates
        if(!isset(self::$viewsPathCache[$templateName])){

            $templatePath = IBSCISS_PLUGIN_RESOURCES_PATH_PBWC.'/'.self::$viewsPath.'/'.$templateName.'.php';

            //check file existence
            if(!file_exists($templatePath))
                throw new \Exception('The requested views ('.$templateName.') does not exists at '.$templatePath);

            //caching and return
            self::$viewsPathCache[$templateName] = $templatePath;
        }

        return self::$viewsPathCache[$templateName];

    }

    public static function init()
    {
        $publicPath =  IBSCISS_PLUGIN_RESOURCES_URL_PBWC.'/'.self::$publicPath;

        //Register admin style and Javascript
        add_action( 'admin_print_styles', function() use ($publicPath) {
            foreach(self::$cssRegister['admin'] as $cssName => $cssFile)
                wp_enqueue_style( $cssName.'-admin-styles', $publicPath.'/css/'.$cssFile);
        });

        add_action( 'admin_enqueue_scripts', function() use ($publicPath){
            foreach(self::$jsRegister['admin'] as $jsName => $jsFile)
                wp_enqueue_script( $jsName.'-admin-styles', $publicPath.'/javascript/'.$jsFile, array('jquery'));
        });

        // Register site styles and scripts
        add_action( 'wp_enqueue_scripts', function() use ($publicPath){
            foreach(self::$cssRegister['front'] as $cssName => $cssFile){
                wp_enqueue_style( $cssName.'-widget-styles', $publicPath.'/css/'.$cssFile);
            }
            foreach(self::$jsRegister['front'] as $jsName => $jsFile)
                wp_enqueue_script( $jsName.'-widget-styles', $publicPath.'/js/'.$jsFile, array('jquery'));
        });

        //reset public queue
        self::$cssRegister = self::$jsRegister = array('admin' => array(),'front' => array());
    }
}