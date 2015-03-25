<?php

/**
 * Email Downloads from Orders Screen
 * @package - Email Downloads from Orders Screen
 * @copyright Copyright 2014 PRO-Webs, Inc. http://pro-webs.net/
 * @copyright Copyright 2003-2007 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce
 * @license Commercial PRO-Webs.net
 * @version $Id: email_download.php 2014-10-03 00:09:23 pro-webs $

 */

if (!defined('IS_ADMIN_FLAG')) {

  die('Illegal Access');

}

  // select downloads for current order

  $orders_download_query = "select * from " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " where orders_id='" . (int)$_GET['oID'] . "'";

  $orders_download = $db->Execute($orders_download_query);
// added for Email Downloads from Orders Screen 
  $email_stock_content = 'Dear Customer,<br/><br/>'
          . "Thank you for contacting us about the problem with your download. We are sorry you had a problem accessing the product you purchased. To be sure you receive it, we have attached your product to this email.<br/><br/>"
        . 'Thanks for shopping!</br>'
        . 'Store Owner';
//eof added for Email Downloads from Orders Screen

// only display if there are downloads to display

  if ($orders_download->RecordCount() > 0) {

?>
<!-- added for Email Downloads from Orders Screen  -->
<script type="text/javascript">
<!--
function init()
{

  if (typeof _editor_url == "string") HTMLArea.replace('message_html');
}
// -->
</script>
<?php if ($editor_handler != '') include ($editor_handler); ?>
<!-- eof added for Email Downloads from Orders Screen    -->

      <tr>
<!-- edited for Email Downloads from Orders Screen -->     
        <td class="main">
            <?php echo zen_draw_form('email_files',EMAIL_DOWNLOADS_FILENAME);?>
            <table border="1" cellspacing="0" cellpadding="5">
<!-- eof edited for Email Downloads from Orders Screen   -->         
          <tr>

            <td class="smallText" align="center"><?php echo TEXT_LEGEND; ?></td>

            <td class="smallText" align="center"><?php echo TEXT_DOWNLOAD_AVAILABLE . '<br />' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_CURRENT); ?></td>

            <td class="smallText" align="center"><?php echo TEXT_DOWNLOAD_EXPIRED . '<br />' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_STATUS_EXPIRED); ?></td>

            <td class="smallText" align="center"><?php echo TEXT_DOWNLOAD_MISSING . '<br />' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_MISSING); ?></td>

          <tr>

            <td colspan="4" class="smallText" align="center"><strong><?php echo TEXT_DOWNLOAD_TITLE; ?></strong></td>

          </tr>

          <tr>

            <td class="smallText" align="center"><?php echo TEXT_DOWNLOAD_STATUS; ?></td>

            <td class="smallText" align="left"><?php echo TEXT_DOWNLOAD_FILENAME; ?></td>

            <td class="smallText" align="center"><?php echo TEXT_DOWNLOAD_MAX_DAYS; ?></td>

            <td class="smallText" align="center"><?php echo TEXT_DOWNLOAD_MAX_COUNT; ?></td>
<!--  added for Email Downloads from Orders Screen  -->          
            <td class="smallText" align="center">Email</td>
<!--  eof added for Email Downloads from Orders Screen   -->           
          </tr>

<?php

// add legend

    while (!$orders_download->EOF) {

      // $order->info['date_purchased'] . ' vs ' . (zen_date_diff($order->info['date_purchased'], date('Y-m-d')) > $orders_download->fields['download_maxdays'] ? 'NO' : 'YES') . ' vs ' .

      switch (true) {

        case ($orders_download->fields['download_maxdays'] <= 0 && $orders_download->fields['download_count'] <= 0):

          $zc_file_status = TEXT_INFO_EXPIRED_DATE . '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit&download_reset_on=' . $orders_download->fields['orders_products_download_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_STATUS_EXPIRED) . '</a>';

          break;

        case ($orders_download->fields['download_maxdays'] != 0 && (zen_date_diff($order->info['date_purchased'], date('Y-m-d')) > $orders_download->fields['download_maxdays'])):

          $zc_file_status = TEXT_INFO_EXPIRED_DATE . '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit&download_reset_on=' . $orders_download->fields['orders_products_download_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_STATUS_EXPIRED) . '</a>';

          break;

        case ($orders_download->fields['download_maxdays'] == 0):

          $zc_file_status = '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit&download_reset_off=' . $orders_download->fields['orders_products_download_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_CURRENT) . '</a>';

          break;

        case ($orders_download->fields['download_maxdays'] > 0 and $orders_download->fields['download_count'] > 0):

          $zc_file_status = '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit&download_reset_off=' . $orders_download->fields['orders_products_download_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_CURRENT) . '</a>';

          break;

/*

        case ($orders_download->fields['download_maxdays'] <= 1 or $orders_download->fields['download_count'] <= 1):

          $zc_file_status = TEXT_INFO_EXPIRED_COUNT . '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit&download_reset_on=' . $orders_download->fields['orders_products_download_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_STATUS_EXPIRED) . '</a>';

          break;

*/

        case ($orders_download->fields['download_maxdays'] !=0 && $orders_download->fields['download_count'] <= 1):

          $zc_file_status = TEXT_INFO_EXPIRED_COUNT . '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit&download_reset_on=' . $orders_download->fields['orders_products_download_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_STATUS_EXPIRED) . '</a>';

          break;

        default:

          $zc_file_status = '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit&download_reset_on=' . $orders_download->fields['orders_products_download_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_STATUS_EXPIRED) . '</a>';

          break;

          break;

      }



// if not on server show red

      if (!zen_orders_products_downloads($orders_download->fields['orders_products_filename'])) {

        $zc_file_status = zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF);

      }

?>

          <tr>

            <td class="smallText" align="center"><?php echo $zc_file_status; ?></td>
<!-- edited for Email Downloads from Orders Screen-->            
            <td class="smallText" align="center"><?php echo $orders_download->fields['orders_products_filename']; ?></td>
<!-- eof edited for Email Downloads from Orders Screen --> 
            <td class="smallText" align="center"><?php echo $orders_download->fields['download_maxdays']; ?></td>

            <td class="smallText" align="center"><?php echo $orders_download->fields['download_count']; ?></td>
<!-- added for Email Downloads from Orders Screen  -->           
            <td class="smallText" align="left"><?php echo zen_draw_radio_field("download_files[]","download/".$orders_download->fields['orders_products_filename'],true); ?></td>
<!-- eof added for Email Downloads from Orders Screen            
          </tr>

<?php

        $orders_download->MoveNext();

    }

?>
<!-- added for Email Downloads from Orders Screen -->
            </table>
            <table>
        <?php
        $orders_email = $db->Execute("SELECT * FROM ".TABLE_ORDERS." WHERE orders_id=".(int)$_GET['oID']);
        echo zen_draw_hidden_field("order_id", (int)$_GET['oID']);
        ?>
                <tr>
                    <td>Email Address: </td>
                    <td>
                        <?php
                    echo zen_draw_input_field("email_address", $orders_email->fields['customers_email_address']);    
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Customers Name: </td>
                    <td>
                        <?php
                        echo zen_draw_input_field("customers_name", $orders_email->fields['customers_name']); 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Text</td>
                    <td class="main">
                        <?php
                        echo zen_draw_textarea_field("email_content", "soft", "100%", "25", htmlspecialchars($email_stock_content, ENT_COMPAT, CHARSET, TRUE), 'id="message_html"');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <?php
                        echo zen_image_submit('button_email.gif', IMAGE_EMAIL);
                        ?>
                    </td>
                </tr>

                </table>        
        </form></td>
<!-- eof added for Email Downloads from Orders Screen-->        
    </tr>

<?php

  } // only display if there are downloads to display

