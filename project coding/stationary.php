<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE stationary SET name='$_POST[name]',quantity='$_POST[quantity]',description='$_POST[description]',status='$_POST[status]' ,cost='$_POST[cost]',vendor='$_POST[vendor]' WHERE id='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Stationary record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		// var_dump($_POST);
		$sql ="INSERT INTO stationary(name,quantity,cost,description,vendor,status) values('$_POST[name]','$_POST[quantity]','$_POST[cost]','$_POST[description]','$_POST[vendor]','$_POST[status]')";
		if($qsql = mysqli_query($con,$sql))
		{

			echo "<script>alert('Stationary record inserted successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM stationary WHERE id='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Add New Stationary </li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Add new Stationary record</h1>
    <form method="post" action="" name="frmmedicine" onSubmit="return validateform()">
    <table width="418" border="3">
      <tbody>
        <tr>
          <td width="34%">Item Name</td>
          <td width="66%"><input type="text" name="name" id="name" value="<?php echo $rsedit[name]; ?>" /></td>
        </tr>
        <tr>
          <td width="34%">Quantity</td>
          <td width="66%"><input type="number" name="quantity" id="quantity" value="<?php echo $rsedit[quantity]; ?>" /></td>
        </tr>
        <tr>
          <td width="34%">Cost</td>
          <td width="66%"><input type="number" step="0.1" name="cost" id="cost" value="<?php echo $rsedit[cost]; ?>" /></td>
        </tr>
        <tr>
          <td>Description</td>
          <td><textarea name="description" id="description" cols="45" rows="5"><?php echo $rsedit[description] ; ?></textarea></td>
        </tr>
        <td width="34%">Vendor</td>
          <td width="66%"><input type="text" name="vendor" id="vendor" value="<?php echo $rsedit[vendor]; ?>" /></td>
        </tr>
        <tr>
          <td>Status</td>
          <td> <select name="status" id="status">
            <option value="">Select</option>
            <?php
		  $arr = array("Active","Inactive");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[status])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
            </select></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    </form>
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
<script type="application/javascript">
/*
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmmedicine.departmentname.value == "")
	{
		alert("Department name should not be empty..");
		document.frmdept.departmentname.focus();
		return false;
	}
	else if(!document.frmmedicine.departmentname.value.match(alphaExp))
	{
		alert("Department name not valid..");
		document.frmdept.departmentname.focus();
		return false;
	}
	else if(document.frmmedicine.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmdept.select.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
*/
</script>