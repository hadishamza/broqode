<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code extends CI_Controller {

	/*
	 * Generar en QR-kod och lägger in den i databasen.
	 * Generar även en session vilken QR-koden tillhör
	 * 
	 */
	public function index()
	{
		$this->load->model('Code_model');
		$this->load->helper('url');
		$session_code = $this->session->userdata('code');
		if ($session_code)
			$code = $this->Code_model->get_code($session_code);
		else{
			$code = $this->Code_model->get_code($this->Code_model->create());
		}
			
		if ( ! $code)
			$return = "Oh SNAPALAP something went wront #1, please try again!";
		else
			{
			$this->session->set_userdata('code', $code->id);
			}
		$data['views'] = $code->clicks;
		$data['code'] = $code->id;
		$data['data'] = $code->data;
		$data['url'] = base_url().'d/'.$code->id;
		$data['secret_url'] = base_url().'a/'.$code->secret;
		
		
		$this->load->view('index_view', $data);
	}
	
	/*
	 * Lägger in själva urlen i  db:en enkelt.
	 * 
	 */
	public function update()
	{
		//ini_set ("display_errors", "1"); 
		$this->load->model('Code_model');
		$this->load->model('User_model');
		
		if ($_POST AND $_POST['data'])
		{
			$data = trim($_POST['data']);
			$id = $_POST['id'];
			$sbstr = substr($data, 0, 7);
			$sbstr2 = substr($data, 0, 8);
			if ($sbstr != "http://" AND $sbstr2 != "https://")
				$data = "http://".$data;
			
			$code = $this->Code_model->get_code($id);
			$user_id = $code->user_id;
			if ($user_id)
			{
				$user_session_id = $this->User_model->get_user($user_id);
				if ($user_session_id == $this->session->userdata('sesssion_id'))
					$user_id = $user_id;
			}
			else
				$user_id = $this->User_model->create($this->session->userdata('session_id'));
			
			echo $this->Code_model->update($id, $data, $user_id);
		}
		
	}
	
	public function email()
	{
		//ini_set ("display_errors", "1"); 
		$this->load->model('Code_model');
		$this->load->model('User_model');
		
		if ($_POST AND $_POST['secret'] AND $_POST['email'])
		{
			$code = $_POST['secret'];
			if ( ! $code)
				die("Oh SNAPALAP something went wront, please try again!");
			$code = $this->Code_model->get_code_secret($code);
			if ( ! $code)
				die("Oh SNAPALAP something went wront, please try again!");
		}
		
	}
	
	
	/*
	 * Hemlig adminsida
	 * 
	 */
	public function a()
	{
		$this->load->model('Code_model');
		$this->load->helper('url');
		$code = $this->uri->segment(2);
		if ( ! $code)
			die("Oh SNAPALAP something went wront #1, please try again!");
		$code = $this->Code_model->get_code_secret($code);
		if ( ! $code)
			die("Oh SNAPALAP something went wront #1, please try again!");
		$data['views'] = $code->clicks;
		$data['code'] = $code->id;
		$data['data'] = $code->data;
		$data['secret_url'] = base_url().'a/'.$code->secret;
		$data['url'] = base_url().'d/'.$code->id;
		
		
		$this->load->view('index_view', $data);
	}

/*
	 * En QR-kod som generarats pekar på denna länk. Försöker hitta länken för att sedan göra en redirect.
	 * Generar även en session vilken QR-koden tillhör
	 * 
	 */
	public function d()
	{
		$this->load->model('Code_model');
		$this->load->helper('url');
		$code = $this->uri->segment(2);
		$url = $this->Code_model->get_code($code);
		if ($url)	
			{
			$this->Code_model->update_clicks($code);
			redirect($url->data);
			}
		else
			echo 1;
	}
	
	/*
	 * Dödar din session! 
	 * 
	 */
	public function kill()
	{
		$this->load->helper('url');
		unset($this->session->userdata);  
		$this->session->sess_destroy();
		redirect('');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */