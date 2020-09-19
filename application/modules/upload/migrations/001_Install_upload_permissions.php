<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_upload_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Upload.Content.View',
			'description' => 'View Upload Content',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Content.Create',
			'description' => 'Create Upload Content',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Content.Edit',
			'description' => 'Edit Upload Content',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Content.Delete',
			'description' => 'Delete Upload Content',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Reports.View',
			'description' => 'View Upload Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Reports.Create',
			'description' => 'Create Upload Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Reports.Edit',
			'description' => 'Edit Upload Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Reports.Delete',
			'description' => 'Delete Upload Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Settings.View',
			'description' => 'View Upload Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Settings.Create',
			'description' => 'Create Upload Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Settings.Edit',
			'description' => 'Edit Upload Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Settings.Delete',
			'description' => 'Delete Upload Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Developer.View',
			'description' => 'View Upload Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Developer.Create',
			'description' => 'Create Upload Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Developer.Edit',
			'description' => 'Edit Upload Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Upload.Developer.Delete',
			'description' => 'Delete Upload Developer',
			'status' => 'active',
		),
    );

    /**
     * @var string The name of the permission key in the role_permissions table
     */
    private $permissionKey = 'permission_id';

    /**
     * @var string The name of the permission name field in the permissions table
     */
    private $permissionNameField = 'name';

	/**
	 * @var string The name of the role/permissions ref table
	 */
	private $rolePermissionsTable = 'role_permissions';

    /**
     * @var numeric The role id to which the permissions will be applied
     */
    private $roleId = '1';

    /**
     * @var string The name of the role key in the role_permissions table
     */
    private $roleKey = 'role_id';

	/**
	 * @var string The name of the permissions table
	 */
	private $tableName = 'permissions';

	//--------------------------------------------------------------------

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$rolePermissionsData = array();
		foreach ($this->permissionValues as $permissionValue) {
			$this->db->insert($this->tableName, $permissionValue);

			$rolePermissionsData[] = array(
                $this->roleKey       => $this->roleId,
                $this->permissionKey => $this->db->insert_id(),
			);
		}

		$this->db->insert_batch($this->rolePermissionsTable, $rolePermissionsData);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
        $permissionNames = array();
		foreach ($this->permissionValues as $permissionValue) {
            $permissionNames[] = $permissionValue[$this->permissionNameField];
        }

        $query = $this->db->select($this->permissionKey)
                          ->where_in($this->permissionNameField, $permissionNames)
                          ->get($this->tableName);

        if ( ! $query->num_rows()) {
            return;
        }

        $permissionIds = array();
        foreach ($query->result() as $row) {
            $permissionIds[] = $row->{$this->permissionKey};
        }

        $this->db->where_in($this->permissionKey, $permissionIds)
                 ->delete($this->rolePermissionsTable);

        $this->db->where_in($this->permissionNameField, $permissionNames)
                 ->delete($this->tableName);
	}
}