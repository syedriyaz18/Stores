<?php
		include("zklib/zklib.php");
    
    $zk = new ZKLib("192.168.1.72", 4370);
    
    $ret = $zk->connect();
        $zk->enableDevice();
        sleep(1);
        $zk->disconnect();

?>