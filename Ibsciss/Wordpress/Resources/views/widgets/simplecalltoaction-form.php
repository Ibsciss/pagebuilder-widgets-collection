<?php
$input->Text('Title');
$input->Text('Title\'s url', array('name' => 'title_url'));
$input->Checkbox('Open in new window ?', array('name' => 'new_window'));
$input->Checkbox('Underline the link ?', array('name' => 'underline'));
$input->Select('Font weight', array('light', 'normal', 'bold', 'bolder'));
