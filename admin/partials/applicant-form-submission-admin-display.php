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
global $wpdb;
$current_url = set_url_scheme('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$items_per_page = 5;
$page = isset($_GET['cpage']) ? abs((int)$_GET['cpage']) : 1;
$order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : '';
$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'created_at';
$keyword = isset($_GET['s']) ? trim($_GET['s']) : '';
$offset = ($page * $items_per_page) - $items_per_page;
$where = '';
if ($keyword) {
    $where = "WHERE email_address LIKE  $wpdb->esc_like( '%" . $keyword . "%' ) ";
}
$query = "SELECT * FROM {$wpdb->prefix}applicant_submissions {$where}";
$order_sql = '' === $order ? 'desc' : $order;
$total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
$total = $wpdb->get_var($total_query);
$result = $wpdb->get_results($query . ' ORDER BY ' . $orderby . " {$order_sql} LIMIT " . $offset . ', ' . $items_per_page, OBJECT);
if ($order_sql === 'desc') {
    $current_order = 'desc';
} else {
    $current_order = 'asc';
}
$order = 'asc' === $current_order ? 'desc' : 'asc';
?>
<h2><?php esc_attr_e("List Applicant Form Submission", "afs"); ?></h2>
<div class="afs-border-bottom-2"></div>
<div class="afs-search">
    <form method="post">
        <?php echo wp_nonce_field('afs_security_search_form', 'token_security'); ?>
        <input type="text" value="<?php esc_attr_e($keyword); ?>" name="s" placeholder="search email address">
        <input type="submit" value="Search email address" name="afs-search">
    </form>
</div>
<?php
if (get_transient("afs_delete_submission") == true) {
    ?>
    <div class="afs-alert afs-pesan">
        <?php echo get_transient("afs_delete_submission"); ?>
    </div>
    <?php
}
?>
<table class="afs-list-submission">
    <thead>
    <tr>
        <th>
            <?php esc_attr_e("First Name"); ?>
        </th>
        <th>
            <?php esc_attr_e("Last Name"); ?>
        </th>
        <th>
            <?php esc_attr_e("Email Address"); ?>
        </th>
        <th>
            <?php esc_attr_e("Mobile No"); ?>
        </th>
        <th>
            <?php esc_attr_e("CV"); ?>
        </th>
        <th class="sorted <?php esc_attr_e($current_order); ?>">
            <a href="<?php echo esc_url(add_query_arg(compact('s', 'orderby', 'order'), $current_url)); ?>">
                <span><?php esc_attr_e("Submission Date"); ?></span>
                <span class="sorting-indicator">
                </span>
            </a>
        </th>
        <th>
            <?php esc_attr_e("Action"); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($result) {
        foreach ($result as $k => $record) {
            ?>
            <tr>
                <td>
                    <?php echo esc_attr($record->first_name); ?>
                </td>
                <td>
                    <?php echo esc_attr($record->last_name); ?>
                </td>
                <td>
                    <?php echo esc_attr($record->email_address); ?>
                </td>
                <td>
                    <?php echo esc_attr($record->mobile_phone); ?>
                </td>
                <td>
                    <?php echo esc_attr($record->cv); ?>
                </td>
                <td>
                    <?php echo esc_attr($record->created_at); ?>
                </td>
                <td>
                    <a href="<?php echo esc_url(admin_url("?page=afs&action=delete&id={$record->id}&_afsnonce=" . wp_create_nonce('afs_security'))); ?>"><?php esc_attr_e("Delete", "afs"); ?></a>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="7" class="afs-center-text"><?php esc_attr_e("Data not found", "afs"); ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<?php
echo paginate_links(array(
    'base' => add_query_arg('cpage', '%#%'),
    'format' => '',
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    'total' => ceil($total / $items_per_page),
    'current' => $page
));
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
