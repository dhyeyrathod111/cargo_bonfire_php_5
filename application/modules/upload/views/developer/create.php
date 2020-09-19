<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('upload_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($upload->id) ? $upload->id : '';

?>
<div class='admin-box'>
    <h3>upload</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('MessageType') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_MessageType') . lang('bf_form_label_required'), 'MessageType', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='MessageType' type='text' required='required' name='MessageType' maxlength='1' value="<?php echo set_value('MessageType', isset($upload->MessageType) ? $upload->MessageType : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('MessageType'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Modeoftransport') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_Modeoftransport') . lang('bf_form_label_required'), 'Modeoftransport', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Modeoftransport' type='text' required='required' name='Modeoftransport' maxlength='1' value="<?php echo set_value('Modeoftransport', isset($upload->Modeoftransport) ? $upload->Modeoftransport : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Modeoftransport'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('CustomsHouseCode') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_CustomsHouseCode'), 'CustomsHouseCode', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='CustomsHouseCode' type='text' name='CustomsHouseCode' maxlength='6' value="<?php echo set_value('CustomsHouseCode', isset($upload->CustomsHouseCode) ? $upload->CustomsHouseCode : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('CustomsHouseCode'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('SMTPNumber') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_SMTPNumber') . lang('bf_form_label_required'), 'SMTPNumber', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='SMTPNumber' type='text' required='required' name='SMTPNumber' maxlength='7' value="<?php echo set_value('SMTPNumber', isset($upload->SMTPNumber) ? $upload->SMTPNumber : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('SMTPNumber'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('SMTPDate') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_SMTPDate') . lang('bf_form_label_required'), 'SMTPDate', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='SMTPDate' type='text' required='required' name='SMTPDate'  value="<?php echo set_value('SMTPDate', isset($upload->SMTPDate) ? $upload->SMTPDate : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('SMTPDate'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('TrainNumber') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_TrainNumber'), 'TrainNumber', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='TrainNumber' type='text' name='TrainNumber' maxlength='15' value="<?php echo set_value('TrainNumber', isset($upload->TrainNumber) ? $upload->TrainNumber : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('TrainNumber'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Train_arrival_date') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_Train_arrival_date') . lang('bf_form_label_required'), 'Train_arrival_date', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Train_arrival_date' type='text' required='required' name='Train_arrival_date'  value="<?php echo set_value('Train_arrival_date', isset($upload->Train_arrival_date) ? $upload->Train_arrival_date : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Train_arrival_date'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('WagonNumber') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_WagonNumber'), 'WagonNumber', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='WagonNumber' type='text' name='WagonNumber' maxlength='15' value="<?php echo set_value('WagonNumber', isset($upload->WagonNumber) ? $upload->WagonNumber : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('WagonNumber'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('ContainerNumber') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_ContainerNumber') . lang('bf_form_label_required'), 'ContainerNumber', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='ContainerNumber' type='text' required='required' name='ContainerNumber' maxlength='11' value="<?php echo set_value('ContainerNumber', isset($upload->ContainerNumber) ? $upload->ContainerNumber : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('ContainerNumber'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('ShippingLineCode') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_ShippingLineCode') . lang('bf_form_label_required'), 'ShippingLineCode', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='ShippingLineCode' type='text' required='required' name='ShippingLineCode' maxlength='11' value="<?php echo set_value('ShippingLineCode', isset($upload->ShippingLineCode) ? $upload->ShippingLineCode : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('ShippingLineCode'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('Weight') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_Weight'), 'Weight', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='Weight' type='text' name='Weight' maxlength='14' value="<?php echo set_value('Weight', isset($upload->Weight) ? $upload->Weight : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('Weight'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('PortCodeofOrigin') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_PortCodeofOrigin') . lang('bf_form_label_required'), 'PortCodeofOrigin', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='PortCodeofOrigin' type='text' required='required' name='PortCodeofOrigin' maxlength='6' value="<?php echo set_value('PortCodeofOrigin', isset($upload->PortCodeofOrigin) ? $upload->PortCodeofOrigin : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('PortCodeofOrigin'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('DestinationRailStationCode') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_DestinationRailStationCode'), 'DestinationRailStationCode', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='DestinationRailStationCode' type='text' name='DestinationRailStationCode' maxlength='6' value="<?php echo set_value('DestinationRailStationCode', isset($upload->DestinationRailStationCode) ? $upload->DestinationRailStationCode : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('DestinationRailStationCode'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('GatewayPortCode') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_GatewayPortCode') . lang('bf_form_label_required'), 'GatewayPortCode', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='GatewayPortCode' type='text' required='required' name='GatewayPortCode' maxlength='6' value="<?php echo set_value('GatewayPortCode', isset($upload->GatewayPortCode) ? $upload->GatewayPortCode : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('GatewayPortCode'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('CarrierAgencyCode') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_CarrierAgencyCode'), 'CarrierAgencyCode', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='CarrierAgencyCode' type='text' name='CarrierAgencyCode' maxlength='10' value="<?php echo set_value('CarrierAgencyCode', isset($upload->CarrierAgencyCode) ? $upload->CarrierAgencyCode : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('CarrierAgencyCode'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('BondNo') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_BondNo'), 'BondNo', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='BondNo' type='text' name='BondNo' maxlength='10' value="<?php echo set_value('BondNo', isset($upload->BondNo) ? $upload->BondNo : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('BondNo'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('ISOCode') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_ISOCode') . lang('bf_form_label_required'), 'ISOCode', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='ISOCode' type='text' required='required' name='ISOCode' maxlength='4' value="<?php echo set_value('ISOCode', isset($upload->ISOCode) ? $upload->ISOCode : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('ISOCode'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('StatusofContainer') ? ' error' : ''; ?>">
                <?php echo form_label(lang('upload_field_StatusofContainer') . lang('bf_form_label_required'), 'StatusofContainer', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='StatusofContainer' type='text' required='required' name='StatusofContainer' maxlength='1' value="<?php echo set_value('StatusofContainer', isset($upload->StatusofContainer) ? $upload->StatusofContainer : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('StatusofContainer'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    5 => 5,
                );
                echo form_dropdown(array('name' => 'MessageExtension', 'required' => 'required'), $options, set_value('MessageExtension', isset($upload->MessageExtension) ? $upload->MessageExtension : ''), lang('upload_field_MessageExtension') . lang('bf_form_label_required'));
            ?>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('upload_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/developer/upload', lang('upload_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>