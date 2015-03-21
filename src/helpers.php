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
        $json_filename = Container::getInstance()->make("path.public") . "/cachebuster.json";

        if(strlen(trim($file)) == 0)
        {
            throw new InvalidArgumentException("No file parameter given.");
        }

        if(is_null($json))
        {
            $json = [];
            if(file_exists($json_filename))
            {
                $json = json_decode(file_get_contents($json_filename), true);
            }
        }

        //echo "filename: " . $json_filename;

        $query_string = http_build_query($query_array);
        if(isset($json[$file]))
        {
            $query_string = $json[$file] . ((strlen($query_string) > 0) ? '&' . $query_string : '');
        }

        return $file . ((strlen($query_string) > 0) ? "?" . $query_string : '');

    }
}