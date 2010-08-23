<?php

class Podcasting extends Model {

    public $podcast_data;
    public $entry_data;

    function Podcasting() {
        parent::Model();
    }

    // run once. supposed to not overwrite tables, but nonetheless,
    // run only once.
    function generate_tables() {
        $podcasts = "CREATE TABLE IF NOT EXISTS podcasts (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), member_id INT NOT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255), description VARCHAR(1024), copyright VARCHAR(255), language VARCHAR(64), image VARCHAR(255), link VARCHAR(255));";
        $entries = "CREATE TABLE IF NOT EXISTS entries (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), podcast_id INT NOT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255), description VARCHAR(1024), file_link VARCHAR(255), file_size INT, duration VARCHAR(255), timestamp DATETIME NOT NULL, guid VARCHAR(255), keywords VARCHAR(512));";
        return $this->db->query($podcasts) && $this->db->query($entries);
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

    // get the podcast with the given id, or the id set in $podcast_data
    function get_podcast($id = NULL) {
        $this->db->from('podcasts');
        $this->db->where('id', ($id) ? $id : $this->podcast_data['id']);
        $result = $this->db->get();
        $this->podcast_data = $result->row_array();
        return $this->podcast_data;
    }
    
    // get podcasts for the given member_id, or for the one set in $member_id
    // under the class variables if none is given to this function
    function get_member_podcasts($member_id = NULL) {
        $this->db->from('podcasts');
        $this->db->where('member_id', ($member_id) ? $member_id : $this->podcast_data['member_id']);
        $result = $this->db->get();
        $this->podcast_data = collect($result);
        return $this->podcast_data;
    }

    // get the podcasts with a specific title or else the title that is set
    // from $podcast_data
    function get_podcasts_titled($title = NULL) {
        $this->db->from('podcasts');
        $this->db->where('title', ($title) ? $title : $this->podcast_data['title']);
        $result = $this->db->get();
        $this->podcast_data = collect($result);
        return $this->podcast_data;
    }

    // retrieve all podcast entries under the given id, or if no id
    // is given, then it uses the id in $podcast_data['id']
    function get_podcast_entries($id = NULL) {
        $this->db->from('podcast_entries');
        $this->db->where('podcast_id', ($id) ? $id : $this->podcast_data['id']);
        $result = $this->db->get();
        $this->entry_data = collect($result);
        return $this->entry_data;
    }

    // add a podcast using the fields in $podcast_data
    function add_podcast() {
        return $this->db->insert('podcasts', $this->podcast_data);
    }

    // add a podcast entry using the fields in $entry_data
    function add_podcast_entry() {
        return $this->db->insert('podcast_entries', $this->entry_data);
    }

    // delete the podcast entry which goes by the given id, or if no id
    // is given, then deletes the one described by the information in
    // $entry_data
    function delete_podcast_entry($id = NULL) {
        if ($id) {
            return $this->db->delete('podcast_entries', array('id' => $id));
        }
        return $this->db->delete('podcast_entries', $this->entry_data);
    }

    // useful for entries where the file fields are a pain in the ass
    // this function will set the file_link, file_size, and optionally
    // the duration fields for you (you must commit the changes using add_podcast_entry)
    // it will not automatically determine file duration
    function set_entry_file($url, $duration = NULL) {
        $this->entry_data['file_link'] = $url;
        $this->entry_data['file_size'] = filesize($url);
        $this->entry_data['duration'] = $duration;
    }
}
?>
