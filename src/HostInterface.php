<?php
/**
 * @package  Prospress\Hosts
 * @category Interface
 * @author   Jeremy Pry
 * @since    %VERSION%
 */

namespace Prospress\Hosts;

/**
 * Host Interface
 *
 * Describe a method for determining information about the current hosting provider.
 */
interface HostInterface
{

    /**
     * Get the script timeout in seconds for this hosting provider.
     *
     * @return int
     */
    public function getTimeout();
}
