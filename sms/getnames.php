<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','nims_store');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT emp_name,emp_mobile FROM staff_tbl WHERE emp_dept_id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table border='1'>
<tr>
<th>S.No</th>
<th>EmployeeName</th>
<th>MobileNo</th>
</tr>";
$i=0;
while($row = mysqli_fetch_array($result)) {

  echo "<tr>";
  //echo "<td><input type='checkbox' name='check[]' value=" . $row['emp_mobile'] ."></td>";
 // echo "<td><input type='checkbox' name='select' value=" . $row['emp_mobile'] . "></td>";
  echo "<td>".++$i."</td>";
  echo "<td>" . $row['emp_name'] . "</td>";
  echo "<td>" . $row['emp_mobile'] . "</td>";
  echo "</tr>";
}
echo "</table>";
while($row = mysqli_fetch_array($result)) {
echo $row['emp_mobile'];
}
mysqli_close($con);
?> 
