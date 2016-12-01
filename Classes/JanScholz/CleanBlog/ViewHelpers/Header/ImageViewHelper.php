<?php
namespace JanScholz\CleanBlog\ViewHelpers\Header;
/*
 * This file is part of the JanScholz.CleanBlog package.
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\Media\Domain\Model\ImageInterface;

/**
 * Renders the src path of the header background image of a given TYPO3.TYPO3CR.Domain.Model node instance or his parents
 *
 * = Examples =
 *
 * <code title="Rendering an image path as-is">
 * {janscholz.cleanblog:header.image(node: nodeObject)}
 * </code>
 * <output>
 * (depending on the node)
 * _Resources/Persistent/b29[...]95d.jpeg
 * </output>
 *
 *
 * @see \JanScholz\CleanBlog\ViewHelpers\Header\ImageViewHelper
 */

class ImageViewHelper extends AbstractViewHelper
{

    /**
     * Renders the path to an image, created from a given node or his parents.
     *
     * @param NodeInterface $node
     * @return string the relative image path, to be used as src attribute for <img /> tags
     */
    public function render(NodeInterface $node)
    {
        $headerImageUri = null;

        if ($node->getProperty('headerImage'))
        {
            $headerImageUri = $this->prepareImageUri($node->getProperty('headerImage'));
        }
        else
        {
            do {
                if ($node->getProperty('headerImage'))
                {
                    $headerImageUri = $this->prepareImageUri($node->getProperty('headerImage'));
                    break;
                }
            } while ($node = $node->getParent());
        }

        return $headerImageUri;
    }

    private function prepareImageUri(ImageInterface $image)
    {
        $uri = new \TYPO3\Media\ViewHelpers\Uri\ImageViewHelper();
        $uri->setArguments(array('image' => $image));
        $uri->initializeArguments();
        $uri->controllerContext = $this->controllerContext;

        return $uri->render($image);
    }
}