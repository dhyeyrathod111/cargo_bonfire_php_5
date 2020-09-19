<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Upload controller
 */
class Upload extends Front_Controller
{
    protected $permissionCreate = 'Upload.Upload.Create';
    protected $permissionDelete = 'Upload.Upload.Delete';
    protected $permissionEdit   = 'Upload.Upload.Edit';
    protected $permissionView   = 'Upload.Upload.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('upload/upload_model');
        $this->lang->load('upload');
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
        

        Assets::add_module_js('upload', 'upload.js');
    }

    /**
     * Display a list of upload data.
     *
     * @return void
     */
    public function index()
    {
        
        
        
        
        $records = $this->upload_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
}