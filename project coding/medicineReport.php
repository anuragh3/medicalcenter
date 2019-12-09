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
      <li class="first">Dialy,Weekly ,Monthly & 	Yearly wise Medicine Purchased/Sale Report</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

<section class="container">
<p><form method="get" action=""><strong>From Date -</strong><input type="date" name="from_date" value="<?php echo $_GET[from_date]; ?>" /><strong>To Date -</strong> <input type="date" name="to_date" value="<?php echo $_GET[to_date]; ?>" /> <input type="submit" name="submit" value="Submit" /></form></p>


	<table class="order-table">
      <thead>
        <tr>
          <th width="15%" height="36"><div align="center">Patient Name</div></th>
          <th width="20%"><div align="center">Medicine Sale/Purchased date</div></th>
					<th width="20%"><div align="center">Medicine Name</div></th>
					<th width="20%"><div align="center">Medicine Cost</div></th>
					<th width="20%"><div align="center">Medicine Quantity</div></th>
					<th width="20%"><div align="center">Total Amount</div></th>
          <!-- <th width="17%"><div align="center">Action</div></th> -->
        </tr>
        </thead>
      <tbody>
   <?php
	  if(isset($_GET[from_date]) && isset($_GET[to_date])){
			if(!empty($_GET[from_date]) && !empty($_GET[to_date])){
		   $sql ="SELECT * FROM prescription ps join patient p on ps.patientid=p.patientid join prescription_records psr on psr.prescription_id=ps.prescriptionid where ps.prescriptiondate BETWEEN '$_GET[from_date]' AND '$_GET[to_date]'";
		 }else if(!empty($_GET[from_date])){
       $sql ="SELECT * FROM prescription ps join patient p on ps.patientid=p.patientid join prescription_records psr on psr.prescription_id=ps.prescriptionid where ps.prescriptiondate >= '$_GET[from_date]'";
 		}else if(!empty($_GET[to_date])){
        $sql ="SELECT * FROM prescription ps join patient p on ps.patientid=p.patientid join prescription_records psr on psr.prescription_id=ps.prescriptionid where ps.prescriptiondate <= '$_GET[to_date]'";
 		}else{
			$sql ="SELECT * FROM prescription ps join patient p on ps.patientid=p.patientid join prescription_records psr on psr.prescription_id=ps.prescriptionid";
		}
		}else{
      $sql ="SELECT * FROM prescription ps join patient p on ps.patientid=p.patientid join prescription_records psr on psr.prescription_id=ps.prescriptionid";
		}
		 	echo $sql;
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$total=$rs[unit]*$rs[cost];
				// var_dump($rs);
			// if(strcmp($rs[status],'active')){
			// 	$status='Pending';
			// }else{
			// 	$status="Paid";
			// }
			// if(strcmp())
			// var_dump($rs);
    //   $sql1 ="SELECT * FROM medical_certificate WHERE patient_id =$rs[patientid] ";
    // $qsql1 = mysqli_query($con,$sql1);
    // if(mysqli_fetch_array($qsql1)){
    //     $issue ="";
    // }else{
    //   $issue ="| <a href='viewpatient.php?issueid=$rs[patientid]'>Issue</a>";
    // }

        echo "<tr>
          <td>$rs[patientname]<br>
		  <strong>Registration ID :</strong> $rs[loginid] </td>
			<td>
		<strong>Date</strong>: &nbsp;$rs[prescriptiondate]</td>
<td>$rs[medicine_name]</td>
<td>$rs[cost]</td>
<td>$rs[unit]</td>
<td>$rs[unit]*$rs[cost]=$total</td>

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
