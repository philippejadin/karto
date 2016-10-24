<?php

/*
 * This file is part of Laravel Service Provider.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\ServiceProvider\Loader;

use InvalidArgumentException;

class ViewLoader extends Loader
{
    /**
     * Get the source asset directory to publish.
     *
     * @param string $packagePath
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/views",
            "{$packagePath}/views",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return $source;
            }
        }

        throw new InvalidArgumentException('Views not found.');
    }
}
