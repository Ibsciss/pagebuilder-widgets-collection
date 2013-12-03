<?php
$fontWeight = 'pbwc-'.$font_weight;
$notUnderline = (!isset($underline) || empty($underline)) ? ' pbwc-no-underline ' : ''; 
$openNew = (isset($new_window) && !empty($new_window)) ? 'target="_blank"' : '';
?>
<asid class="pbwc-box pbwc-light-dashed">
    <strong class="<?php echo $fontWeight ?>">
        <a class="<?php echo $notUnderline ?> pbwc-simple-cta-text" <?php echo $openNew ?> href="<?php echo $title_url ?>" >
            <?php echo $title ?>
        </a>
    </strong>
</asid>