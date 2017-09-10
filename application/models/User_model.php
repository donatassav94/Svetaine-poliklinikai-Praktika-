<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	/**
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function create_user($Prisijung_vardas, $Vardas, $Pavarde, $Spaudas, $Telefonas, $Role, $email, $password) {
		
		$data = array(
			'Prisijungimo_vardas'   => $Prisijung_vardas,
			'Vardas'   => $Vardas,
			'Pavardė'   => $Pavarde,
			'Spaudo_nr'   => $Spaudas,
			'Telefonas'   => $Telefonas,
			'Rolė'   => $Role,
			'Paštas'      => $email,
			'password'   => $this->hash_password($password),
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('vartotojai', $data);
		
	}
	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($Prisijung_vardas, $password) {
		
		$this->db->select('password');
		$this->db->from('vartotojai');
		$this->db->where('Prisijungimo_vardas', $Prisijung_vardas);
		$hash = $this->db->get()->row('password');
		
		return $this->verify_password_hash($password, $hash);
		
	}
	
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @return int the user id
	 */
	public function get_user_id_from_username($Prisijung_vardas) {
		
		$this->db->select('id');
		$this->db->from('vartotojai');
		$this->db->where('Prisijungimo_vardas', $Prisijung_vardas);
		return $this->db->get()->row('id');
		
	}
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($user_id) {
		
		$this->db->from('vartotojai');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
		
	}
	
	/**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}
	
	/* Bendrų naujienų gavimas iš duomenų bazės */
	public function get_naujienos() {
		$this->db->select('*');
		$this->db->from('naujienos');
		$this->db->where('tipas',1);
	 	$query = $this->db->get();
		
		return $result = $query->result_array(); 
	}
	
	/* Asmeninių naujienų id pagal vartotojo id gavimas iš duomenų bazės */
	public function get_asm_naujienasid() {
		$this->db->select('naujienos_id,perskaityta');
		$this->db->from('ryšiai');
		$this->db->where('vartotojo_id', $_SESSION['user_id']);
		$this->db->where('rodomas',1);
	 	$query = $this->db->get();
		
		return $result = $query->result_array(); 
	}
	/* Asmeninių naujienų id pagal vartotojo id gavimas iš duomenų bazės(mainheader, nes ten rodomos tik neperskaitytos) */
	public function get_asm_naujienasid_mainheader() {
		$this->db->select('naujienos_id,perskaityta');
		$this->db->from('ryšiai');
		$this->db->where('vartotojo_id', $_SESSION['user_id']);
		$this->db->where('rodomas',1);
		$this->db->where('perskaityta',0);
	 	$query = $this->db->get();
		
		return $result = $query->result_array(); 
	}
	/* Asmeninių naujienų surinkimas pagal id iš duomenų bazės */
	public function get_asm_naujienas($naujid) {
		$this->db->select('id,Pavadinimas,Tekstas,Sukurimo_data');
		$this->db->from('naujienos');
		$this->db->where_in('id', $naujid);
	 	$query = $this->db->get();
		return $result = $query->result_array();       
	}
	/* failu atrinkimas*/
	public function get_failus($idsarasas) {
		$this->db->select('*');
		$this->db->from('dokumentai');
		$this->db->where_in('idNaujienos', $idsarasas);
	 	$query = $this->db->get();
		return $result = $query->result_array();       
	}
	/*Gauti konkrečią naujieną iš duomenų bazės */
	public function get_viena_naujiena($kelinta) {
		$this->db->select('id,Pavadinimas,Tekstas,Sukurimo_data');
		$this->db->from('naujienos');
		$this->db->where('id', $kelinta['kelinta'][1]);
	 	$query = $this->db->get();
		return $result = $query->result_array();       
	}
	/* Naujienos pažymėjimas kaip perskaitytos*/
	public function put_perskaityta($kelinta) {
		$updateData=array("perskaityta"=>"1");
		$this->db->where('naujienos_id', $kelinta['kelinta'][1]);
		$this->db->where('vartotojo_id', $_SESSION['user_id']);
		$this->db->update('ryšiai', $updateData);
		
	}
}
