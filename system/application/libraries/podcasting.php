<?php

/**
 * 	Interface to castd, the WYBC podcasting daemon.
 * 	@package Podcasting
 * 	@author Sherwin Soltani
 * 	@version 0.2
 */

class Podcasting
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
    
    /**
     * Write data into a file, but if all the data
     * is not written, then truncate the file
     * before closing.
     * @param string $stuff data to write
     * @param string $file path to file to write to
     * @return TRUE on success */
    private function write_out($stuff, $file)
    {
        $fp = fopen($file, "w");
        if (!$fp) {
            return FALSE;
        }
        $rv = fwrite($fp, $stuff);
        if ($rv == strlen($stuff)) {
            fclose($fp);
            return TRUE;
        } else {
            ftruncate($fp, 0);
            fclose($fp);
            return FALSE;
        }
    }

    /**
     * Export a podcast
     * @param $podcast_id primary key to the podcast table identifying the podcast
     * @return TRUE on success (file written)
     */
    function export($podcast_id)
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
        $filename = sprintf("podcast%d", $podcast_id);
        return write_out($basestr, $filename);
    }
}
?>
