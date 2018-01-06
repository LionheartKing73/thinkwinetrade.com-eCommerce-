<?php

  include 'config.php';

  $query = 'mysqldump -u'.DB_USERNAME.' -p'.DB_PASSWORD.' -h '.DB_HOSTNAME.' --add-drop-table --no-data '.DB_DATABASE.' | grep ^DROP | mysql -u'.DB_USERNAME.' -p'.DB_PASSWORD.' -h '.DB_HOSTNAME.' '.DB_DATABASE;

  system($query);

  $query = 'mysql -u'.DB_USERNAME.' -p'.DB_PASSWORD.' -h '.DB_HOSTNAME.' '.DB_DATABASE.' < db/dump.sql';

  system($query);

?>
