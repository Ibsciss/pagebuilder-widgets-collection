<?php
/**
 * Created by PhpStorm.
 * User: saasbook
 * Date: 19/11/13
 * Time: 15:50
 */

namespace Ibsciss\Wordpress\Services;


class Validate {

    /**
     * @param string $textalign to validate input
     * @param string $default default if validation fail
     * @return string
     */
    public static function textalign($textalign, $default = 'left')
    {
        $correct_value = array('center', 'right', 'left');
        return (in_array($textalign, $correct_value)) ? $textalign : $default;
    }
    
    public static function AboveOrUnder($aboveOrUnder, $default = 'under')
    {
        $correct_value = array('above','under');
        return (in_array($aboveOrUnder, $correct_value)) ? $aboveOrUnder : $default;
    }
} 