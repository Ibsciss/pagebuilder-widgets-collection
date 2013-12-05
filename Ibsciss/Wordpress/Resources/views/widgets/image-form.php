<strong>Image</strong>
<?php
$input->Text('Title');
$input->Text('Image\'s url', array('name' => 'image_url'));
$input->Text('Alternative text');
$input->Text('Link');
?>
<strong>Legend</strong>
<?php
$input->Text('Legend');
$input->Select('Legend position', array('under' => 'under image','above' => 'above image'));
?> Legend text style : <?php
$input->Checkbox('Strong');
$input->Checkbox('Emphasis');
$input->Select('Legend text align', array('center', 'left', 'right'));