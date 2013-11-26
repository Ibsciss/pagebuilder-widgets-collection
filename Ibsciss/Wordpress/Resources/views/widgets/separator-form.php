<?php
$input->Select('Width (%)', range(50, 100, 5), array(
    'name' => 'separator_width', 
    'default_value' => 75
));

$input->Select('Text alignment', array('Left', 'Center', 'Right'), array(
    'name' => 'text_align',
    'default_value' => 'center'
));