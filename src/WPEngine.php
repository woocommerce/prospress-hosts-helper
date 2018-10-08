<?php
/**
 * @package  Prospress\Hosts
 * @category Class
 * @author   Jeremy Pry
 * @since    %VERSION%
 */

namespace Prospress\Hosts;

/**
 * WP Engine Host Class.
 *
 * @package Prospress\Hosts
 */
final class WPEngine implements HostInterface, KillsQueries
{

    /**
     * Whether queries might be killed on this hosting provider.
     *
     * @return bool
     */
    public function areQueriesKilled()
    {
        return class_exists('WPE_Query_Governator') && (!defined(WPE_GOVERNOR) || WPE_GOVERNOR);
    }

    /**
     * Unhook code that is responsible for killing queries.
     *
     * @return bool Whether unhooking the query killing code was successful.
     */
    public function unhookQueryKiller()
    {
        if (!class_exists('WPE_Query_Governator')) {
            return false;
        }

        return remove_filter('query', array(WPE_Query_Governator::instance(), 'check_and_govern'));
    }

    /**
     * Re-hook code that is responsible for killing queries.
     *
     * @return bool Whether re-hooking the query killing code was successful.
     */
    public function rehookQueryKiller()
    {
        if (!class_exists('WPE_Query_Governator')) {
            return false;
        }

        return add_filter('query', array(WPE_Query_Governator::instance(), 'check_and_govern'));
    }

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
