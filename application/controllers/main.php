<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
		if($this->session->userdata('total') || $this->session->userdata('log'))
		{
			$info['data'] = array('total' => $this->session->userdata('total'), 'log'=>$this->session->userdata('log'));
		}
		else
		{	
			$msg[]='Welcome to gold country';
			$info['data'] = array('total' => $this->session->set_userdata('total', 0), 'log'=>$this->session->set_userdata('log', $msg));
		}
		
	}

	public function index()
	{
		//echo $this->total;
		$this->load->view('index');
	}

	public function process_money()
	{
		$result = $this->input->post();
		var_dump($result);

		if($result['location'])
		{
			switch ($result['location'])
			{
				case 'farm':
					$gold = rand(10,20);
					break;
				case 'cave':
					$gold = rand(5,10);
					break;
				case 'house':
					$gold = rand(2,5);
					break;
				case 'casino':
					$give = rand(1,10);
					$gold = rand(0,50);
		
					if ($give > 3)
					{
						$gold = -$gold;
					}
					break;
			}

			$this->update($gold, $result['location']);
		}
	}
	

	public function reset()
	{
		 $this->session->set_userdata('total', 0);
		 $all_msgs=$this->session->userdata('log');
		 $all_msgs=array();
		 $all_msgs[]='Your total was reset ('. date('F jS Y g:i a', time()).')';
		 $this->session->set_userdata('log', $all_msgs);
		 $info['data'] = array('total' => $this->session->userdata('total'), 'log'=>$this->session->userdata('log'));
		 $this->load->view('index', $info);
	}

	private function update($gold, $location)
	{
		$total = $this->session->userdata('total');
		$this->session->set_userdata('total', $total+$gold);
		$all_msgs=$this->session->userdata('log');
		$all_msgs[]='You entered a '.$location.' and earned '.$gold. ' golds ('. date('F jS Y g:i a', time()).')' ;
		$this->session->set_userdata('log', $all_msgs);
		$info['data'] = array('total' => $this->session->userdata('total'), 'log'=>$this->session->userdata('log'));
		redirect('index');
	}
}

//end of main controller