===Zen Cart Email Downloads from Orders Screen v1.0.1===

Tested on Zen Cart 1.39H & 1.5.X and tested on PHP 5.5.18

This module is an advanced installation.

This module adds a "email download" with customized message to your admin
orders screen, if a download is purchased. Many times people fail to download
their order, then maybe can't login and many other troublesome issues happen
with downloads. Now, you can easily resend the download to their email,
as an attachment when troubles arise. Huge timesave from FTP to fetch the 
download, typing an all new email every time etc.
 

Module release 10/03/2014 http://pro-webs.net/ 

Please provide bug fixes and issues to https://pro-webs-support.com/

===Database Changes===
None

===Core File Edits===
Yes

===Basic Installation===
1. !!!! Backup your database and affected files !!!!
   
2. Rename your admin to your own secret admin folder name. Upload the files in 
   the module catalog folder to the matching file structure in your Zen Cart 
   directory. There are no ovewrites in this part.
 
3. See orders_download.txt in YOUR_ADMIN_CORE_EDITS folder and merge the 
   commented changes marked as "//BOF Email Downloads from Orders Screen EDIT"
   in to your own catalog/your_admin/modules/orders_download.php.php
   * There are 6 edits
   **This file is a 1.5.4 file, so merging other versions will require additional skill 
   
The default admin email down text can be edited in catalog/YOUR_ADMIN/includes/modules/orders_download.php

===EOF Basic Installation===		
       
===Change History===
Date       Version  Who             Why
===============================================================================
10/03/2014  1.0.0	  PRO-Webs.net	Initial Release
01/13/2015  1.0.1	  PRO-Webs.net	Zen Cart version 1.5.4 update 
				
				