<?php
/**
 * @package  Prospress\Hosts
 * @category Interface
 * @author   Jeremy Pry
 * @since    %VERSION%
 */

namespace Prospress\Hosts;

/**
 * Kills Queries interface.
 *
 * Hosts that implement this interface include a query killer.
 *
 * @package Prospress\Hosts
 */
interface KillsQueries
{

    /**
     * Whether queries might be killed on this hosting provider.
     *
     * @return bool
     */
    public function areQueriesKilled();

    /**
     * Unhook code that is responsible for killing queries.
     *
     * @return bool Whether unhooking the query killing code was successful.
     */
    public function unhookQueryKiller();

    /**
     * Re-hook code that is responsible for killing queries.
     *
     * @return bool Whether re-hooking the query killing code was successful.
     */
    public function rehookQueryKiller();
}
