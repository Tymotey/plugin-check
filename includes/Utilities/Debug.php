<?php

/**
 * Class WordPress\Plugin_Check\Utilities
 *
 * @package plugin-check
 */

namespace WordPress\Plugin_Check\Utilities;

/**
 * Class providing utility methods to return plugin information based on the request.
 *
 * @since 1.0.0
 */
class Debug
{
    protected static $debug;
    protected static $debug_file;

    function __construct($debug)
    {
        $this->set_debug($debug);

        if ($debug === 'true') {
            $this->prepare_debug_file();
        }
    }

    /**
     * Set debug file.
     *
     * @since 1.0.0 //TODO: correct version
     *
     */
    final public function set_debug_file($value)
    {
        $this->debug_file = $value;
    }

    /**
     * Get debug file.
     *
     * @since 1.0.0 //TODO: correct version
     *
     * @return string Debug state.
     */
    final public function get_debug_file()
    {
        return $this->debug_file;
    }

    /**
     * Set debug state.
     *
     * @since 1.0.0 //TODO: correct version
     *
     */
    final public function set_debug($state)
    {
        $this->debug = $state;
    }

    /**
     * Get debug state.
     *
     * @since 1.0.0 //TODO: correct version
     *
     * @return string Debug state.
     */
    final public function get_debug()
    {
        return $this->debug;
    }

    function prepare_debug_file()
    {
        $name = apply_filters('pcp_log_name', date('Y-m-d-H-i-s'));

        // Make sure directory exists.
        if (!is_dir(WP_PLUGIN_CHECK_PLUGIN_DIR_LOGS)) {
            mkdir(WP_PLUGIN_CHECK_PLUGIN_DIR_LOGS);
        }

        $this->set_debug_file(WP_PLUGIN_CHECK_PLUGIN_DIR_LOGS . '/' . $name . '.log');
    }

    public function write_debug_file($text)
    {
        if ($this->get_debug() === 'true') {
            error_log($text . "\n", 3, $this->get_debug_file());
        }
    }
}
