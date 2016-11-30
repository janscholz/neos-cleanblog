<?php
/**
 * Created by PhpStorm.
 * User: jan.scholz
 * Date: 25.11.16
 * Time: 20:29
 */

namespace JanScholz\CleanBlog\ViewHelpers;

use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

class BlogPostMetaViewHelper extends AbstractViewHelper
{

    private $monthMapping = array(1 => 'January', 2 => 'February', 3 => 'March',
        4 => 'April', 5 => 'May', 6 => 'June',
        7 => 'July', 8 => 'August', 9 => 'September',
        10 => 'October', 11 => 'November', 12 => 'December');

    public function render($node, $tag = 'span', $class = 'meta')
    {
        $date = $node->getCreationDateTime();
        $month = $this->monthMapping[intval($date->format('m'))];
        $day = intval($date->format('d'));
        $year = $date->format('Y');
        $format = '<%1$s class="%2$s">Posted by <a href="#">Start Bootstrap</a> on %3$s %4$d, %5$d</%1$s>';

        return sprintf($format, $tag, $class, $month, $day, $year);
    }
}