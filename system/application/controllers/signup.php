<?php
/*
*	Note: create new table
*
*	CREATE TABLE `wybc`.`signup` (
*		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
*		`name` VARCHAR( 255 ) NOT NULL ,
*		`email` VARCHAR( 255 ) NOT NULL
*		) ENGINE = MYISAM ;
*
*/
class Signup extends Controller {

    var $data;

    function __construct() {
        parent::__construct();
        $this->auth->restrict(20);
        $this->data['js'][] = "jquery-datatables.php";
        $this->data['css'][] = "datatables.css";
    }

    public function index() {
        $this->data['title'] = "WYBC Sign Up!";
        $this->data['signups'] = $this->get_all();
        $this->load->view('header', $this->data);
        $this->load->view('signup/list', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function submit() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $interests = $_POST['interests'];
        $rv = $this->db->insert('signup', array('name' => $name, 'email' => $email, 'interests' => $interests));
        if ($rv) {
            $this->session->set_flashdata('success', "Your name has been added.");
        } else {
            $this->session->set_flashdata('error', "Could not add entry to the database.");
        }
        redirect('signup/index');
    }

    public function remove() {
        $name = $_POST['name'];
        $rv = $this->db->delete('signup', array('name' => $name));
        if ($rv) {
            $this->session->set_flashdata('success', "The selected name has been removed.");
        } else {
            $this->session->set_flashdata('error', "The selected name could not be removed.");
        }
        redirect('signup/index');
    }

    private function get_all() {
        $this->db->select('name, email');
        $result = $this->db->get('signup');
        return $result->result_array();
    }

    public function reset() {
        $this->db->query("DROP TABLE IF EXISTS signup;");
        $this->db->query("CREATE TABLE IF NOT EXISTS signup (id INT NOT NULL, PRIMARY KEY(id), name VARCHAR(255), email VARCHAR(255), interests VARCHAR(1024));");
    }

}
?>
