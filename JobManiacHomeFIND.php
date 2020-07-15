<?php
include("DBCONNECT.php");
session_start();

$user = $_SESSION['user'];

$userid = "SELECT ID FROM userprofiles WHERE Name = '$user'";
$useridget = mysqli_query($connectionstring,$userid);

while($id = mysqli_fetch_assoc($useridget)){
    $u_id = $id['ID'];
}

if($user == null){
    header("location:Login.php");
}

$getfieldquery = "SELECT * FROM fields";
$fields = mysqli_query($connectionstring,$getfieldquery);





$getcompanies = "SELECT J_COMPANY FROM JOBS";
$companynames = mysqli_query($connectionstring,$getcompanies);

$getjobtitles = "SELECT J_TITLE FROM JOBS";
$jobtitles = mysqli_query($connectionstring,$getjobtitles);

error_reporting(0);

$saved = $_GET['saved'];
$unsaved = $_GET['unsaved'];

unset($_GET['saved']);
unset($_GET['unsaved']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>JOB MANIAC</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link type="text/css" href="Style.css" rel="stylesheet">
<style>
    nav a{
        color: green;
        
    }
    
    nav a:hover{
        color: greenyellow;
        border-bottom: 2px solid lawngreen;
    }
    
    nav ul li{
        padding: 0.5vw;    
    }
    
    nav{
        height: 3vh;
    }
</style>    
 
<script>
$(document).ready(function() {
  const $valueSpan = $('.valueSpan2');
  const $value = $('#customRange11');
  $valueSpan.html($value.val());
  $value.on('input change', () => {
    $valueSpan.html($value.val());
  });
});    
</script>    
</head>

<body style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';" >
    
    <?php
    if($saved == 1){ 
    $saved = 0;    
    ?>
    <div class="alert alert-info alert-dismissible">
    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <center><strong>Job Saved Succesfully</strong></center>
    </div>
    <?php     
    }
    elseif($unsaved == 1){ 
    $unsaved = 0;    
    ?>
    <div class="alert alert-info alert-dismissible">
    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <center><strong>Job Un-Saved Succesfully</strong></center>
    </div>
    <?php      
     }
    ?>
    <br>
     <center>
    <h1 class="logo"><ins>JOB MANIAC</ins></h1>
    </center> 
    <br>
<nav class="navbar navbar-expand-lg" style="border: 1px solid aliceblue; border-radius: 1vw; background-color: aliceblue; ">
  <div class="collapse navbar-collapse" id="navbarNav">
      <center>
    <ul class="navbar-nav">
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="#">Saved Job's</a>
        <span class="badge badge-danger"><?php echo $rows;?></span>  
      </li>
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="Profile.php">Profile Information</a>
      </li>
      <li class="nav-item active" style="margin-left: 15vw;">
        <a class="nav-link" href="LogOut.php">Log Out</a>
      </li>    
    </ul>
        </center>  
  </div>
</nav>

<br>
<div class="quicksearchjobs container" style="float:left; width: 400px;">
<br>
<?php
if(isset($_POST['field'])){
extract($_POST);

$selectjobs = "SELECT * FROM jobs WHERE J_FIELD = '$field'";
$result = mysqli_query($connectionstring,$selectjobs);      

}  
?> 
   
<form action="" method="post" class="formsearch">
    
<h4><strong><?php echo $user?></strong> is Looking For a Job in </h4> 
<div class="jobsearchform">    
<div class="fieldselect">

<select name="field" class="form-control" style="width:400px;"> 
<?php
while ($fieldata = mysqli_fetch_assoc($fields)) {			 
?>        
 <option value="<?php echo $fieldata['F_ID']?>"><?php echo $fieldata['F_NAME']?></option>
<?php
    }
?>        
</select>

</div>
<div class="searchbutton">    
<input type="submit" class="btn btn-success" value="Search" style="width:100px; margin-left: 1vw;"> 
</div>
</div>    
</form> 

 <br>
</div>
<br><br><br>  
<?php 
if(isset($_POST['jobtitle']) and isset($_POST['prefsalary']) and isset($_POST['c_name'])){
    extract($_POST);
    $selectjobs = "SELECT * FROM jobs WHERE J_TITLE = '$jobtitle' AND J_SALARY <= $prefsalary AND J_COMPANY = '$c_name'";
    $result = mysqli_query($connectionstring,$selectjobs);      
 
}    
?>    
<div class="filters container" style="float: right; background-color: aliceblue; width: 375px; margin-right: 3vw; border-radius: 0.4vw; border: 2px solid black;">
    <br>
<center>    
<h5>Advanced Filters</h5>
<form method="post" action="">    
<br> 
<h6>Job Title:</h6> 
<select name="jobtitle" class="form-control" style="width: 250px;">
<?php
while($titles = mysqli_fetch_assoc($jobtitles)){
?> 
<option><?php echo $titles["J_TITLE"]?></option>    
<?php    
}    
?>  
</select>  
<br>    
<h6>Preferred Salary(Upto) :  <h5 class="font-weight-bold text-success ml-2 valueSpan2">Upto<h6>Rs/Month</h6></h5></h6> 
<input name="prefsalary" id="customRange11" style="width: 250px; background: #07FF5A"; type="range" class="form-control-range" min="5000" max="250000" step="5000" required>
<br><br>
<h6>Preferred Company:</h6>
<select class="form-control" style="width: 250px;" name="c_name" required>
<option selected disabled>Company Names</option>
<option value="">Any</option>    
<?php
while($names = mysqli_fetch_assoc($companynames)){   
?>
 <option><?php echo $names['J_COMPANY']?></option>   
<?php
    }
?>    
</select>
<br>
<input type="submit" value="Advanced Search" class="btn btn-success" style="width: 230px;"> 
</form>    
</center>    
  <br>
    
</div>
       
<div style="display: flex; flex-wrap: wrap; width: 50vw; float: left; padding-left: 0.75vw;">   
<?php

if(mysqli_num_rows($result) > 0){  
    
while($jobs = mysqli_fetch_assoc($result)){
$j_id = $jobs['J_ID']; 
    
$checksavedquery = "SELECT S_ID FROM savedjobs WHERE J_ID = '$j_id' AND U_ID = '$u_id'";
$checksaved = mysqli_query($connectionstring,$checksavedquery);


?>
<div class="jobsearchresults" style="width:40vw; border:0.15vw solid black; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 3px; border-radius: 0.4vw; padding: 10px; word-break: break-all; box-sizing: content-box;">
<div>
    <?php
    if(mysqli_num_rows($checksaved) > 0){
    ?>
    <a style="float: right;" href="Unsave.php?J_ID=<?php echo $jobs['J_ID']?> & U_ID=<?php echo $u_id ?>"><h5>Unsave</h5></a>
    <?php
    }    
    else{ 
    ?>
    <a href="SaveJob.php?J_ID=<?php echo $jobs['J_ID']?> & U_ID=<?php echo $u_id?>"><img style="float: right;" src="save.png" width="32px" height="32px"></a>
    <?php
    }
    ?>
    <h6 hidden=""><?php echo $jobs['J_ID']?></h6>    
    <h4><strong><?php echo $jobs['J_TITLE']?></strong></h4>
    <hr>
    <h6><strong><?php echo $jobs['J_COMPANY']?></strong></h6>    
    <h6><i><?php echo $jobs['J_DESC']?></i></h6> 
    <h5><strong><?php echo $jobs['J_SALARY']?> PKR</em> / Month</strong></h4>
    <h6><?php echo $jobs['J_TYPE']?></h5>
    <?php
    $FNUM = $jobs['J_FIELD'];    
    $fieldnamequery = "SELECT F_NAME FROM fields where F_ID = '$FNUM'";
    $fieldnameget = mysqli_query($connectionstring,$fieldnamequery);
    while($get = mysqli_fetch_assoc($fieldnameget)){
    $fieldname = $get['F_NAME'];
    }
    ?>
    <h6><strong><span class="badge-light"><?php echo $fieldname?></span></strong></h6>
    <hr>
    <a href="MoreInfo.php?J_ID=<?php echo $jobs['J_ID']?>"><input type="button" class="btn btn-info" value="More Info" style="width: 12vw;"></a>
    <br>
</div>     
</div>
<?php
    }
    }
    else{
        
        echo "No Results Found";
    }
?> 
</div> 
    
</body>
</html>