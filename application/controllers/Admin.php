<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	 public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('admin_model');
		$this->load->model('user_model');
		
	}
	public function index()
	{
			$this->home();
	}
	public function home()
	{
			//-----NUO ČIA Kodas asmeniniu naujienu surinkimui(Mainheaderi) 
		
			$rysiai['rysiai']=$this->user_model->get_asm_naujienasid_mainheader();//Surenkam ryšius pagal vartotojo id(su perskaityta ar ne)
			
			if (!empty($rysiai['rysiai']))
			{
			$naujid = array();
			//Surenkam asmeniniu naujienų id iš $ryšiai į masyvą siuntimui į funkciją surinkti asmenines naujienas pagal id.
			foreach($rysiai['rysiai'] as $row)
			{
        		$naujid[] = $row['naujienos_id'];
    		}
			$naujienos['asmnew']=$this->user_model->get_asm_naujienas($naujid);//Siunčiam asmeninių naujienų id ir surenkam asmenines naujienas
			}
			else 
			{
				$naujienos['asmnew']=array();
			}

			//-----IKI ČIA Kodas asmeniniu naujienu surinkimui(Mainheaderi) 
			$duom['naujiena']=$this->user_model->get_naujienos();//Surenkam bendras naujienas
			//Surenkam bendrų naujienų id iš $data į masyvą siuntimui į funkciją surinkti failus toms naujienoms
			foreach($duom['naujiena'] as $row)
			{
        		$idsarasas[] = $row['id'];
    		}
			$failai['failai']=$this->user_model->get_failus($idsarasas);//Surenkam failus pagal naujienu id
			//var_dump($failai);
			//var_dump($idsarasas);
			$this->load->view('mainheader',array_merge($naujienos,$rysiai));
			$this->load->view('home',array_merge($duom,$failai));
			$this->load->view('mainfooter');
	}
	
	
	//Naujienos ir failo įkėlimas siuntimas į db.
	public function naujiena()
	{
		//-----NUO ČIA Kodas asmeniniu naujienu surinkimui(Mainheaderi) 
		
			$rysiai['rysiai']=$this->user_model->get_asm_naujienasid_mainheader();//Surenkam ryšius pagal vartotojo id(su perskaityta ar ne)
			
			if (!empty($rysiai['rysiai']))
			{
			$naujid = array();
			//Surenkam asmeniniu naujienų id iš $ryšiai į masyvą siuntimui į funkciją surinkti asmenines naujienas pagal id.
			foreach($rysiai['rysiai'] as $row)
			{
        		$naujid[] = $row['naujienos_id'];
    		}
			$naujienos['asmnew']=$this->user_model->get_asm_naujienas($naujid);//Siunčiam asmeninių naujienų id ir surenkam asmenines naujienas
			}
			else 
			{
				$naujienos['asmnew']=array();
			}

			//-----IKI ČIA Kodas asmeniniu naujienu surinkimui(Mainheaderi) 
		$testi=0;
		$cpt=0;	
		// gaunam vartotojų sąraša nurodyt kam siųsti
		$sar['sarasas']=$this->admin_model->get_vartotoju_sarasa();
		// create the data object
		$data[''] = new stdClass();
	
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('antraste', 'Antraštė', 'trim|required');
		$this->form_validation->set_rules('tekstas', 'Tekstas', 'trim|required');
		
		
		if ($this->form_validation->run() === false) {// validation not ok, send validation errors to the view
			
			
			$this->load->view('mainheader',array_merge($naujienos,$rysiai));
			$this->load->view('naujiena',array_merge($data, $sar));
			$this->load->view('mainfooter');
			
			
		} else { //validation ok.
		if(!empty($_FILES['failas']['name'][0])){
		// Failo kėlimo parametrai
		 $config['upload_path']          = './failai/';
         $config['allowed_types']        = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|pdf|';
         $config['max_size']             = 2048;
		 
		 $this->load->library('upload', $config);
		 $files = $_FILES;
    	 $cpt = count($_FILES['failas']['name']);
		 $lastid=$this->admin_model->get_last_id();	
		 $lastid++;
   //Ciklas nuskaityti ir įkelti failų tiek kiek pasirinkta.
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['failas']['name']= $files['failas']['name'][$i];
        $_FILES['failas']['type']= $files['failas']['type'][$i];
        $_FILES['failas']['tmp_name']= $files['failas']['tmp_name'][$i];
        $_FILES['failas']['error']= $files['failas']['error'][$i];
        $_FILES['failas']['size']= $files['failas']['size'][$i];    

        if($this->upload->do_upload('failas')) // Jeigu failas yra jį ikelia kartu su jo info
			{
			$duom[$i] = $this->upload->data();
			$this->admin_model->put_failo_duom($duom[$i],$lastid);
			}
		else // Kažkas blogai siunčiamos klaidos į ekraną ir nutraukiamas ciklas
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('mainheader',array_merge($naujienos,$rysiai));
				$this->load->view('naujiena', array_merge($error,$data, $sar));
				$this->load->view('mainfooter');
				$testi=1;
				break; 
			}
	}
	}
    	if ($testi==1) // Jei "$testi" lygus vienam reiškias ciklas viršuj buvo nutrauktas ir nebėra tikslo nieko daugiau daryti(klaidos su failu)
    	{
    		//nieko nedarom
    	} 
    	else //Idėję failus toliau dedam naujieną
    	{
			// set variables from the form
			$antraste = $this->input->post('antraste');
			$tekstas   = $this->input->post('tekstas');
			$tipas = $this->input->post('tip');
		    $arr= $this->input->post('pasirinkimas');
			//var_dump($tipas);
			if ($this->admin_model->put_naujiena($antraste,$tekstas,$tipas) ) // Naujiena įrašyta į db
			{
				if ($tipas==0) {
					$lastid=$this->admin_model->get_last_id();
					foreach ($arr as $value) {
						$this->admin_model->put_rysys($value,$lastid);
					}
				}
				
				
				
				
			$data['naujiena']=$this->user_model->get_naujienos();
			$this->load->view('mainheader',array_merge($naujienos,$rysiai));
			$this->load->view('home',array_merge($data,(array)$arr));
			$this->load->view('mainfooter');
			redirect('adminhome');
			} else {
				
				// Naujiena neįrašyta(niekada neturėtų tai įvykti)
				$data->error = 'Įvyko klaida..naujiena nenusiųsta';
				
				// Siunčiam klaida į ekraną
			$this->load->view('mainheader',array_merge($naujienos,$rysiai));
			$this->load->view('naujiena', array_merge($data, $sar));
			$this->load->view('mainfooter');
				
			}
		}
			}
		} 
	
	public function profilis()
	{
		//-----NUO ČIA Kodas asmeniniu naujienu surinkimui(Mainheaderi) 
		
			$rysiai['rysiai']=$this->user_model->get_asm_naujienasid_mainheader();//Surenkam ryšius pagal vartotojo id(su perskaityta ar ne)
			
			if (!empty($rysiai['rysiai']))
			{
			$naujid = array();
			//Surenkam asmeniniu naujienų id iš $ryšiai į masyvą siuntimui į funkciją surinkti asmenines naujienas pagal id.
			foreach($rysiai['rysiai'] as $row)
			{
        		$naujid[] = $row['naujienos_id'];
    		}
			$naujienos['asmnew']=$this->user_model->get_asm_naujienas($naujid);//Siunčiam asmeninių naujienų id ir surenkam asmenines naujienas
			}
			else 
			{
				$naujienos['asmnew']=array();
			}

			//-----IKI ČIA Kodas asmeniniu naujienu surinkimui(Mainheaderi) 
			$this->load->view('mainheader',array_merge($naujienos,$rysiai));
			$this->load->view('profilis');
			$this->load->view('mainfooter');
	}	

	}
