<?php

$visit = 0;
if (isset($_COOKIE['visit'])) {
  $visit = intval($_COOKIE['visit']);
}
$visit++;
echo "you have visited $visit times!";

setcookie('visit', $visit, time() + (60 * 60 * 24 * 30));


?>
<hr>

<hr>
Welcome visitor from
<?php echo $_SERVER['REMOTE_ADDR'] ?>
<br>
Using browser:
<?php
echo $_SERVER['HTTP_USER_AGENT']
?> 