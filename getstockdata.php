<?php
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "root");

header("Content-Type:application/json; Charset=utf-8");

// As you can see, here you will have where Employee_ID = :employee_id, this will be
// automatically replaced by the PDO object with the data sent in execute(array('employee_id' => $_POST['Employee_ID']))
// This is a good practice to avoid SqlInyection attacks
$st = $pdo->prepare("select quantity from nims_store.stocks_tbl where item_id=:item_id");
$st->execute(array ('item_id' => $_POST['item_id']));
$data = $st->fetch(PDO::FETCH_ASSOC);
$i=-1;
if($data ['quantity']>=0)
{
echo json_encode(array ('status' => true, 'quantity' => $data ['quantity']));
}
else if($data ['quantity']==NULL)
{
echo json_encode(array ('status' => true, 'quantity' =>$i ));
}
