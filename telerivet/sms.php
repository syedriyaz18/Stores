<?php
require_once 'telerivet.php';
$api="qxgYlbHHChvrWfp0OCH2R3Nei2sX5hmv";
&pr="PJdea3b3738e87a394";
$tr = new Telerivet_API($api);
$project = $tr->initProjectById($pr);

$sent_msg = $project->sendMessage(array(
    'content' => "hello Rafi", 
    'to_number' => "8019902827"
));
?>