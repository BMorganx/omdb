<?php

  // set the current page to one of the main buttons
  $nav_selected = "HOME";

  // make the left menu buttons visible; options: YES, NO
  $left_buttons = "NO";

  // set the left menu button selected; options will change based on the main selection
  $left_selected = "";

  include("./nav.php");
?>

<html>
<link rel="stylesheet" href="css/mainStyleSheet.css" type="text/css">
<head>
<style>
table.center {
    margin-left:auto; 
    margin-right:auto;
  }
  .image {
            
            padding: 20px 20px 20px 20px;
            transition: transform .2s;
        }
        .image:hover {
            transform: scale(1.2)
        }
        #table_1 {
            border-spacing: 300px 0px;
        }
        #table_2 {
            margin-left: auto;
            margin-right: auto;
        }  
</style>
 <!--This is for bootstrap for carousel-->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>
<h2 style = "color: #01B0F1;">Welcome to OMDB </h3>



<?php
        if(isset($_GET['preferencesUpdated'])){
            if($_GET["preferencesUpdated"] == "Success"){
                echo "<br><h3 align=center style='color:green'>Success! The Preferences have been updated!</h3>";
            }
        }
    ?>
    
    <br>
    <h2 id = "directions">Latest Movies</h2><br>

</head>
<body>
<?php

    $sql1 = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_MOVIES_PER_ROW'";
    $sql4 = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_MOVIES_TO_SHOW'";
    $sql5 = "SELECT `comments` FROM `preferences` WHERE `name`= 'DEFAULT_VIEW_FOR_HOME_PAGE'";
    $sql6 = "SELECT `value` FROM `preferences` WHERE `name`= 'IMAGE_HEIGHT_IN_GRID'";
    $sql7 = "SELECT `value` FROM `preferences` WHERE `name`= 'IMAGE_WIDTH_IN_GRID'";
    $sql8 = "SELECT `value` FROM `preferences` WHERE `name`= 'IMAGE_HEIGHT_IN_CAROUSAL'";
    $sql9 = "SELECT `value` FROM `preferences` WHERE `name`= 'IMAGE_WIDTH_IN_CAROUSAL'";
    

    //select puzzles using the preferences restrictions
    $sql2 = "SELECT `english_name`, `movie_id`, `m_link`, `plot` FROM `movies` ORDER BY RAND() LIMIT $questNum"; //using this as the real one
    $sql3 = "SELECT `m_link` FROM `movies` ORDER BY RAND() LIMIT $questNum";

    $results1 = mysqli_query($db,$sql1);
    $results2 = mysqli_query($db,$sql2);
    $results3 = mysqli_query($db,$sql3);
    $results4 = mysqli_query($db,$sql4);
    $results5 = mysqli_query($db,$sql5);
    $results6 = mysqli_query($db,$sql6);
    $results7 = mysqli_query($db,$sql7);
    $results8 = mysqli_query($db,$sql8);
    


    if(mysqli_num_rows($results1)>0){
        while($row = mysqli_fetch_assoc($results1)){
            $column[] = $row;
        }
    }
    
    
    if(mysqli_num_rows($results2)>0){
        while($row = mysqli_fetch_assoc($results2)){
            $dishes[] = $row;
        }
    }

    if(mysqli_num_rows($results3)>0){
        while($row = mysqli_fetch_assoc($results3)){
            $pics[] = $row;
        }
    }

    if(mysqli_num_rows($results4)>0){
        while($row = mysqli_fetch_assoc($results4)){
            $numdish[] = $row;
        }
    }

    if(mysqli_num_rows($results5)>0){
        while($row = mysqli_fetch_assoc($results5)){
            $view[] = $row;
        }
    }

    if(mysqli_num_rows($results6)>0){
        while($row = mysqli_fetch_assoc($results6)){
            $height_grid[] = $row;
        }
    }

    if(mysqli_num_rows($results7)>0){
        while($row = mysqli_fetch_assoc($results7)){
            $width_grid[] = $row;
        }
    }

    if(mysqli_num_rows($results8)>0){
        while($row = mysqli_fetch_assoc($results8)){
            $height_car[] = $row;
        }
    }

    



    $columns = $column[0]['value'];

    $numdishes = $numdish[0]['value'];

    $count= count($dishes);

    $defaultView = $view[0]['comments'];

    $height_grids = $height_grid[0]['value'];
    $width_grids = $width_grid[0]['value'];
    //$height_cars = $height_car[0]['value'];
    
   


//if user is logged in use database info
if( isset( $_SESSION['logged_in'] ) || !isset($_COOKIE['numberOfRows']) ) {

    
    if( $defaultView == 'Grid'){  //if view is set to GRID

    echo "<table id = 'table_2'>
    <!--Links to quizzes can be put inside the href = -->";
    echo "<tr>";
    for($a=0;$a<$count;$a){
        for($b=0;$b<$columns;$b++){
            
            if($a>=$count){
                break;
            }else{
                
        $dish = $dishes[$a]['Name'];
        $pic = $dishes[$a]['Image'];
        $id = $dishes[$a]['Id'];
        $desc = $dishes[$a]['Description'];
        
        echo "
        <td>
            <a href = 'display_dish.php?id=$id&mode=Image' t+itle = $desc>
            <img class = 'image' src='./images/$pic'  alt= $pic height=$height_grids  width=$width_grids>
                
            </a>
        </td>";
        $a++;
            }
        }
    echo "</tr>";
    }   
    echo"</table>";
    }
   if( $defaultView == 'Carousal'){  // if the view is set to carousal

    //echo "it works";


    echo "<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
    <div class='carousel-inner'>
      <div class='carousel-item active'>
        <img src='./images/Images/crop_top_girl.jpg'  alt='...' height=$height_cars  width=$width_cars>
      </div>";

    


    for ($a=0; $a<$count; $a++){

        //loop through all the images
        $pic = $dishes[$a]['Image'];
        $id = $dishes[$a]['id'];
        echo "<div class='carousel-item'>
        <a href = 'view_dish.php?id=$id&mode=image' title = $id>
        <img src='./images/Images/$pic'  alt='$pic' height=$height_cars  width=$width_cars>
      </div>";
    
    }
    
    echo "</div>
    <a  class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
      <span class='carousel-control-prev-icon' aria-hidden='true'></span>
      <span class='sr-only'>Previous</span>
    </a>
    <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
      <span class='carousel-control-next-icon' aria-hidden='true'></span>
      <span class='sr-only'>Next</span>
    </a>
  </div>";

   } 

   else{

        if($defaultView == 'list'){
       echo "To Do: link to list.php";
    }
       // as of now list view does not exist
   }

}else{

    //use cookies if there are presets and user is not logged on
    

    
        include('cookie_index_view.php');
}
    ?>    
</body>
</head>
</html>