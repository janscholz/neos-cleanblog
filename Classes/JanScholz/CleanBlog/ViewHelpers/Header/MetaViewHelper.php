<?php
/**
 * Created by PhpStorm.
 * User: jan.scholz
 * Date: 25.11.16
 * Time: 20:29
 */

namespace JanScholz\CleanBlog\ViewHelpers\Header;

use TYPO3\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class MetaViewHelper extends AbstractTagBasedViewHelper
{
    private $monthMapping = array(1 => 'January', 2 => 'February', 3 => 'March',
        4 => 'April', 5 => 'May', 6 => 'June',
        7 => 'July', 8 => 'August', 9 => 'September',
        10 => 'October', 11 => 'November', 12 => 'December');

    public function initializeArguments() {
        $this->registerUniversalTagAttributes();
        $this->registerArgument('tag', 'string', 'Tag for to render for meta data');
    }

    public function render($node)
    {
        $date = $node->getCreationDateTime();
        $month = $this->monthMapping[intval($date->format('m'))];
        $day = intval($date->format('d'));
        $year = $date->format('Y');
        $format = 'Posted by <a href="#">Start Bootstrap</a> on %1$s %2$d, %3$d';

        $this->tag->setTagName($this->arguments['tag'] ? $this->arguments['tag'] : 'span');
        $this->tag->addAttribute('class', $this->arguments['class'] ? $this->arguments['class'] : 'meta');
        $this->tag->setContent(sprintf($format, $month, $day, $year));

        return $this->tag->render();
    }
}