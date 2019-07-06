<?php

include('header.php');

// First of all, don't make use of mysql_* functions, those are old
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "");
require_once "telerivet.php";
$api_key = "eVv539O1l8DtOEO9wxfr5ifCuMWJsAzV"; // see https://telerivet.com/dashboard/api
$project_id = "PJdea3b3738e87a394";

//require_once dirname(dirname(__FILE__)) . '/telerivet.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
$emp_dept_id=$_POST['emp_dept_id'];
$query	="SELECT emp_mobile FROM staff_tbl WHERE emp_dept_id='".$emp_dept_id."'";
 $res	=	mysql_query($query);
 
							
if(mysql_num_rows($res)>0)
{   
while($row=mysql_fetch_array($res))
{
							echo "<tr>";
  //echo "<td><input type='checkbox' name='check[]' value=" . $row['emp_mobile'] ."></td>";
 // echo "<td><input type='checkbox' name='select' value=" . $row['emp_mobile'] . "></td>";
  //echo "<td>" . $row['emp_name'] . "</td>";
  //echo "<td>" . $row['emp_mobile'] . "</td>";
  //echo "</tr>";
	
    $to_number = $row['emp_mobile'];
    $content = $_POST['content']."\r\n"."Zubair MD Khan"."\r\n"."Jr Administrative Officer"."\n\r"."NIMS";
    
    $api = new Telerivet_API($api_key);
    
    $project = $api->initProjectById($project_id);
    
    try
    {
        $contact = $project->sendMessage(array(
            'to_number' => $to_number,
            'content' => $content
        ));
        
        $status_html = "<div class='success'>Message sent successfully.</div>";
    }
	
    catch (Telerivet_Exception $ex)
    {
        $status_html = "<div class='error'>".htmlentities($ex->getMessage())."</div>";
    }
}
}
}
else
{
    $to_number = $content = '';
    $status_html = '';
}

?>
<html>
<head>

<style type='text/css'>

body.sample_form
{
    font-family:Verdana, sans-serif;
    padding:20px;
}

.sample_form label
{
    display:block;
    font-weight:bold;
}
.sample_form .field
{
    padding:8px 0px;
}

.sample_form .input-text
{
    padding:3px;
}

.sample_form .input-textarea
{
    padding:3px;
    width:250px;
    height:60px;
}

</style>
 <script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
	document.getElementById("txtHint1").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
      document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getnames.php?q="+str,true);
  xmlhttp.send();
}
</script>

</head>
<body class='sample_form'>
<div id="page_content">
<h4>Send an SMS message</h4>
<form method='POST'>

<div class='field'>

<div class="control-group">
			<label class="control-label">Department Name</label>
                    <div class="controls">
						 <select id="emp_dept_id" name="emp_dept_id" onchange="showUser(this.value)">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT emp_dept_id,emp_dept_name FROM cat_tbl order by emp_dept_name");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['emp_dept_id']; ?>"><?php echo $row ['emp_dept_name']; ?></option><?php
                            }
                        ?>
                        </select>
                      
						
                    </div>
					
                </div>

</div>

<?php
 /*
if(isset($_POST['search']))
{
$emp_dept_id=$_POST['emp_dept_id'];
$query	="SELECT emp_name,emp_mobile FROM emp_tbl WHERE emp_dept_id='".$emp_dept_id."'";
 $res	=	mysql_query($query);
 
							
if(mysql_num_rows($res)>0)
{   
echo "<table border='1'>
<tr>

<th>EmployeeName</th>
<th>MobileNo</th>
</tr>";
$i=0;
while($row=mysql_fetch_array($res))
{
							echo "<tr>";
  //echo "<td><input type='checkbox' name='check[]' value=" . $row['emp_mobile'] ."></td>";
 // echo "<td><input type='checkbox' name='select' value=" . $row['emp_mobile'] . "></td>";
  echo "<td>" . $row['emp_name'] . "</td>";
  echo "<td>" . $row['emp_mobile'] . "</td>";
  echo "</tr>";
							
							}
}
}
*/
?>


<div id="txtHint" >
</div>


<div class='field'>
<label>SMS Content</label>
<textarea class='input-textarea' type='text' name='content'><?php echo htmlentities($content); ?></textarea>
</div>

<input type='submit' value='Send' />
<br /><br />
<?php echo $status_html; ?>
</form>
</body>
<hr />
<?php 
include('footer.php');
?>
</html>