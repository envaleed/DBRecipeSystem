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
    $val = $mysqli->query("select userID from user where userEmail ='$email'");
            $meal = array();
            if ($val->num_rows > 0) {
          
                while ($row = $val->fetch_assoc()) 
              {  $meal = $row['userID'];

                echo "<div>$meal</div>";
                $userID=$meal;
                }
      }
    


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
          <input type="text" name="weight_rslt" placeholder="Update Weight">
          <button type="submit" name="weight_btn"><b>Submit</b></button>
          <?php 
          $result = $mysqli->query("select weight from `profile` where userID='$userID'; "); 
          if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) 
        { $weight = $row['weight'];
        echo"<div> <h4>Current weight: {$row ['weight']} </h4></div>";
          }
        }
                       
        ?>  
          <input type="text" name="height_rslt" placeholder="Update Height">
          <button type="submit" name="height_btn"><b>Submit</b></button>
          <?php 
          $result = $mysqli->query("select height from `profile` where userID='$userID'; "); 
          if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) 
        { $height = $row['height'];
        echo"<div> <h4>Current weight: {$row ['height']} </h4></div>";
          }
        }
                       
        ?> 
          <input type="text" name="preference_rslt" placeholder="Update Meal Preference">
          <button type="submit" name="preference_btn"><b>Submit</b></button>
          <?php 
          $result = $mysqli->query("select mealTypePreference from `profile` where userID='$userID'; "); 
          if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) 
        { $mealTypePreference = $row['mealTypePreference'];
        echo"<div> <h4>Current Meal Preference: {$row ['mealTypePreference']} </h4></div>";
          }
        }
                       
        ?> 
        </form>    
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
      $temp = $mysqli->query("SELECT * FROM recipe WHERE recipeName LIKE '{$recipe_name}' ORDER BY `creationDate` ASC LIMIT 1"); 
      $recipe_name = [];
      if ($temp->num_rows > 0) {
         echo"<h4>Recipes found are:</h4>";
        while ($row = $temp->fetch_assoc()) {
          echo "<div><a href='recipetemplate.html'>{$row['recipeName']} - {$row['creationDate']}</a></div>";
        }
      }
?>

<?php
      } else {
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
      <h2>Your Current Meal Image</h2>   
      <?php
      $path="img/img2.jpg";
      echo'<img src='.$path.' height="250" width="250">'
      ?>
      <form action="profile.php" method="post" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data">
        <div><p></p></div>
        <input type="file" name="img">
        <input type="submit" name="img_submit_btn">
      
      </form>
      <?php 
      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
        if(isset($_POST['img_submit_btn'])) {
          $doc_name = $_FILES['img']['name'];
          $directory = 'img/';
          $target_file = $directory.$doc_name;
          $mysqli->query("update meal set mealImage='$path' where mealID=UserID");

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
      <h2>Generate Meal</h2> 
      <form action="profile.php" method="post" accept-charset="utf-8" autocomplete="off">
        <input type="number" name="calorie_count_rslt" placeholder="Calorie Number">
        <button type="submit" name="calorie_count_btns"><b>Submit</b></button>
      </form> 

      <?php 
      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
        if(isset($_POST['calorie_count_btns'])) {
            $calorie_count = $_POST['calorie_count_rslt'];
            $temp = $mysqli->query("SELECT * FROM meals WHERE calorieCount <= '$calorie_count'"); 
            $meal = array();
            if ($temp->num_rows > 0) {
              echo "<h6>Meals found are:</h6>";
                while ($row = $temp->fetch_assoc()) 
              {  $meal = $row['mealName'];
                echo "<div>$meal</div>";
                }
      }
            else{
              echo"<h6>Meal not found</h6>";
            }
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
      <h2>Meal Plan</h2>   
      <?php
      echo"<h3>Monday</h3>";
       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
        $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";

       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Lunch' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
        $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }

      $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Dinner' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Lunch</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }
}

              echo"<h3>Tuesday</h3>";
       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";

      $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Lunch' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Lunch</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }

        $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Dinner</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }
}
              echo"<h3>Wednesday</h3>";
       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";

      $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Lunch' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Lunch</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }

        $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Dinner</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }
}

              echo"<h3>Thursday</h3>";
       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";

      $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Lunch' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Lunch</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }

        $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Dinner</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }
}

              echo"<h3>Friday</h3>";
       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";

      $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Lunch' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Lunch</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }

        $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Dinner</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }
}         
                echo"<h3>Saturday</h3>";
       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";

      $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Lunch' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Lunch</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }

        $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Dinner</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }
}
              echo"<h3>Sunday</h3>";
       $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Breakfast</h4>";
          echo"$plan";
          echo" [Calories: $planb]";

      $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Lunch' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Lunch</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
        }

        $temp = $mysqli->query("select distinct mealName, calorieCount from meals where mealType='Breakfast' order by rand() limit 1;"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      $plan = $row['mealName'];
          $planb = $row['calorieCount'];
          }
          echo"<h4>Dinner</h4>";
          echo"$plan";
          echo" [Calories: $planb]";
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
      <?php
      echo"<h3>Kitchen List</h3>";
       $temp = $mysqli->query("SELECT * from kitchen where userID='$userID';"); 
      $plan = array();
      if ($temp->num_rows > 0) {
          while ($row = $temp->fetch_assoc()) 
  {      echo "<div> Measurement Value {$row ['measurementValue']} Measurement Type: {$row['measurementType']} Ingredient Name: {$row['ingredientsName']}  </div>";
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
      <h2>Add Recipe</h2> 
      <form action="profile.php" method="post" accept-charset="utf-8">
        <input type="text" name="preptime" placeholder="Prep Time">
        <input type="text" name="recipeName" placeholder="recipe Name">
        <input type="date" name="creationDate" placeholder="Creation Date">
        <button type="submit" name="addRecipeBtn" onclick="myFunction()""><b>Submit</b></button>
        <p id="demo"></p>
      </form>
    </div>
    </div>  
    <?php 
      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  if(isset($_POST['addRecipeBtn'])) {
      $preptime = $_POST['preptime'];
      $recipename = $_POST['recipeName'];
      $creationdate = $_POST['creationDate'];
      $temp = $mysqli->query("call AddRecipe($preptime,$recipename,$creationdate);"); 
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
      <h2>Instructions</h2> 
      <?php 
        echo "<div><h4>Enter an instruction ID to get an instruction name</h4></div>";
       ?>
      <form action="profile.php" method="post" accept-charset="utf-8">
       <input type="number" name="numval">
       <button type="submit" name="numval_btn"><b>Submit</b></button>
      </form>
      <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if(isset($_POST['numval_btn'])) {
            $num = $_POST['numval'];
            $ins=$mysqli->query("call ShowInstructions($num)");
        while ($row = $ins->fetch_assoc()) {
          $val=$row['instructionName'];
          echo "<div><h6>This is the instruction assigned to the ID number entere: $val</h6></div>";
        }
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
      <h2>Your Current Grocery List </h2> 
      <?php
          echo "<div><h5>You currently do not have any items in your grocery list</h5></div>";
        $gro=$mysqli->query("select * from grocerylist;");
        while ($row = $gro->fetch_assoc()) {
          $list=$row['ingredientsName'];
          echo "$list";

        }
      ?>
    </div>
    </div>  
 
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<script>
function myFunction() {
    document.getElementById("demo").innerHTML = "Database was updated sucessfully";
}
</script>

</body>
</html>
