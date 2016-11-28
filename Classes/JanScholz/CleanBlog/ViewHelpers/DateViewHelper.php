<?php
/**
 * Created by PhpStorm.
 * User: jan.scholz
 * Date: 25.11.16
 * Time: 20:29
 */

namespace JanScholz\CleanBlog\ViewHelpers;

use DateTime;

class DateViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

    private $monthMapping = array(1 => 'January', 2 => 'February', 3 => 'March' ,
        4 => 'April' , 5 => 'May' , 6 => 'June' ,
        7 => 'July' , 8 => 'August' , 9 => 'September',
        10 => 'October', 11 => 'November', 12 => 'December');

    public function render($date) {
        $month = $this->monthMapping[intval($date->format('m'))];
        $day = intval($date->format('d'));
        $year = $date->format('Y');

        return $month . ' ' . $day . ', ' . $year;
    }
}