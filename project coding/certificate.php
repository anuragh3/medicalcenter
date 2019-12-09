<?php
session_start();
include("header.php");
include("dbconnection.php");

?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Issued Certificates</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Issued Certificates</h1>
		<?php
		$sql1 ="SELECT * FROM medical_certificate WHERE patient_id =".$_SESSION[patientid];
    $qsql1 = mysqli_query($con,$sql1);
		if(mysqli_num_rows($qsql1) > 0)
		{
			?>
			<table class="table">
				<tr>
					<td>Type of Certificate</td>
					<td>Issued Date</td>
					<td>Certificate</td>
				</tr>

					<?php
					while($row = mysqli_fetch_assoc($qsql1))
					{
							// print_r($row);
							if($row[type]==1){
								$type="Medical Certificate";
							}else{
								$type="Fitness Certificate";
							}
							$url = $row["filepath"]."/".$row["filename"];
							echo "<tr><td>$type</td><td>$row[date_i]</td><td><a href='$url' target='_blank'>Click to view</a></td></tr>";
					}
					?>

			</table>
			<?php

		}else{
			echo "No Certificates";
		}

		?>
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
