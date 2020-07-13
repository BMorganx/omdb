
<?php $page_title = 'Display Movie'; ?>
<?php $page_title = 'OMDB > Display Movie'; ?>
<?php

 // set the current page to one of the main buttons
  $nav_selected = "HOME";

  // make the left menu buttons visible; options: YES, NO
  $left_buttons = "NO";

  // set the left menu button selected; options will change based on the main selection
  $left_selected = "";

  include("./nav.php");
  // include("./index_home.php");
    require 'bin/functions.php';
    require 'db_configuration.php';
   // include('header.php');
    $page="list.php";
    //verifyLogin($page);

?>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>
<link rel="stylesheet" href="css/mainStyleSheet.css" type="text/css">

<?php
include_once 'db_configuration.php';

if (isset($_GET['movie_id'])){

    $id = $_GET['movie_id'];

    $sql = "SELECT * FROM movies
            WHERE ID = '$movie_id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

//if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      if(isset($_GET['modifyQuestion'])){
        if($_GET["modifyQuestion"] == "answerFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyQuestion'])){
        if($_GET["modifyQuestion"] == "fileTypeFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not a valid image type (jpg,jpeg,png,gif), Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyQuestion'])){
        if($_GET["modifyQuestion"] == "fileExistFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image does not exist, Please Try Again!</h3>';
        }
      }

      echo '<h2 id="title">Dish Details</h2><br>';
      echo '<form action="modifyTheDish.php" method="POST" enctype="multipart/form-data">
      <br>
      <h3>'.$row["Name"].' </h3> <br>
      
      <div>
       <img src="images/'.$row["Image"].'" style="width:200px;height:200px;">
       <br>
    </div>

      <div>
      <label for="movie_id">Dish Id Number: </label> '.$row["ID"].'
      
    </div>


    <div>
      <label for="level">Type: </label> '.$row["Type"].'
      
    </div>


    <div>
      <label for="facilitator">State: </label> '.$row["State"].' 
      </div>

    
   
    <div>
    <label for="description">Description: </label> '.$row["Description"].'
    
    </div>

    <div>
    <label for="description">Keywords: </label> '.$row["Keywords"].'
    
    </div>
    
    <div>
      <label for="description">Recipe_links: </label> '.$row["Recipe_links"].'
    
    </div>

    <div>
      <label for="description">Video_links: </label> '.$row["Video_links"].'
     
    </div>


    <div>
      <label for="description">Notes: </label> '.$row["Notes"].'
      
    </div>

    


      </form>';

    }

?>