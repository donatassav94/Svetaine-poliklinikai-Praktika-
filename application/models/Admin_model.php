<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Admino  modelis */
class Admin_model extends CI_Model {

	/* Konstruktorius */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	/* Naujienos siuntimas į duomenų bazę */
	public function put_naujiena($antraste,$tekstas,$tipas) {
		
		$data = array(
			'Pavadinimas'   => $antraste,
			'Tekstas'   => $tekstas,
			'Tipas'   => $tipas,
			'Sukurimo_data' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('naujienos', $data);
		
	}
	
	/* Vartotojų sarašo gavimas naujienos kūrimo srityje */
	public function get_vartotoju_sarasa() {
		$query = $this->db->query("SELECT id,Vardas,Pavardė FROM vartotojai");
       
        return $query->result();
	}
	
	/* Paskutinės naujienos id gavimas*/
	public function get_last_id() {
		$this->db->select('id');
		$this->db->from('naujienos');
		$this->db->order_by("id", "desc");;
		$this->db->limit(1);
		return $this->db->get()->row('id');
		
	}
	
	/* Failo duomenų siuntimas į duomenų bazę */
	public function put_failo_duom($duom,$lastid) {
		$data = array(
			'Pavadinimas'   => $duom['file_name'],
			'Nuoroda'   => $duom['full_path'],
			'Talpa'   => $duom['file_size'],
			'idNaujienos' => $lastid,
		);
		
		return $this->db->insert('dokumentai', $data);
	}
	
	/* Ryšių sudarymas duomenų bazėje */
	public function put_rysys($value,$lastid) {
		$data = array(
			'naujienos_id'   => $lastid,
			'vartotojo_id'   => $value,
			'rodomas'   => 1,
			'perskaityta' => 0,
		);
		
		return $this->db->insert('ryšiai', $data);
	}
	
}
