<?php
require 'db.php';
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--   <link rel="stylesheet" type="text/css" href="/css/style.css"> -->
  <style>
  * {
      box-sizing: border-box;
  }
  .row::after {
      content: "";
      clear: both;
      display: table;
  }
  .col{
    background-color: #1ab188;
  }
  [class*="col-"] {
      float: left;
      padding: 15px;
  }
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
  html {
  font-family: 'Titillium Web', sans-serif;
  background-color: rgba(19, 35, 47, 0.9);
  }
  .header {
      background-color: #1ab188;
      color: #ffffff;
      padding: 15px;
  }
  .menu ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
  }
  .menu li {
      padding: 8px;
      margin-bottom: 7px;
      background-color: #33b5e5;
      color: #ffffff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  }
  .menu li:hover {
      background-color: #0099cc;
  }
  .button {
  border: 0;
  outline: none;
  border-radius: 0;
  padding: 15px 0;
  font-size: 2rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .1em;
  background: #1ab188;
  color: #ffffff;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  -webkit-appearance: none;
}
.button:hover, .button:focus {
  background: #179b77;
  .topnav input[type=text] {
    float: right;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
}
#input[type=text]{
    float: right;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
}

}
  </style>
  <title>Welcome <?= $first_name.' '.$last_name ?></title>

</head>

<body>
  <div class="row">
    <div class="col-1">   
    </div>
    <div class="header col-10 ">
      <h1><center>Welcome</center></h1>
      <h2><center><?php echo $first_name.' '.$last_name; ?></center></h2>
      <center><p><?= $email ?></p></center>
      <center class="button""><a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a></center>
    </div> 

  </div> 
  <br>

  <div class="row">   
    <div class="col-1">            
    </div>
    <div class="col-10 col"> 
    <h2>Profile</h2> 
        <form action="profile.php" method="post" autocomplete="off">
          <h4><?php echo 'Sex:'.' '; ?></h4>
          <input type="text" name="sex_rslt" placeholder="Update Sex">
          <button type="submit" name="sex_btn"><b>Submit</b></button>
          <h4><?php echo 'Weight:'.' '; ?></h4>
          <input type="text" name="weight_rslt" placeholder="Update Weight">
          <button type="submit" name="weight_btn"><b>Submit</b></button>
          <h4><?php echo 'Height:'.' '; ?></h4>
          <input type="text" name="height_rslt" placeholder="Update Height">
          <button type="submit" name="height_btn"><b>Submit</b></button>
          <h4><?php echo 'Meal Preference:'.' '; ?></h4> 
          <input type="text" name="preference_rslt" placeholder="Update Meal Preference">
          <button type="submit" name="preference_btn"><b>Submit</b></button>
        </form>
        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
          if(isset($_POST['sex_btn'])) {
              $gender = $_POST['sex_rslt'];
              $result = $mysqli->query(""); 
            }              
          }
        ?>      
    </div>
  </div>


    <br>

    <div class="row">
      <div class="col-1">
      </div>
      <div class="col-10 col">
        <h2>Recipe</h2>
        <form action="profile.php" method="post" autocomplete="off">
          <input type="search" name="search_rslt" placeholder="Search">
          <button type="submit" name="search_btn"><b>Submit</b></button>
        </form>
        <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  if(isset($_POST['search_btn'])) {
      $recipe_name = $_POST['search_rslt'];
      $temp = $mysqli->query("SELECT * FROM recipe WHERE recipeName LIKE '$recipe_name'"); 
      $recipe_name = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $recipe_name[] = $row['recipeName'];
          }
}
?>

<h4>Recipes found are:</h4>

<?php
       foreach($recipe_name as $name) {
  
           echo "<div><a href=\"\">$name</a></div>";
          }
      }
      else {
        echo "Not found";
      }
  }
?>
      </div>
    </div>

    <br>

  <div class="row">   
    <div class="col-1">            
    </div>
    <div class="col-10 col">  
      <h2>Kitchen</h2>   
    </div>
  </div>

<br>

  <div class="row">   
    <div class="col-1">            
    </div>
    <div class="col-10 col">  
      <h2>Meal</h2>   
    </div>
  </div>
          
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
