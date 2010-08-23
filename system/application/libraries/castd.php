<?php

/**
 * 	Interface to castd, the WYBC podcasting daemon.
 * 	@package Castd
 * 	@author Sherwin Soltani
 * 	@version 0.1
 */

class Castd
{
    /**
     * 	Helper function for next function below, generates a directive 
     *	or empty string depending on whether $v is NULL
     */
    private function directive($d, $v)
    {
        if ($v == NULL)
        {
            return "";
        }
        return $d . " " . $v . "\n";
    }
    
    function export_directives($podcast, $entries)
    {
        $podcast = get_podcast($podcast_id);
        $entries = get_podcast_entries($podcast_id);
        $basestr = "channel\n";
        $basestr .= directive("title", $podcast['title']);
        $basestr .= directive("subtitle", $podcast['subtitle']);
        $basestr .= directive("description", str_replace("\n", "", $podcast['description']));
        $basestr .= directive("copyright", $podcast['copyright']);
        $basestr .= directive("language", $podcast['language']);
        $basestr .= directive("image", $podcast['image']);
        $basestr .= directive("link", $podcast['link']);
        foreach ($entries as $item)
        {
            $basestr .= "item\n";
            $basestr .= directive("title", $item['title']);
            $basestr .= directive("subtitle", $item['subtitle']);
            $basestr .= directive("description", $item['description']);
            $basestr .= directive("guid", $item['guid']);
            $basestr .= "file " . $item['file_size'] . " " . $item['file_link'];
            $basestr .= directive("duration", $item['duration']);
            $basestr .= directive("published", $item['timestamp']);
            $basestr .= directive("keywords", $item['keywords']);
        }
        return $basestr;
    }
}
?>
