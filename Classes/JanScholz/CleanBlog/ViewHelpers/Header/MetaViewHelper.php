<?php
namespace JanScholz\CleanBlog\ViewHelpers\Header;
/*
 * This file is part of the JanScholz.CleanBlog package.
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * Renders the meta subheadline of the blog post and blog list item of a given TYPO3.TYPO3CR.Domain.Model node instance
 *
 * = Examples =
 *
 * <code title="Rendering the meta subheadline">
 * {janscholz.cleanblog:header.meta(node: nodeObject)}
 * </code>
 * <output>
 * (depending on the node)
 * <span class="meta">Posted by <a href="#">Start Bootstrap</a> on November 26, 2016</span>
 * </output>
 *
 * <code title="Rendering the meta subheadline with tag and/or css class">
 * {janscholz.cleanblog:header.meta(node: nodeObject, tag: 'p', class: 'post-meta')}
 * </code>
 * <output>
 * (depending on the node)
 * <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on November 26, 2016</p>
 * </output>
 *
 *
 * @see \JanScholz\CleanBlog\ViewHelpers\Header\MetaViewHelper
 */
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

    public function render(NodeInterface $node)
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