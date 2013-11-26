<?php
$left_margin = 100-$separator_width;
$left_margin = ($text_align == 'center') ? $left_margin/2 : $left_margin;
$style = ($text_align == 'left') ? '' : 'margin-left:'.$left_margin.'%';
echo '<hr style="width:'.$separator_width.'%; '.$style.';"/>'.PHP_EOL;
?>