<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/admin/partials
 */
?>
<?php
if($result){
    ?>
<table class="afs-submission-widget-dashboard">
    <thead>
    <tr>
        <th>
            <?php esc_attr_e("First Name");?>
        </th>
        <th>
            <?php esc_attr_e("Last Name");?>
        </th>
        <th>
            <?php esc_attr_e("Email Address");?>
        </th>
        <th>
            <?php esc_attr_e("Mobile No");?>
        </th>
        <th>
            <?php esc_attr_e("CV");?>
        </th>
        <th>
            <?php esc_attr_e("Submission Date");?>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($result as $k =>$record){
        ?>
<tr>
    <td>
        <?php echo esc_attr($record->first_name);?>
    </td>
    <td>
        <?php echo esc_attr($record->last_name);?>
    </td>
    <td>
        <?php echo esc_attr($record->email_address);?>
    </td>
    <td>
        <?php echo esc_attr($record->mobile_phone);?>
    </td>
    <td>
        <?php echo esc_attr($record->cv);?>
    </td>
    <td>
        <?php echo esc_attr($record->created_at);?>
    </td>
</tr>
    <?php
    }
    ?>
    </tbody>
</table>
<?php
}else{
    esc_attr_e("Data masih kosong");
}
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
