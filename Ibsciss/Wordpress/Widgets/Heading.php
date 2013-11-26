<?php

namespace Ibsciss\Wordpress\Widgets;


use Ibsciss\Wordpress\Services\Validate;

class Heading extends Widget {

    public function __construct(){
        parent::__construct('Heading', 'Display a title (hx tag)');
        self::register_assets(array('css' => 'widget-global'));
    }

    public function widget($args, $instance)
    {
        $this->render('heading-widget', $instance);
    }

    public function update($new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['heading_level'] = (int)$new_instance['heading_level'];
        $instance['text_align'] = (array_key_exists('text_align',$new_instance)) ? Validate::textalign($new_instance['text_align']) : 'left';
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

}
