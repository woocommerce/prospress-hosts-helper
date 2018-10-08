<?php
/**
 * @package  Prospress\Hosts
 * @category Class
 * @author   Jeremy Pry
 * @since    %VERSION%
 */

namespace Prospress\Hosts;

/**
 * Siteground Host class.
 *
 * @package Prospress\Hosts
 */
final class Siteground extends Standard
{

    /**
     * Get the script timeout in seconds for this hosting provider.
     *
     * @return int
     */
    public function getTimeout()
    {
        return 120;
    }
}
