<?php

namespace Ibsciss\Wordpress\Widgets;


use Ibsciss\Wordpress\Services\Validate;

class Heading extends Widget {

    public function __construct(){
        parent::__construct();
        self::register_assets(array('css' => 'widget-global'));
    }

    public function widget($args, $instance)
    {
        $this->render('heading-widget', $instance);
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
    public function update($new_instance, $old_instance ) {

        $instance = array();

        $instance['heading_level'] = (int)$new_instance['heading_level'];
        $instance['text_align'] = (array_key_exists('text-align',$new_instance)) ? Validate::textalign($new_instance['text_align']) : 'left';
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

}
