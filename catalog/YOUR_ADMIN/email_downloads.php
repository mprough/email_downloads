<?php
/**
 * Email Downloads from Orders Screen
 * @package - Email Downloads from Orders Screen
 * @copyright Copyright 2014 PRO-Webs, Inc. http://pro-webs.net/
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license Commercial PRO-Webs.net
 * @version $Id: email_downloads.php 2014-10-03 00:09:23 pro-webs $
 */
require('includes/application_top.php');

$customers_name = $_POST['customers_name'];
$customers_email_address = $_POST['email_address'];
$array_of_files = $_POST['download_files'];
$email_html = $_POST['email_content'];

//send email
 if (!defined('EMAIL_ATTACHMENTS_ENABLED')) define('EMAIL_ATTACHMENTS_ENABLED', true); 
$email_subject = "Your Downloads from ".STORE_NAME;
$html_msg['EMAIL_SUBJECT'] = $email_subject;
$html_msg['EMAIL_MESSAGE_HTML'] = $email_html;
$email_text = strip_tags($email_html);

zen_mail($customers_name, $customers_email_address, $email_subject, $email_text, STORE_NAME, EMAIL_FROM, $html_msg, 'default', $array_of_files[0]);



//note account
$files_sent = '';
foreach ($array_of_files as $files){
                $files_sent .= $files."<br/>";
            }
            
$comments = "Email sento to ".$customers_name." ".$customers_email_address." with ".strip_tags($files_sent);
$values = "'".$_POST['order_id']."', 4, now(), 0, '".$comments."'";
$db->Execute("INSERT INTO ".TABLE_ORDERS_STATUS_HISTORY." (orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (".$values.")");

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Emailed Downloads</title>
<meta name="robot" content="noindex, nofollow" />
<script src="includes/menu.js" type="text/javaScript"></script>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS" />
</head>
<body onLoad="cssjsmenu('navbar')">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<div id="emailDownloads">
<h1>Emailed Downloads</h1>

<table>
    <tr>
        <td>Order: </td>
        <td><?=$_POST['order_id']?></td>
    </tr>
    <tr>
        <td>Name: </td>
        <td><?=$customers_name?></td>
    </tr>
    <tr>
        <td>Email: </td>
        <td><?=$customers_email_address?></td>
    </tr>
    <tr>
        <td>Files:</td>
        <td>
            <?php
            echo $files_sent;
            ?>
        </td>
    </tr>
    <tr>
        <td>Email Content: </td>
        <td><?=$email_html?></td>
    </tr>
</table>



</div>

<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
