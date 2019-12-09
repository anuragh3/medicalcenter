<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_POST["btnSubmit"])){
	      $current=date("Y/m/d");
        $type=$_POST['type'];
				$patient_id=$_POST['patient_id'];
        $file_name=$_FILES["files"]["name"];
        $file_tmp=$_FILES["files"]["tmp_name"];
				$newFileName=basename($file_name);
        if(move_uploaded_file($_FILES["files"]["tmp_name"],"upload/".$newFileName)){
                $query = "INSERT INTO medical_certificate(patient_id,issued_id,date_i,filepath,filename,type) VALUES('".$patient_id."','".$_SESSION[adminid]."','".$current."','upload','".$newFileName."','".$type."')";
                $qsql_f=mysqli_query($con,$query);
        }else{
					echo "error in file upload";
				}
        mysqli_close($con);
				header('Location:http://www.example.com/');
				// exit();
    }
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
      <li class="first">View Patient records</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

<section class="container">
<h2>Search Patient - <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filtrer" /></h2>


	<table class="order-table">
      <thead>
        <tr>
          <th width="15%" height="36"><div align="center">Patient Name</div></th>
          <th width="20%"><div align="center">Admission details</div></th>
          <th width="28%"><div align="center">Address</div></th>
          <th width="20%"><div align="center">Patient Profile</div></th>
          <th width="17%"><div align="center">Action</div></th>
        </tr>
        </thead>
      <tbody>
   <?php
		$sql ="SELECT * FROM patient";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{

      $issue ="| <a class='btn btn-primary issue' id='$rs[patientid]' data-toggle='modal' data-target='#myModal'>Issue</button>";
    

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
          <td align='center'>";
if(isset($_SESSION[adminid]))
{
		  echo "
<a href='patientreport.php?patientid=$rs[patientid]'>View Report</a> | <a href='patient.php?editid=$rs[patientid]'>Edit</a> | <a href='viewpatient.php?delid=$rs[patientid]'>Delete</a> ".$issue." ";

}
		  echo "</td></tr>";
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
 <div class="container">
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Certificate Issue</h4>
        </div>
        <div class="modal-body">
					<form action="/ohms/viewpatient.php" method="post" enctype="multipart/form-data">
            <select name="type">
                <option value="1">Medical Certificate</option>
                <option value="2">Fitness Certificate</option>
            </select>
						<input type="hidden" value="" name="patient_id" id="patient_id" />
						<br><br>
						<input type="file" id="myFile" name="files">
            <br>
           <input type="submit" name="btnSubmit" value="issue" style="padding: 1px 10px;">
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>

  </div>
</div>
<?php
// include("footer.php");
?>
<script>
  $(".issue").click(function(){
		var patientid=$(this).attr('id');
		$('#patient_id').val(patientid);
	});
</script>
