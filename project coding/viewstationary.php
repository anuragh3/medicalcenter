<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM stationary WHERE id='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Stationary record deleted successfully..');</script>";
	}
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">View  Stationary list</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
  
<section class="container">
<h2>Search stationary - <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filtrer" /></h2>


	<table class="order-table">
      <thead>
        <tr>
          <th>Item name</th>
          <th>Quantity</th>
          <th>Cost</th>
          <th>description</th>
          <th>Vendor</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        </thead> 
        <tbody>
        
          <?php
		$sql ="SELECT * FROM stationary";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[name]</td>
          <td>&nbsp;$rs[quantity]</td>
          <td>&nbsp;$rs[cost]</td>
          <td>&nbsp;$rs[description]</td>
          <td>&nbsp;$rs[vendor]</td>
			 <td>&nbsp;$rs[status]</td>
			 <td>&nbsp;
			  <a href='stationary.php?editid=$rs[id]'>Edit</a> | <a href='viewstationary.php?delid=$rs[id]'>Delete</a> </td>
        </tr>";
		}
		?>
      </tbody>
    </table>
    </section>
    <h1>&nbsp;</h1>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>