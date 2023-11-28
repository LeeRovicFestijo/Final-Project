<?php
include('dbcon.php');
if (isset($_POST['delete_barangay'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($conn,"DELETE FROM barangay where barangay_id='$id[$i]'");
}
header("location: barangay.php");
}
?>