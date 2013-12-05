<?php
$linked = (isset($link) &&!empty($link)) ? true : false;
$legended = (isset($legend) && !empty($legend)) ? true : false;
$under = ($legend_position == 'above') ? false : true;
$stronger = (isset($strong) && !empty($strong)) ? true : false;
$emphasized = (isset($emphasis) && !empty($emphasis)) ? true : false;
$text_align = 'pbwc-'.$legend_text_align;

$legend_txt = '';
if(isset($legend) && !empty($legend)){
    $legend_txt .= '<p class="'.$text_align.'">';
    $legend_txt .= ($stronger) ? '<strong>' : '';
    $legend_txt .= ($emphasized) ? '<em>' : '';
    $legend_txt .= $legend;
    $legend_txt .= ($emphasized) ? '</em>' : '';
    $legend_txt .= ($stronger) ? '</strong>' : '';
    $legend_txt .= '</p>';
}
?>

<?php if($linked) echo '<a href="'.$link.'">';
if(!$under) echo $legend_txt; ?>

<img src="<?php echo $image_url; ?>" alt="<?php echo $alternative_text; ?>" />

<?php if($under) echo $legend_txt;
if($linked) echo '</a>'; ?>