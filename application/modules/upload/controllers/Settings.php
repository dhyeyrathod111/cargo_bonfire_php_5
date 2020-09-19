<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Settings controller
 */
class Settings extends Admin_Controller
{
    protected $permissionCreate = 'Upload.Settings.Create';
    protected $permissionDelete = 'Upload.Settings.Delete';
    protected $permissionEdit   = 'Upload.Settings.Edit';
    protected $permissionView   = 'Upload.Settings.View';

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
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'settings/_sub_nav');

        Assets::add_module_js('upload', 'upload.js');
    }

    /**
     * Display a list of upload data.
     *
     * @return void
     */
    public function index()
    {
        // Deleting anything?
        if (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);
            $checked = $this->input->post('checked');
            if (is_array($checked) && count($checked)) {

                // If any of the deletions fail, set the result to false, so
                // failure message is set if any of the attempts fail, not just
                // the last attempt

                $result = true;
                foreach ($checked as $pid) {
                    $deleted = $this->upload_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('upload_delete_success'), 'success');
                } else {
                    Template::set_message(lang('upload_delete_failure') . $this->upload_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->upload_model->find_all();

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

                redirect(SITE_AREA . '/settings/upload');
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
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('upload_invalid_id'), 'error');

            redirect(SITE_AREA . '/settings/upload');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_upload('update', $id)) {
                log_activity($this->auth->user_id(), lang('upload_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'upload');
                Template::set_message(lang('upload_edit_success'), 'success');
                redirect(SITE_AREA . '/settings/upload');
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

                redirect(SITE_AREA . '/settings/upload');
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