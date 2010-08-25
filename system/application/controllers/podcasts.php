<?php

class Podcasts extends Controller {

    public var $member_id;
    var $data;

    public function Podcasts() {
        parent::Controller();
        $this->load->helper('url');
        $this->auth->restrict('dj');
        $this->member_id = $this->session->userdata('member_id');
    }

    public function index() {
        $this->data['title'] = "Podcasts";
        $this->load->view('header', $this->data);
        $this->load->view('podcast/index', $this->data);
        $this->load->view('footer', $this->data);
    }

    /**
     * Interface function to the user for adding a podcast.
     * Sets some flashvars about success, failure, then redirects to the view screen */
    public function add() {
        if (!empty($_POST)) {
            $this->load->model('podcasting');
            $this->podcasting->podcast_data = array(
                'member_id' => $this->member_id,
                'title' => $_POST['title'],
                'subtitle' => $_POST['subtitle'],
                'description' => str_replace("\n", "<br />", $_POST['description']),
                'copyright' => $_POST['copyright'],
                'language' => $_POST['language'] ? $_POST['language'] : $this->config->item('default_language'),
                'image' => $_POST['image'],
                'link' => $_POST['link']);
            $result = $this->podcasting->add_podcast();
            if ($result) {
                $this->session->set_flashdata('success', "Podcast created.");
            } else {
                $this->session->set_flashdata('error', "Could not create podcast.");
            }
        } else {
            $this->session->set_flashdata('error', "No parameters specified.");
        }
        redirect('podcasts/view'); // redirect us to see all our podcasts, lol
    }

}
?>

