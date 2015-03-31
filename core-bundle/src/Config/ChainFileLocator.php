<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Config;

use Symfony\Component\Config\FileLocatorInterface;

/**
 * Tries to locate resources using a given set of file locators.
 *
 * @author Andreas Schempp <https://github.com/aschempp>
 */
class ChainFileLocator implements FileLocatorInterface
{
    /**
     * @var FileLocatorInterface[]
     */
    private $locators = [];

    /**
     * Adds a file locator.
     *
     * @param FileLocatorInterface $locator The file locator
     */
    public function addLocator(FileLocatorInterface $locator)
    {
        $this->locators[] = $locator;
    }

    /**
     * {@inheritdoc}
     */
    public function locate($name, $currentPath = null, $first = false)
    {
        $files = [];

        foreach ($this->locators as $locator) {
            try {
                $file = $locator->locate($name, $currentPath, $first);

                if (true === $first) {
                    return $file;
                }

                $files = $this->mergeFiles(
                    (is_array($file) ? $file : [$file]),
                    $files
                );
            } catch (\InvalidArgumentException $e) {
                // Try the next locator
            }
        }

        if (false === $first) {
            return $files;
        }

        throw new \InvalidArgumentException("No locator was able to find $name");
    }

    /**
     * Adds new files to existing array without overwriting existing keys, except if they are numeric.
     *
     * @param array $newFiles The files to be added
     * @param array $allFiles The existing files
     *
     * @return array Merged list of files
     */
    private function mergeFiles(array $newFiles, array $allFiles)
    {
        foreach ($newFiles as $k => $v) {
            if (is_numeric($k)) {
                $allFiles[] = $v;
            } elseif (!isset($allFiles[$k])) {
                $allFiles[$k] = $v;
            }
        }

        return $allFiles;
    }
}
