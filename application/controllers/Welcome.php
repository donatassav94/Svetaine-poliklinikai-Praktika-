<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Welcome extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('user_model');
		
	}
	
	
	public function index() 
	{
		$this->login();
	}
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('Prisijung_vardas', 'Prisijungimo vardas', 'trim|required|alpha_numeric|min_length[4]|is_unique[vartotojai.Prisijungimo_vardas]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('Vardas', 'Vardas', 'trim|required|alpha');
		$this->form_validation->set_rules('Pavarde', 'Pavardė', 'trim|required|alpha');
		$this->form_validation->set_rules('Spaudas', 'Spaudo nr.', 'trim|required|numeric');
		$this->form_validation->set_rules('Telefonas', 'Telefono numeris', 'trim|required|exact_length[9]|numeric');
		$this->form_validation->set_rules('Role', 'Rolė', 'trim|required|alpha');
		$this->form_validation->set_rules('email', 'Paštas', 'trim|required|valid_email|is_unique[vartotojai.Paštas]');
		$this->form_validation->set_rules('password', 'Slaptažodis', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Slaptažodzio patvirtinimas', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('welcome/welcomeheader');
			$this->load->view('welcome/register/register', $data);
			$this->load->view('welcome/welcomefooter');
			
		} else {
			
			// set variables from the form
			$Prisijung_vardas = $this->input->post('Prisijung_vardas');
			$Vardas   = $this->input->post('Vardas');
			$Pavarde   = $this->input->post('Pavarde');
			$Spaudas    = $this->input->post('Spaudas');
			$Telefonas   = $this->input->post('Telefonas');
			$Role   = $this->input->post('Role');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->user_model->create_user($Prisijung_vardas, $Vardas, $Pavarde, $Spaudas, $Telefonas, $Role, $email, $password)) {
				
				// user creation ok
				$this->load->view('welcome/welcomeheader');
				$this->load->view('welcome/register/register_success', $data);
				$this->load->view('welcome/welcomefooter');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('welcome/welcomeheader');
				$this->load->view('welcome/register/register', $data);
				$this->load->view('welcome/welcomefooter');
				
			}
			
		}
		
	}
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('Prisijung_vardas', 'Prisijungimo vardas', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Slaptažodis', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('welcome/welcomeheader');
			$this->load->view('welcome/login/login');
			$this->load->view('welcome/welcomefooter');
			
		} else {
			
			// set variables from the form
			$Prisijung_vardas = $this->input->post('Prisijung_vardas');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($Prisijung_vardas, $password)) {
				
				$user_id = $this->user_model->get_user_id_from_username($Prisijung_vardas);
				$user    = $this->user_model->get_user($user_id);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->Prisijungimo_vardas;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				
				
				// admin login ok
				if ($user->is_admin==1) 
				{
				$this->load->view('mainheader');
				$this->load->view('home', $data);
				$this->load->view('mainfooter');
				redirect('adminhome');
				}
				// user login ok
				else 
				{
				$this->load->view('mainheader');
				$this->load->view('home', $data);
				$this->load->view('mainfooter');
				redirect('home');
				}
				
				
				
			} else {
				
				// login failed
				$data->error = 'Neteisingas prisijungimo vardas arba slaptažodis';
				
				// send error to the view
				$this->load->view('welcome/welcomeheader');
				$this->load->view('welcome/login/login', $data);
				$this->load->view('welcome/welcomefooter');
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('welcome/welcomeheader');
			$this->load->view('welcome/logout/logout_success', $data);
			$this->load->view('welcome/welcomefooter');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
		
	}
	
}
