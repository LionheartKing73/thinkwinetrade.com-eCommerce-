<?php

  include 'config.php';

  $query = 'mysqldump -u'.DB_USERNAME.' -p"'.DB_PASSWORD.'" -h '.DB_HOSTNAME.' '.DB_DATABASE.' > db/dump.sql';

  exec($query);

?>
