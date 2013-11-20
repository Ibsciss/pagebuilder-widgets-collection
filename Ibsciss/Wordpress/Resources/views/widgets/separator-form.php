<p>
    <label for="<?php echo $widget->get_field_id( 'separator_width' ); ?>">Width</label>
    <select id="<?php echo $widget->get_field_id( 'separator_width' ); ?>" name="<?php echo $widget->get_field_name( 'separator_width' ); ?>">
        <?php for($i = 50; $i <= 100; $i = $i+5): ?>
            <option <?php if ( $i ==  $separator_width ) echo 'selected="selected"'; ?> value="<?php echo $i ?>"><?php echo $i ?> %</option>
        <?php endfor;?>
    </select></p>

<p>
    <label for="<?php echo $widget->get_field_id( 'text_align' ); ?>">Separator alignment</label>
    <select id="<?php echo $widget->get_field_id( 'text_align' ); ?>" name="<?php echo $widget->get_field_name( 'text_align' ); ?>">
        <option <?php if ( 'left' ==  $text_align ) echo 'selected="selected"'; ?> value="left">Left</option>
        <option <?php if ( 'center' ==  $text_align ) echo 'selected="selected"'; ?> value="center">Center</option>
        <option <?php if ( 'right' ==  $text_align ) echo 'selected="selected"'; ?> value="right">Right</option>
    </select>
</p>