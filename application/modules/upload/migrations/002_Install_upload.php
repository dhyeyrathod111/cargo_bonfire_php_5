<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_upload extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'upload';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'MessageType' => array(
            'type'       => 'VARCHAR',
            'constraint' => 1,
            'null'       => false,
        ),
        'Modeoftransport' => array(
            'type'       => 'VARCHAR',
            'constraint' => 1,
            'null'       => false,
        ),
        'CustomsHouseCode' => array(
            'type'       => 'VARCHAR',
            'constraint' => 6,
            'null'       => true,
        ),
        'SMTPNumber' => array(
            'type'       => 'INT',
            'constraint' => 7,
            'null'       => false,
        ),
        'SMTPDate' => array(
            'type'       => 'DATE',
            'null'       => false,
            'default'    => '0000-00-00',
        ),
        'TrainNumber' => array(
            'type'       => 'VARCHAR',
            'constraint' => 15,
            'null'       => true,
        ),
        'Train_arrival_date' => array(
            'type'       => 'DATE',
            'null'       => false,
            'default'    => '0000-00-00',
        ),
        'WagonNumber' => array(
            'type'       => 'VARCHAR',
            'constraint' => 15,
            'null'       => true,
        ),
        'ContainerNumber' => array(
            'type'       => 'VARCHAR',
            'constraint' => 11,
            'null'       => false,
        ),
        'ShippingLineCode' => array(
            'type'       => 'VARCHAR',
            'constraint' => 11,
            'null'       => false,
        ),
        'Weight' => array(
            'type'       => 'VARCHAR',
            'constraint' => 14,
            'null'       => true,
        ),
        'PortCodeofOrigin' => array(
            'type'       => 'VARCHAR',
            'constraint' => 6,
            'null'       => false,
        ),
        'DestinationRailStationCode' => array(
            'type'       => 'VARCHAR',
            'constraint' => 6,
            'null'       => true,
        ),
        'GatewayPortCode' => array(
            'type'       => 'VARCHAR',
            'constraint' => 6,
            'null'       => false,
        ),
        'CarrierAgencyCode' => array(
            'type'       => 'VARCHAR',
            'constraint' => 10,
            'null'       => true,
        ),
        'BondNo' => array(
            'type'       => 'INT',
            'constraint' => 10,
            'null'       => true,
        ),
        'ISOCode' => array(
            'type'       => 'VARCHAR',
            'constraint' => 4,
            'null'       => false,
        ),
        'StatusofContainer' => array(
            'type'       => 'VARCHAR',
            'constraint' => 1,
            'null'       => false,
        ),
        'MessageExtension' => array(
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ),
	);

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table($this->table_name);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}
}