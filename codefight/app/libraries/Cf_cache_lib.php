<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_cache_lib
{
    var
        $cache_dir = APPPATH . 'cache',//default cache write directory
        $allow_empty = true, //default flag to allow empty cache (will check for empty data or empty array if array)
        $cache_ext = '.cfcache', //default cache file extension (default ".cfcache")
        $cache_header = '', //default cache header data (default: "")
        $cache_lifetime = 86400 //default cache default lifetime in seconds (default 24 hours: "86400")
    ;

    public function __construct()
    {
        define("CACHE_DIR", $this->cache_dir);
        define("ALLOW_EMPTY", $this->allow_empty);
        define("CACHE_EXT", $this->cache_ext);
        define("CACHE_HEADER", $this->cache_header);
        define("CACHE_LIFETIME", $this->cache_lifetime);
    }


    /**
     * Cache write directory
     *
     * @var string
     */
    private static $_cache_dir = CACHE_DIR;
    private static $cache_ext = CACHE_EXT;

    /**
     * Allow empty cache flag
     *
     * @var bool
     */
    private static $_cache_empty_allowed = ALLOW_EMPTY;

    /**
     * Cache header data
     *
     * @var string
     */
    private static $_cache_header = CACHE_HEADER;

    /**
     * Cache lifetime seconds
     *
     * @var int
     */
    private static $_cache_lifetime = CACHE_LIFETIME;

    /**
     * Cache filename getter
     *
     * @param string $cache_id
     * @param bool $static_naming
     * @return string
     */
    private static function _getCacheFilename($cache_id = null, $static_naming = false) {
        // check for subdir
        $subdir = null;
        if(strpos($cache_id, "/") !== false) {
            $subdir = substr($cache_id, 0, (strrpos($cache_id, "/") + 1));
            $cache_id = substr($cache_id, (strrpos($cache_id, "/") + 1), strlen($cache_id));
        }

        return self::$_cache_dir . $subdir . ( $static_naming ? rawurlencode($cache_id) : rawurlencode(md5($_SERVER["REQUEST_URI"])
            . ( $cache_id !== null ? "-{$cache_id}" : null )) ) . CACHE_EXT;
    }

    /**
     * Flush cache file
     *
     * @param string $cache_id
     * @param bool $static_naming
     */
    public static function flush($cache_id = null, $static_naming = false) {
        // check if file cached
        if(self::isCached($cache_id, $static_naming)) {
            // flush cache file
            unlink(self::_getCacheFilename($cache_id, $static_naming));
        }
    }

    /**
     * Flush all cache files
     */
    public static function flushCacheFiles() {
        array_map("unlink", glob(self::$_cache_dir . "*" . $cache_ext));
    }

    /**
     * Cache file content getter
     *
     * @param mixed $cache_id
     * @param bool $unserialize
     * @param bool $static_naming
     * @return string
     */
    public static function get($cache_id = null, $unserialize = false, $static_naming = false) {
        // check if caching is on
        if((int)self::$_cache_lifetime > 0) {
            // check if cache file exists
            if(self::isCached($cache_id, $static_naming)) {
                // check if cache is not expired
                if( (time() - filemtime(self::_getCacheFilename($cache_id, $static_naming))) < self::$_cache_lifetime ) {
                    // return cache file
                    return $unserialize ? unserialize(file_get_contents(self::_getCacheFilename($cache_id, $static_naming)))
                        : file_get_contents(self::_getCacheFilename($cache_id, $static_naming));
                // cache file has expired
                } else {
                    // flush cache file
                    self::flush($cache_id, $static_naming);
                }
            }
        }

        // no cache file
        return null;
    }

    /**
     * Cache file exists getter
     *
     * @param mixed $cache_id
     * @param bool $static_naming
     * @return bool
     */
    public static function isCached($cache_id = null, $static_naming = false) {
        return file_exists(self::_getCacheFilename($cache_id, $static_naming));
    }

    /**
     * Cache directory setter
     *
     * @param string $cache_directory
     */
    public static function setCacheDir($cache_directory = null) {
        self::$_cache_dir = $cache_directory;
    }

    /**
     * Cache header data setter
     *
     * @param string $header_data
     */
    public static function setCacheHeader($header_data = null) {
        self::$_cache_header = $header_data;
    }

    /**
     * Cache lifetime setter (0 will turn caching off)
     *
     * @param int $cache_lifetime (seconds)
     */
    public static function setCacheLifetime($cache_lifetime = 0) {
        self::$_cache_lifetime = (int)$cache_lifetime;
    }

    /**
     * Cache file writer
     *
     * @param mixed $content
     * @param string $cache_id
     * @param bool $serialize
     * @param bool $static_naming
     * @return bool
     */
    public static function write($content = null, $cache_id = null, $serialize = false, $static_naming = false) {
        // check if caching is on
        if((int)self::$_cache_lifetime > 0) {
            // check if empty cache is allowed
            if(!self::$_cache_empty_allowed) {
                // empty cache not allowed, check if cache content is empty
                if(!is_array($content) && !$content || is_array($content) && !count($content)) {
                    // cache is empty, do not write empty cache (not allowed)
                    return false;
                }
            }

            // check for subdir
            $subdir = null;
            if(strpos($cache_id, "/") !== false) {
                $parts = explode("/", $cache_id);
                if(count($parts) > 1) {
                    $cache_id_rem = array_pop($parts);
                }
                // create dirs if needed
                foreach($parts as $dir) {
                    if($dir !== null) {
                        if(!is_dir(self::$_cache_dir . $subdir . $dir) ) mkdir(self::$_cache_dir . $subdir . $dir);
                        $subdir .= "{$dir}/";
                    }
                }
            }

            // check if cache directory writable
            if(is_writable(self::$_cache_dir . $subdir)) {
                // write cache file (with cache header data)
                return file_put_contents(self::_getCacheFilename($cache_id, $static_naming),
                    self::$_cache_header . ( $serialize ? serialize($content) : $content )) ? true : false;
            // cache directory not writable
            } else {
                trigger_error("Failed to write cache file, cache directory \""
                    . self::$_cache_dir . "\" is not writable (" . __METHOD__ . ")", E_USER_WARNING);
            }
        }
    }
}