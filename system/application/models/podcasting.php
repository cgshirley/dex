<?php

class Podcasting extends Model {

    public var $member_id;
    public var $podcast_id;
    public var $podcast_data;
    public var $entry_data;

    function Podcasting() {
        parent::Model();
    }

    // YOU MUST CONSTRUCT ADDITIONAL LIST PROCESSING :(
    // this function can only handle DB results, instead of
    // an arbitrary iterator, like LISP can.
    static function collect($result) {
        foreach ($result->result_array() as $row) {
            $retval[] = $row;
        }
        return $retval;
    }

    function get_podcast($id = NULL) {
        $this->db->from('podcasts');
        $this->db->where('id', ($id) ? $id : $this->podcast_id);
        $result = $this->db->get();
        $this->podcast_data = $result->row_array();
        return $this->podcast_data;
    }

    function get_member_podcasts() {
        $this->db->from('podcasts');
        $this->db->where('member_id', $this->member_id);
        $result = $this->db->get();
        $this->podcast_data = collect($result);
        return $this->podcast_data;
    }

    function get_podcasts_titled($title = NULL) {
            $sql = "SELECT * FROM podcasts WHERE title = ?;";
        }
        $this->db->from('podcasts');
        $this->db->where('title', ($title) ? $title : $this->podcast_data['title']);
        $result = $this->db->get();
        $this->podcast_data = collect($result);
        return $this->podcast_data;
    }

    function get_podcast_entries($id = NULL) {
        $this->db->from('podcast_entries');
        $this->db->where('podcast_id', ($id) ? $id : $this->podcast_id);
        $result = $this->db->get();
        $this->entry_data = collect($result);
        return $this->entry_data;
    }

    function add_podcast() {
        return $this->db->insert('podcasts', $this->podcast_data);
    }

    function add_podcast_entry() {
        return $this->db->insert('podcast_entries', $this->entry_data);
    }

    function delete_podcast_entry($id = NULL) {
        if ($id) {
            return $this->db->delete('podcast_entries', array('id' => $id));
        }
        return $this->db->delete('podcast_entries', $this->entry_data;
    }

    static function directive($d, $v) {
        if ($v == NULL) {
            return "";
        }
        return $d . " " . $v . "\n";
    }

    function export_directives($podcast_id = NULL) {
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
        foreach ($entries as $item) {
            $basestr .= "item\n";
            $basestr .= directive("title", $item['title']);
            $basestr .= directive("subtitle", $item['subtitle']);
            $basestr .= directive("description", $item['description']);
            $basestr .= directive("guid", $item['guid']);
            $basestr .= "file " . $item['file_length'] .  " " . $item['file_link'];
            $basestr .= directive("duration", $item['duration']);
            $basestr .= directive("published", $item['timestamp']);
            $basestr .= directive("keywords", $item['keywords']);
        }
        return $basestr;
    }
}
?>
