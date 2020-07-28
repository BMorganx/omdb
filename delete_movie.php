<?php
$nav_selected = "MOVIES";
$left_buttons = "YES";
$left_selected = "MOVIES";

include("./nav.php");
require 'bin/functions.php';
require 'db_configuration.php';
global $db;



if (isset($_GET['movie_id'])) {
  $movie_id = mysqli_real_escape_string($db, $_GET['movie_id']);

  unlink($file);

  $sql = "DELETE FROM movies
          WHERE movie_id = '$movie_id'";
  
  $result = $db->query($sql);
  header('location:movies.php?moviesDeleted=Success');
}
?>



