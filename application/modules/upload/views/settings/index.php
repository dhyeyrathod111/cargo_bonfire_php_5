<?php

$num_columns	= 19;
$can_delete	= $this->auth->has_permission('Upload.Settings.Delete');
$can_edit		= $this->auth->has_permission('Upload.Settings.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('upload_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('upload_field_MessageType'); ?></th>
					<th><?php echo lang('upload_field_Modeoftransport'); ?></th>
					<th><?php echo lang('upload_field_CustomsHouseCode'); ?></th>
					<th><?php echo lang('upload_field_SMTPNumber'); ?></th>
					<th><?php echo lang('upload_field_SMTPDate'); ?></th>
					<th><?php echo lang('upload_field_TrainNumber'); ?></th>
					<th><?php echo lang('upload_field_Train_arrival_date'); ?></th>
					<th><?php echo lang('upload_field_WagonNumber'); ?></th>
					<th><?php echo lang('upload_field_ContainerNumber'); ?></th>
					<th><?php echo lang('upload_field_ShippingLineCode'); ?></th>
					<th><?php echo lang('upload_field_Weight'); ?></th>
					<th><?php echo lang('upload_field_PortCodeofOrigin'); ?></th>
					<th><?php echo lang('upload_field_DestinationRailStationCode'); ?></th>
					<th><?php echo lang('upload_field_GatewayPortCode'); ?></th>
					<th><?php echo lang('upload_field_CarrierAgencyCode'); ?></th>
					<th><?php echo lang('upload_field_BondNo'); ?></th>
					<th><?php echo lang('upload_field_ISOCode'); ?></th>
					<th><?php echo lang('upload_field_StatusofContainer'); ?></th>
					<th><?php echo lang('upload_field_MessageExtension'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('upload_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/settings/upload/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->MessageType); ?></td>
				<?php else : ?>
					<td><?php e($record->MessageType); ?></td>
				<?php endif; ?>
					<td><?php e($record->Modeoftransport); ?></td>
					<td><?php e($record->CustomsHouseCode); ?></td>
					<td><?php e($record->SMTPNumber); ?></td>
					<td><?php e($record->SMTPDate); ?></td>
					<td><?php e($record->TrainNumber); ?></td>
					<td><?php e($record->Train_arrival_date); ?></td>
					<td><?php e($record->WagonNumber); ?></td>
					<td><?php e($record->ContainerNumber); ?></td>
					<td><?php e($record->ShippingLineCode); ?></td>
					<td><?php e($record->Weight); ?></td>
					<td><?php e($record->PortCodeofOrigin); ?></td>
					<td><?php e($record->DestinationRailStationCode); ?></td>
					<td><?php e($record->GatewayPortCode); ?></td>
					<td><?php e($record->CarrierAgencyCode); ?></td>
					<td><?php e($record->BondNo); ?></td>
					<td><?php e($record->ISOCode); ?></td>
					<td><?php e($record->StatusofContainer); ?></td>
					<td><?php e($record->MessageExtension); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('upload_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>