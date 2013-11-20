<?php

namespace Ibsciss\Wordpress\Widgets;


use Ibsciss\Wordpress\Services\Validate;

class Separator extends Widget {

    public function __construct(){
        parent::__construct('Separator', 'Display a separator (hr tag)');
    }

    public function widget($args, $instance)
    {
        $this->render('separator-widget', $instance);
    }

    public function update($new_instance, $old_instance ) {

        $instance = array();

        $instance['separator_width'] = (int)$new_instance['separator_width'];
        $instance['text_align'] = (array_key_exists('text_align',$new_instance)) ? Validate::textalign($new_instance['text_align']) : 'left';

        return $instance;
    }

}