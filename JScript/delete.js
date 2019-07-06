jsfunction()
{
if(window.confirm("Are you sure you want to delete that record?")) {
  document.location = "deletedata.php?rownum='.$rows['sno'].'";
}
}
