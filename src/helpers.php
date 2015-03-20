<?php

use Illuminate\Container\Container;

if ( ! function_exists('asset_url'))
{
    /**
     * Similar to elixir(), outputs a URL with cache busting except as a query string instead of
     * a custom filename.
     * @param   string  $file           The string of the file name to output.
     * @param   array   $query_array    An associative array of parameters to append to the URL.
     * @return string
     */
    function asset_url($file, $query_array = array())
    {
        static $json = null;
        static $json_filename = Container::getInstance()->make("path.public") . "/cachebuster.json";

        if(strlen(trim($file)) == 0)
        {
            throw new InvalidArgumentException("No file parameter given.");
        }

        if(file_exists($json_filename))
        {
            $json = json_decode(file_get_contents($json_filename), true);
            if(isset($json[$file]))
            {
                $query_array[$json[$file]] = $json[$file];
            }
        }

        return "{$file}?" . http_build_query($query_array);
    }
}