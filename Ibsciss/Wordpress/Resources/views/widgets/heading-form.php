<p>
    <label for="<?php echo $widget->get_field_id( 'title' ); ?>">Title</label>
    <input id="<?php echo $widget->get_field_id( 'title' ); ?>" name="<?php echo $widget->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id( 'heading_level' ); ?>">Heading level</label>
    <select id="<?php echo $widget->get_field_id( 'heading_level' ); ?>" name="<?php echo $widget->get_field_name( 'heading_level' ); ?>">
        <?php for($i = 1; $i <= 10; $i++): ?>
            <option <?php if ( $i ==  $heading_level ) echo 'selected="selected"'; ?> value="<?php echo $i ?>">Heading level <?php echo $i ?></option>
        <?php endfor;?>
    </select>
</p>

<p>
    <label for="<?php echo $widget->get_field_id( 'text_align' ); ?>">Text alignment</label>
    <select id="<?php echo $widget->get_field_id( 'text_align' ); ?>" name="<?php echo $widget->get_field_name( 'text_align' ); ?>">
            <option <?php if ( 'left' ==  $text_align ) echo 'selected="selected"'; ?> value="left">Left</option>
            <option <?php if ( 'center' ==  $text_align ) echo 'selected="selected"'; ?> value="center">Center</option>
            <option <?php if ( 'right' ==  $text_align ) echo 'selected="selected"'; ?> value="right">Right</option>
    </select>
</p>