<?php
require_once('include/classes/NavMenu.php');
require_once('include/classes/User.php');

require_once('include/sections/init.php');
include('include/sections/header.php');

include('include/sections/menu.php');

echo '<h2>' . $page_data['title'] . '</h2>';
echo '<div id="page">' . $page_data['content'] . '</div>';

$fp = 'include/pages/' . $page_data['filename'];
if (file_exists($fp)) {
  include($fp);
}

include('include/sections/footer.php');
