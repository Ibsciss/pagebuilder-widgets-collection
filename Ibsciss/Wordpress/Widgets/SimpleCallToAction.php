<?php

namespace Ibsciss\Wordpress\Widgets;

use Ibsciss\Wordpress\Services\Template;

class SimpleCallToAction extends Widget {

    public function __construct()
    {
        parent::__construct('Simple call to action', 'A call to action bloc with only a link');
        Template::register_css('widget-calltoaction');
        Template::register_css('widget-global');
    }
    
    //to not render title
    public function widget($args, $instance)
    {
        $this->render('simplecalltoaction-widget', $instance);
    }
}