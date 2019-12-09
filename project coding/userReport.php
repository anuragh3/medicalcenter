<?php
session_start();
include("header.php");
include("dbconnection.php");
// var_dump(date("Y/m/d"));
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('patient record deleted successfully..');</script>";
	}
}
if(isset($_GET[issueid]))
{
  $current=date("Y/m/d");
  $sql ="INSERT INTO medical_certificate(patient_id,issued_id,date_i) values('$_GET[issueid]','$_SESSION[adminid]','$current')";
    if($qsql = mysqli_query($con,$sql))
    {

      echo "<script>alert('Medical Certificate Issued');</script>";
    }
    else
    {
      echo mysqli_error($con);
    }
}

?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Dialy,Weekly ,Monthly & 	Yearly wise User Report</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

<section class="container">
<p><form method="get" action=""><strong>From Date -</strong><input type="date" name="from_date" value="<?php echo $_GET[from_date]; ?>" /><strong>To Date -</strong> <input type="date" name="to_date" value="<?php echo $_GET[to_date]; ?>" /> <input type="submit" name="submit" value="Submit" /></form></p>


	<table class="order-table">
      <thead>
        <tr>
          <th width="15%" height="36"><div align="center">User Name</div></th>
          <th width="20%"><div align="center">Admission details</div></th>
          <th width="28%"><div align="center">Address</div></th>
          <th width="20%"><div align="center">Patient Profile</div></th>
          <!-- <th width="17%"><div align="center">Action</div></th> -->
        </tr>
        </thead>
      <tbody>
   <?php
	  if(isset($_GET[from_date]) && isset($_GET[to_date])){
			if(!empty($_GET[from_date]) && !empty($_GET[to_date])){
		   $sql ="SELECT * FROM patient where admissiondate BETWEEN '$_GET[from_date]' AND '$_GET[to_date]'";
		 }else if(!empty($_GET[from_date])){
       $sql ="SELECT * FROM patient where admissiondate >= '$_GET[from_date]'";
 		}else if(!empty($_GET[to_date])){
        $sql ="SELECT * FROM patient where admissiondate <= '$_GET[to_date]'";
 		}else{
			$sql ="SELECT * FROM patient";
		}
		}else{
      $sql ="SELECT * FROM patient";
		}
		// echo $sql;
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
    //   $sql1 ="SELECT * FROM medical_certificate WHERE patient_id =$rs[patientid] ";
    // $qsql1 = mysqli_query($con,$sql1);
    // if(mysqli_fetch_array($qsql1)){
    //     $issue ="";
    // }else{
    //   $issue ="| <a href='viewpatient.php?issueid=$rs[patientid]'>Issue</a>";
    // }

        echo "<tr>
          <td>$rs[patientname]<br>
		  <strong>Login ID :</strong> $rs[loginid] </td>
			<td>
		<strong>Date</strong>: &nbsp;$rs[admissiondate]<br>
		<strong>Time</strong>: &nbsp;$rs[admissiontime]</td>

		   <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
Mob No. - $rs[mobileno]</td>
			    <td><strong>Blood group</strong> - $rs[bloodgroup]<br>
<strong>Gender</strong> - &nbsp;$rs[gender]<br>
<strong>DOB</strong> - &nbsp;$rs[dob]</td>
          ";
		  echo "</tr>";
		}
		?>
      </tbody>
    </table>
</section>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
// include("footer.php");
?>
