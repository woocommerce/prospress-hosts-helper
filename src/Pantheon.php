<?php
/**
 * @package    Prospress\Hosts
 * @category   Class
 * @author     Jeremy Pry
 * @since      %VERSION%
 */

namespace Prospress\Hosts;

/**
 * Pantheon Host class.
 *
 * @package Prospress\Hosts
 */
final class Pantheon extends Standard
{

    /**
     * Get the script timeout in seconds for this hosting provider.
     *
     * @return int
     */
    public function getTimeout()
    {
        return 60;
    }
}
