<?php

$input->Text('Title');
$input->Select('Heading level', range(1, 10, 1));
$input->Select('Text alignment', array('Left', 'Center', 'Right'), array('name' => 'text_align'));
