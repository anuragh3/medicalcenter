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
      <li class="first">Dialy,Weekly ,Monthly & 	Yearly wise Billing Report</li></ul>
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
          <th width="20%"><div align="center">Billing details</div></th>
					<th width="20%"><div align="center">Billing Amount</div></th>
					<th width="20%"><div align="center">Billing Status</div></th>
          <!-- <th width="17%"><div align="center">Action</div></th> -->
        </tr>
        </thead>
      <tbody>
   <?php
	  if(isset($_GET[from_date]) && isset($_GET[to_date])){
			if(!empty($_GET[from_date]) && !empty($_GET[to_date])){
		   $sql ="SELECT p.loginid,p.patientname,b.billingdate,b.billingtime,br.status,br.bill_amount FROM billing b join patient p on b.patientid=p.patientid join billing_records br on br.billingid=b.billingid where b.billingdate BETWEEN '$_GET[from_date]' AND '$_GET[to_date]'";
		 }else if(!empty($_GET[from_date])){
       $sql ="SELECT p.loginid,p.patientname,b.billingdate,b.billingtime,br.status,br.bill_amount FROM billing b join patient p on b.patientid=p.patientid join billing_records br on br.billingid=b.billingid where b.billingdate >= '$_GET[from_date]'";
 		}else if(!empty($_GET[to_date])){
        $sql ="SELECT p.loginid,p.patientname,b.billingdate,b.billingtime,br.status,br.bill_amount FROM billing b join patient p on b.patientid=p.patientid join billing_records br on br.billingid=b.billingid where b.billingdate <= '$_GET[to_date]'";
 		}else{
			$sql ="SELECT p.loginid,p.patientname,b.billingdate,b.billingtime,br.status,br.bill_amount FROM billing b join patient p on b.patientid=p.patientid join billing_records br on br.billingid=b.billingid";
		}
		}else{
      $sql ="SELECT p.loginid,p.patientname,b.billingdate,b.billingtime,br.status,br.bill_amount FROM billing b join patient p on b.patientid=p.patientid join billing_records br on br.billingid=b.billingid";
		}
		// echo $sql;
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			if(strcmp($rs[status],'active')){
				$status='Pending';
			}else{
				$status="Paid";
			}
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
		<strong>Date</strong>: &nbsp;$rs[billingdate]<br>
		<strong>Time</strong>: &nbsp;$rs[billingtime]</td>


<td>$rs[bill_amount]</td>
<td>$status</td>
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
