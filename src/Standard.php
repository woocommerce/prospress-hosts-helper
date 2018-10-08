<?php
/**
 * @package  Prospress\Hosts
 * @category Class
 * @author   Jeremy Pry
 * @since    %VERSION%
 */

namespace Prospress\Hosts;

/**
 * Standard Host class.
 *
 * This is a catch-all class for hosts which have no special considerations that we know of.
 *
 * @package Prospress\Hosts
 */
class Standard implements HostInterface
{

    /**
     * Get the script timeout in seconds for this hosting provider.
     *
     * @return int
     */
    public function getTimeout()
    {
        return ini_get('max_execution_time');
    }
}
