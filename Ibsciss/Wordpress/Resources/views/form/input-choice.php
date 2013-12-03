<?php 
    $i = 0;
    foreach($options as $radio_value => $text_value):
    $radio_value = (is_int($radio_value)) ? mb_strtolower($text_value) : $radio_value;
    $i++;
?>
     <input id="<?php echo $id.$i ?>" name="<?php echo $name ?>" type="radio" value="<?php echo $radio_value; ?>" <?php if ( $value ==  $radio_value ){ echo 'checked="checked"'; }?> /><?php echo $text_value ?>
<?php endforeach; ?>
