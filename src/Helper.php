<?php
/**
 * @package  Prospress\Hosts
 * @category Class
 * @author   Jeremy Pry
 * @since    %VERSION%
 */

namespace Prospress\Hosts;

/**
 * Factory for getting the class for the current host.
 *
 * @package Prospress\Hosts
 */
final class Helper
{
    /**
     * The instance of our hosts class.
     *
     * @var HostInterface
     */
    private static $instance = null;

    /**
     * Get the Host instance based on the current host
     *
     * @return HostInterface|KillsQueries
     */
    public static function getHost()
    {
        if (null !== self::$instance) {
            return self::$instance;
        }

        if (defined('WPENGINE_ACCOUNT')) {
            $class = __NAMESPACE__ . '\\WPEngine';
        } elseif (defined('PANTHEON_ENVIRONMENT')) {
            $class = __NAMESPACE__ . '\\Pantheon';
        } elseif (false !== strpos(getenv('HOSTNAME'), '.siteground.')) {
            $class = __NAMESPACE__ . '\\Siteground';
        } else {
            $class = __NAMESPACE__ . '\\Standard';
        }

        self::$instance = new $class();

        return self::$instance;
    }

    /**
     * Determine whether DB queries are killed on the current host.
     *
     * @return bool
     */
    public static function areQueriesKilled()
    {
        if (!class_implements(self::getHost(), __NAMESPACE__ . '\\KillsQueries')) {
            return false;
        }

        return self::getHost()->areQueriesKilled();
    }
}
