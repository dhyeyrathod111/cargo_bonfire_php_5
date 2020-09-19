<?php defined('BASEPATH') || exit('No direct script access allowed');

class Upload_model extends BF_Model
{
    protected $table_name	= 'upload';
	protected $key			= 'id';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= false;
	protected $set_modified = false;
	protected $soft_deletes	= false;


	// Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 	    = array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	// For performance reasons, you may require your model to NOT return the id
	// of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
	protected $return_insert_id = true;

	// The default type for returned row data.
	protected $return_type = 'object';

	// Items that are always removed from data prior to inserts or updates.
	protected $protected_attributes = array();

	// You may need to move certain rules (like required) into the
	// $insert_validation_rules array and out of the standard validation array.
	// That way it is only required during inserts, not updates which may only
	// be updating a portion of the data.
	protected $validation_rules 		= array(
		array(
			'field' => 'MessageType',
			'label' => 'lang:upload_field_MessageType',
			'rules' => 'required|max_length[1]',
		),
		array(
			'field' => 'Modeoftransport',
			'label' => 'lang:upload_field_Modeoftransport',
			'rules' => 'required|max_length[1]',
		),
		array(
			'field' => 'CustomsHouseCode',
			'label' => 'lang:upload_field_CustomsHouseCode',
			'rules' => 'max_length[6]',
		),
		array(
			'field' => 'SMTPNumber',
			'label' => 'lang:upload_field_SMTPNumber',
			'rules' => 'required|numeric|max_length[7]',
		),
		array(
			'field' => 'SMTPDate',
			'label' => 'lang:upload_field_SMTPDate',
			'rules' => 'required',
		),
		array(
			'field' => 'TrainNumber',
			'label' => 'lang:upload_field_TrainNumber',
			'rules' => 'max_length[15]',
		),
		array(
			'field' => 'Train_arrival_date',
			'label' => 'lang:upload_field_Train_arrival_date',
			'rules' => 'required',
		),
		array(
			'field' => 'WagonNumber',
			'label' => 'lang:upload_field_WagonNumber',
			'rules' => 'max_length[15]',
		),
		array(
			'field' => 'ContainerNumber',
			'label' => 'lang:upload_field_ContainerNumber',
			'rules' => 'required|max_length[11]',
		),
		array(
			'field' => 'ShippingLineCode',
			'label' => 'lang:upload_field_ShippingLineCode',
			'rules' => 'required|max_length[11]',
		),
		array(
			'field' => 'Weight',
			'label' => 'lang:upload_field_Weight',
			'rules' => 'max_length[14]',
		),
		array(
			'field' => 'PortCodeofOrigin',
			'label' => 'lang:upload_field_PortCodeofOrigin',
			'rules' => 'required|max_length[6]',
		),
		array(
			'field' => 'DestinationRailStationCode',
			'label' => 'lang:upload_field_DestinationRailStationCode',
			'rules' => 'max_length[6]',
		),
		array(
			'field' => 'GatewayPortCode',
			'label' => 'lang:upload_field_GatewayPortCode',
			'rules' => 'required|max_length[6]',
		),
		array(
			'field' => 'CarrierAgencyCode',
			'label' => 'lang:upload_field_CarrierAgencyCode',
			'rules' => 'max_length[10]',
		),
		array(
			'field' => 'BondNo',
			'label' => 'lang:upload_field_BondNo',
			'rules' => 'numeric|max_length[10]',
		),
		array(
			'field' => 'ISOCode',
			'label' => 'lang:upload_field_ISOCode',
			'rules' => 'required|max_length[4]',
		),
		array(
			'field' => 'StatusofContainer',
			'label' => 'lang:upload_field_StatusofContainer',
			'rules' => 'required|max_length[1]',
		),
		// array(
			// 'field' => 'MessageExtension',
			// 'label' => 'lang:upload_field_MessageExtension',
			// 'rules' => 'required|max_length[5]',
		 // ),
	);
	protected $insert_validation_rules  = array();
	protected $skip_validation 			= false;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}