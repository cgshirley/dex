<?php

class Podcasting extends Model {

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

    function get_podcast($id) {
        $sql = "SELECT * FROM podcasts WHERE id = ?;";
        $result = $this->db->query($sql, array($id));
        return $result->row_array();
    }

    function get_member_podcasts($member_id) {
        $sql = "SELECT * FROM podcasts WHERE member_id = ?;";
        $result = $this->db->query($sql, array($id));
        return collect($result);
    }

    function get_podcasts_titled($title, $use_like = FALSE) {
        if ($use_like) {
            $title = "%" . $this->db->escape_like_str($title) . "%";
            $sql = "SELECT * FROM podcasts WHERE title LIKE " . $title . ";";
        } else {
            $sql = "SELECT * FROM podcasts WHERE title = ?;";
        }
        $result = $this->db->query($sql, array($title));
        return collect($result);
    }

    function get_podcast_entries($id) {
        $sql = "SELECT * FROM podcast_entries WHERE id = ?;";
        $result = $this->db->query($sql, array($title));
        return collect($result);
    }

}
?>
