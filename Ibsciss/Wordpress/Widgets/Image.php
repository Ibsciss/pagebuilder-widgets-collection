<?php

namespace Ibsciss\Wordpress\Widgets;

use Ibsciss\Wordpress\Services\Template;
use Ibsciss\Wordpress\Services\Validate;

class Image extends Widget 
{
    public function __construct() {
        parent::__construct('Image', 'An image with alt text & legend');
        Template::register_css('widget-global');
    }
    
    public function update($new_instance, $old_instance) {
        $instance = $new_instance;
        $instance['legend_position'] = Validate::AboveOrUnder($new_instance['legend_position']);
        $instance['legend_text_align'] = Validate::textalign($new_instance['legend_text_align']);
        
        return $instance;
    }
}