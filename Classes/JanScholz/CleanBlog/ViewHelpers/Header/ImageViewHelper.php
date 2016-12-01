<?php
/**
 * Created by PhpStorm.
 * User: jan.scholz
 * Date: 30.11.16
 * Time: 22:06
 */

namespace JanScholz\CleanBlog\ViewHelpers\Header;

use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\Media\Domain\Model\Image;

class ImageViewHelper extends AbstractViewHelper
{
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

    private function prepareImageUri(Image $image)
    {
        $uri = new \TYPO3\Media\ViewHelpers\Uri\ImageViewHelper();
        $uri->setArguments(array('image' => $image));
        $uri->initializeArguments();
        $uri->controllerContext = $this->controllerContext;

        return $uri->render($image);
    }
}