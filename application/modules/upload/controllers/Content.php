<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Upload.Content.Create';
    protected $permissionDelete = 'Upload.Content.Delete';
    protected $permissionEdit   = 'Upload.Content.Edit';
    protected $permissionView   = 'Upload.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('upload/upload_model');
        $this->lang->load('upload');
        $this->load->helper('download');
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        date_default_timezone_set("Asia/Kolkata");
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('upload', 'upload.js');
    }

    /**
     * Display a list of upload data.
     *
     * @return void
     */
    public function index($offset =0)
    {
		
		$pagerUriSegment = 5;
        
		$pagerBaseUrl = site_url(SITE_AREA . '/content/upload/index') .'/';//
        // echo $pagerBaseUrl; exit;
		
		$limit  = $this->settings_lib->item('site.list_limit') ?: 15;
			
        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->upload_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
		
		Template::set('upload_data', '');
		if (isset($_POST['excel_file_btn'])) {
			//echo '<script>alert("Hello")</script>';
			 $config['upload_path']   = './uploads/'; 
			 $config['allowed_types'] = 'csv'; 
			 $config['max_size']      = 1000; 
			 $config['max_width']     = 1024; 
			 $config['max_height']    = 768;  
			 $this->load->library('upload', $config);
				
			 if ( ! $this->upload->do_upload('excel_file')) {
				$upload_error = array('error' => $this->upload->display_errors()); 
				//$this->load->view('upload_form', $error); 
				Template::set('upload_data', $upload_error);
			 }
				
			 else { 
					$uploaddata=$this->upload->data();
				
					$file = fopen($uploaddata['full_path'],"r");
					$count=0;
					$columns=array('SMTPNumber','SMTPDate','TrainNumber','Train_arrival_date','WagonNumber','ContainerNumber','Weight');
				
					$error=false;$errormsg='';
					$res=$this->upload_model->select('number1,number2')->where("id",1)->limit(1)->find_all();
					$row=$res[0]; //var_dump($row);exit;
					$line= 'HRECZZINHIR6DGC1ZZINHIR6ICES1_5PCOCHI02'.$row->number1.''.date('Ymd').''.date('Hi'). PHP_EOL .'<contarr>'.PHP_EOL;
				while(!feof($file) and !$error)
				  {
					  if($count==0){
							$data=fgetcsv($file);$data=array_map("trim",$data);
							
							$diff=array_diff_assoc($columns,$data);
							
							if(!empty($diff)){
								$error=true;	$errormsg="the following columns are missing ".json_encode($diff);
							}
							$data=array();
					  }else{
					  $res=fgetcsv($file); $res=array_map("trim",$res);	
					  
					// echo '<pre>'; print_r($res); exit;
					$line.='F'.'';
					$line.='R'.'';
					$line.='INHIR6'.'';
					$line.=$res[0].'';
					$line.=$res[1].'';
					$line.=$res[2].'';
					$line.=$res[3].'';
					$line.=$res[4].'';
					$line.=$res[5].'';
					$line.='AACCD4630Q'.'';
					$line.=$res[6].'';
					$line.='INBOM4'.'';
					$line.='INHIR6'.'';
					$line.='INBOM4'.'';
					$line.='AACCD4630Q'.'';
					$line.='2001099766'.'';
					$line.='YYYY'.'';
					$line.='I'. PHP_EOL;
					}
					  
					  $count++;
					  
				  }
					fclose($file);
					$line.='<END-contarr>'.PHP_EOL .'TREC'.$row->number1. PHP_EOL;
				
					date_default_timezone_set("Asia/Kolkata"); $number2=$row->number2+1;
					$name = 'COACHI02'.date("d-m-Y").date('Hi').'.in';
					
					$data= array('number1'=>$row->number1+$count,'number2'=>$number2);
					
					$res=$this->upload_model->update(1, $data,false);  //var_dump($res); exit;
					
					force_download($name, $line);
					  
					$upload_data = array('upload_data' => $uploaddata,'error'=>$errormsg); 
					Template::set('upload_data', $upload_data);
				
				//$this->load->view('upload_success', $data); 
			 } 
		}
		
		if (isset($_POST['delete'])) {
			$MessageExtension=$this->input->post('MessageExtension');
            $checked = $this->input->post('checked');
			$records = $this->upload_model->where_in('id',$checked)->find_all();
			// echo '<pre>'; print_r($checked); print_r($records);  exit;
			
			// var_dump($this->upload_model->select('number1,number2')->find_all()); exit;
			$res=$this->upload_model->select('number1,number2')->where("id",1)->limit(1)->find_all();
			$row=$res[0]; //var_dump($row);exit;
			$line= 'HRECZZINHIR6DGC1ZZINHIR6ICES1_5PCOCHI02'.$row->number1.''.date('Ymd').''.date('Hi'). PHP_EOL .'<contarr>'.PHP_EOL;
			foreach ($records as $record){
				$line.=$record->MessageType.'';
				$line.=$record->Modeoftransport.'';
				$line.=$record->CustomsHouseCode.'';
				$line.=$record->SMTPNumber.'';
				$line.=date('Ymd',time($record->SMTPDate)).'';
				$line.=$record->TrainNumber.'';
				$line.=date('Ymd',time($record->Train_arrival_date)).'';
				$line.=$record->WagonNumber.'';
				$line.=$record->ContainerNumber.'';
				$line.=$record->ShippingLineCode.'';
				$line.=$record->Weight.'';
				$line.=$record->PortCodeofOrigin.'';
				$line.=$record->DestinationRailStationCode.'';
				$line.=$record->GatewayPortCode.'';
				$line.=$record->CarrierAgencyCode.'';
				$line.=$record->BondNo.'';
				$line.=$record->ISOCode.'';
				$line.=$record->StatusofContainer. PHP_EOL;
			}				
				
				$line.='<END-contarr>'.PHP_EOL .'TREC'.$row->number1. PHP_EOL;
				
				date_default_timezone_set("Asia/Kolkata"); $number2=$row->number2+1;
				$name = 'COACHI02'.date("d-m-Y").date('Hi').'.'.$MessageExtension;
				
				$data= array('number1'=>$row->number1+count($records),'number2'=>$number2);
				
				$res=$this->upload_model->update(1, $data,false);  //var_dump($res); exit;
				
				force_download($name, $line);exit;
			
        }
		          
        $records = $this->upload_model->limit($limit, $offset)->find_all();
        // $records = $this->upload_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('upload_manage'));
        Template::render();
    }
    
    /**
     * Create a upload object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_upload()) {
                log_activity($this->auth->user_id(), lang('upload_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'upload');
                Template::set_message(lang('upload_create_success'), 'success');

                redirect(SITE_AREA . '/content/upload');
            }

            // Not validation error
            if ( ! empty($this->upload_model->error)) {
                Template::set_message(lang('upload_create_failure') . $this->upload_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('upload_action_create'));

        Template::render();
    }
    /**
     * Allows editing of upload data.
     *
     * @return void
     */
    public function uploads(){
		
		$handle = opendir(APPPATH.'..\uploads');
		while($name = readdir($handle)) {
			echo "<a href='".base_url()."uploads/".$name."'>$name</a><br>";
		}
		
		closedir($handle);exit;
	}
	public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('upload_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/upload');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_upload('update', $id)) {
                log_activity($this->auth->user_id(), lang('upload_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'upload');
                Template::set_message(lang('upload_edit_success'), 'success');
                redirect(SITE_AREA . '/content/upload');
            }

            // Not validation error
            if ( ! empty($this->upload_model->error)) {
                Template::set_message(lang('upload_edit_failure') . $this->upload_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->upload_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('upload_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'upload');
                Template::set_message(lang('upload_delete_success'), 'success');

                redirect(SITE_AREA . '/content/upload');
            }

            Template::set_message(lang('upload_delete_failure') . $this->upload_model->error, 'error');
        }
        
        Template::set('upload', $this->upload_model->find($id));

        Template::set('toolbar_title', lang('upload_edit_heading'));
        Template::render();
    }

    //--------------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------------

    /**
     * Save the data.
     *
     * @param string $type Either 'insert' or 'update'.
     * @param int    $id   The ID of the record to update, ignored on inserts.
     *
     * @return boolean|integer An ID for successful inserts, true for successful
     * updates, else false.
     */
    private function save_upload($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->upload_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->upload_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['SMTPDate']	= $this->input->post('SMTPDate') ? $this->input->post('SMTPDate') : '0000-00-00';
		$data['Train_arrival_date']	= $this->input->post('Train_arrival_date') ? $this->input->post('Train_arrival_date') : '0000-00-00';

        $return = false;
        if ($type == 'insert') {
            $id = $this->upload_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->upload_model->update($id, $data);
        }
        return $return;
    }
}