<?php
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "");

header("Content-Type:application/json; Charset=utf-8");

// As you can see, here you will have where Employee_ID = :employee_id, this will be
// automatically replaced by the PDO object with the data sent in execute(array('employee_id' => $_POST['Employee_ID']))
// This is a good practice to avoid SqlInyection attacks
$st = $pdo->prepare("select quantity from nims_store.unit_tbl where unit_name=:unit_name");
$st->execute(array ('unit_name' => $_POST['unit_name']));
$data = $st->fetch(PDO::FETCH_ASSOC);

echo json_encode(array ('status' => true, 'unitquantity' => $data ['quantity']));
