<?php

$hiddenFields = array('id',);
?>
<h1 class='page-header'>
    <?php echo lang('upload_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Message Type</th>
            <th>Mode of transport</th>
            <th>Customs House Code</th>
            <th>SMTP Number</th>
            <th>SMTP Date</th>
            <th>Train Number</th>
            <th>Train arrival date</th>
            <th>Wagon Number</th>
            <th>Container Number</th>
            <th>Shipping Line Code</th>
            <th>Weight</th>
            <th>Port Code of Origin</th>
            <th>Destination Rail Station Code</th>
            <th>Gateway Port Code</th>
            <th>Carrier Agency Code</th>
            <th>Bond No</th>
            <th>ISO Code</th>
            <th>Status of Container</th>
            <th>Message Extension</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($records as $record) :
        ?>
        <tr>
            <?php
            foreach($record as $field => $value) :
                if ( ! in_array($field, $hiddenFields)) :
            ?>
            <td>
                <?php
                if ($field == 'deleted') {
                    e(($value > 0) ? lang('upload_true') : lang('upload_false'));
                } else {
                    e($value);
                }
                ?>
            </td>
            <?php
                endif;
            endforeach;
            ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

endif; ?>