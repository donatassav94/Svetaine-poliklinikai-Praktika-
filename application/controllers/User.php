<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	 public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url'));
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
	public function naujienav()// 1 n.
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
			
			//Surenkam asmeniniu naujienų id iš $data į masyvą siuntimui į funkciją surinkti failus toms naujienoms

			
			
			$var = http_build_query($this->input->get());
			$kelinta['kelinta'] = explode('=',$var);
			$konkreti_naujiena['vienanaujiena']=$this->user_model->get_viena_naujiena($kelinta);// Surandam konkrečią naujieną
			$failai['failai']=$this->user_model->get_failus($kelinta['kelinta'][1]);//Surenkam failus pagal naujienu id
			$this->user_model->put_perskaityta($kelinta);//Irasoma kad naujiena perskaityta
			$this->load->view('mainheader',array_merge($naujienos,$rysiai));
			$this->load->view('nauj', array_merge($konkreti_naujiena,$failai));
			$this->load->view('mainfooter');
	}
	
	
	
	public function download($i)// Failo parsisiuntimas
	{
			$this->load->helper('download');
			force_download('C:/xampp/htdocs/praktika/failai/'.$i, NULL);
	}		
	
	public function visos_naujienos()// Visos naujienos asmenines
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
			
			//-----NUO ČIA Kodas asmeniniu naujienu surinkimui(Pagrindiniam lange) 
		
			$rysiaivisi['rysiaivisi']=$this->user_model->get_asm_naujienasid();//Surenkam ryšius pagal vartotojo id
			$naujidvisi = array();
			//Surenkam asmeniniu naujienų id iš $ryšiai į masyvą siuntimui į funkciją surinkti asmenines naujienas pagal id.
			foreach($rysiaivisi['rysiaivisi'] as $row)
			{
        		$naujidvisi[] = $row['naujienos_id'];
    		}
			$naujienosvisos['asmnewvisos']=$this->user_model->get_asm_naujienas($naujidvisi);//Siunčiam asmeninių naujienų id ir surenkam asmenines naujienas
		
			//-----IKI ČIA Kodas asmeniniu naujienu surinkimui(Pagrindiniam lange) 
			
			//var_dump($failai);
			//var_dump($idsarasas);
			$this->load->view('mainheader',array_merge($naujienos,$rysiai));
			$this->load->view('visosasmnaujienos',array_merge($naujienosvisos));
			$this->load->view('mainfooter');
	}

}
