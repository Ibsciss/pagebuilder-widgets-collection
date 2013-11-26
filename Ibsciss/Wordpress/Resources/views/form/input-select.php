<select id="<?php echo $id; ?>" name="<?php echo $name; ?>">
   <?php foreach($options as $option_value => $option): ?>
        <?php $option_value = (is_int($option_value)) ? mb_strtolower($option) : $option_value;  ?>
        <option <?php if ( $value ==  $option_value ) echo 'selected="selected"'; ?> value="<?php echo $option_value ?>"><?php echo $option ?></option>
   <?php endforeach; ?>
</select>