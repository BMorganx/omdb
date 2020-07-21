
<?php
$nav_selected = "PEOPLE";
$left_buttons = "YES";
$left_selected = "NO";

include("./nav.php");
require 'bin/functions.php';
require 'db_configuration.php';
global $db;
?>

<!-- =====================================================================================================

This page displays the information about people given a people_id.
The input is "people_id". 
This "people_id" is passed to people_info.php as a URL parameter.

This pages displays the people information in four sections.

[A] PEOPLE data 
[B] PEOPLE aggregation
[C] PEOPLE - Movies
[D] PEOPLE - Songs

The above three sections are outlined below

[A] PEOPLE data 
people_id
stage_name
first_name
middle_name
last_name
gender
image_name

[B] PEOPLE aggegation
(display this as a table or name value pairs;
Do whatever is easier for you)

No of Movies as <role1>: 
No of Movies as <role2>: 
No of Movies as <role3>: 
No of Songs as Composer: 
No of Songs as Lyricist:
No of Songs as Music Director:

[C] PEOPLE - Movies
(display this as a table)

movie_id, native_name, english_name, year_made, role, screen_name


[D] PEOPLE - Songs

Display Type: Show this as a table

song_id
title 
lyrics (show first 30 characters)
role (from song_people)

===================================================================================================== -->

<!-- ========== Getting the people id =====================================
// This is the people_id coming to this page as GET parameter
// We will fetch it and save it as $people_id to be used in our queries
======================================================================== -->
<?php
if (isset($_GET['people_id'])) {
  $people_id = mysqli_real_escape_string($db, $_GET['people_id']);
}
?>


<!-- ================ [A] People Data (table: people) ======================
[A] PEOPLE data 
people_id
stage_name
first_name
middle_name
last_name
gender
image_name
========================================================================= -->

<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;">[A] People -> Basic Data</h3>

    <?php


    // query string for the Query A.1
    $sql_A1m = "SELECT people_id, stage_name, first_name, middle_name, last_name, gender, image_name 
               FROM people 
               WHERE people_id =" . $people_id;

    if (!$sql_A1m_result = $db->query($sql_A1m)) {
      die('There was an error running query[' . $connection->error . ']');
    }

    if ($sql_A1m_result->num_rows > 0) {
      $a1m_tuple = $sql_A1m_result->fetch_assoc();
      echo '<br> People ID : ' . $a1m_tuple["people_id"] .
        '<br> Stage Name : ' . $a1m_tuple["stage_name"] .
        '<br> First Name : ' . $a1m_tuple["first_name"] .
        '<br> Middle Name : ' . $a1m_tuple["middle_name"] .
        '<br> Last Name : ' . $a1m_tuple["last_name"] .
        '<br> Gender : ' . $a1m_tuple["gender"] .
        '<br> Image name :  ' . $a1m_tuple["image_name"];
    } //end if
    else {
      echo "0 results";
    } //end else

    $sql_A1m_result->close();
    ?>
  </div>
</div>



<!-- ================ [B] People Aggregation (table: movie_people) ======================
[B] PEOPLE aggegation
(display this as a table or name value pairs;
Do whatever is easier for you)

No of Movies as <role1>: 
No of Movies as <role2>: 
No of Movies as <role3>: 
No of Songs as Composer: 
No of Songs as Lyricist:
No of Songs as Music Director:


TODO: Copy the code snippet from A, change the code to reflect Extended data
========================================================================= -->
<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;">[B] People -> People Aggregation</h3>

    
    <table class="display" id="movie_media_table" style="width:100%">
      <div class="table responsive">

        <thead>
          <tr>
            <th> No. Of Movies as Director</th>
            <th> No. Of Movies as Actor</th>
            <th> No. of Movies as Actress</th>
            <th> No. of Movies as Producer</th>
            <th> No. Of Songs as Composer </th>
            <th> No. Of Songs as Lyricist </th>
            <th> No. Of Songs as Music Director</th>
          </tr>
        </thead>

        <?php

        // query string for the Query C
        $sql_B = "SELECT movie_people.role Role, song_people.role,
                COUNT(DISTINCT movie_people.role = movie_people.role && movie_people.role = 'Director%') Count,
                COUNT(DISTINCT movie_people.role = movie_people.role && movie_people.role = 'Actor%') Count2,
                COUNT(DISTINCT movie_people.role = movie_people.role && movie_people.role = 'Actress%') Count3,
                COUNT(DISTINCT movie_people.role = movie_people.role && movie_people.role = 'PRODUCER%') Count4,
                COUNT(DISTINCT song_people.role = song_people.role && song_people.role = 'Composer%') Count5,
                COUNT(DISTINCT song_people.role = song_people.role && song_people.role = 'Lyricist%') Count6,
                COUNT(DISTINCT song_people.role = song_people.role && song_people.role = 'Music Director%') Count7
                FROM movie_people 
                INNER JOIN movies On movies.movie_id = movie_people.movie_id 
                INNER JOIN people on people.people_id = movie_people.people_id
                INNER JOIN song_people on song_people.people_id = movie_people.people_id";

        if (!$sql_B_result = $db->query($sql_B)) {
          die('There was an error running query[' . $db->error . ']');
        }

        // this is 1 to many relationship
        // So, many tuples may be returned
        // We will display those in a table in a while loop
        if ($sql_B_result->num_rows > 0) {
          // output data of each row
          while ($b_tuple = $sql_B_result->fetch_assoc()) {
            echo '<tr>
                      <td>' . $b_tuple["Count"] . '</td>
                      <td>' . $b_tuple["Count2"] . '</td>
                      <td>' . $b_tuple["Count3"] . '</td>
                      <td>' . $b_tuple["Count4"] . ' </span> </td>
                      <td>' . $b_tuple["Count5"] . ' </span> </td>
                      <td>' . $b_tuple["Count6"] . ' </span> </td>
                      <td>' . $b_tuple["Count7"] . ' </span> </td>


                  </tr>';
          } //end while

        } //end second if 

        $sql_B_result->close();
        ?>

    </table>
  </div>
</div>

<!-- ================ [C] People Movies (table: movie_people) ======================
(display this as a table)

movie_id, native_name, english_name, year_made, role, screen_name
========================================================================= -->

<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;">[C] PEOPLE -> SONGS</h3>


    <table class="display" id="movie_media_table" style="width:100%">
      <div class="table responsive">

        <thead>
          <tr>
            <th> Movie ID </th>
            <th> Native Name </th>
            <th> English Name</th>
            <th> Year </th>
            <th> Role </th>
            <th> Screen Name </th>

          </tr>
        </thead>

        <?php

        // query string for the Query C
        $sql_C1 = "SELECT mp.movie_id, m.native_name, m.english_name, m.year_made, mp.role, p.stage_name
                  FROM movie_people mp
                  INNER JOIN movies m ON (m.movie_id = mp.movie_id) 
                  INNER JOIN people p ON (p.people_id = mp.people_id)";

        if (!$sql_C1_result = $db->query($sql_C1)) {
          die('There was an error running query[' . $db->error . ']');
        }

        // this is 1 to many relationship
        // So, many tuples may be returned
        // We will display those in a table in a while loop
        if ($sql_C1_result->num_rows > 0) {
          // output data of each row
          while ($c1_tuple = $sql_C1_result->fetch_assoc()) {
            echo '<tr>
                      <td>' . $c1_tuple["movie_id"] . '</td>
                      <td>' . $c1_tuple["native_name"] . '</td>
                      <td>' . $c1_tuple["english_name"] . '</td>
                      <td>' . $c1_tuple["year_made"] . ' </span> </td>
                      <td>' . $c1_tuple["role"] . ' </span> </td>
                      <td>' . $c1_tuple["stage_name"] . ' </span> </td>

                  </tr>';
          } //end while

        } //end second if 

        $sql_C1_result->close();
        ?>

    </table>
  </div>
</div>


<!-- ================ [D] People Songs (table: songs) ======================
[D] PEOPLE - Songs

Display Type: Show this as a table

song_id
title 
lyrics (show first 30 characters)
role (from song_people)
========================================================================= -->

<div class="right-content">
  <div class="container">
    <h3 style="color: #01B0F1;">[D] PEOPLE -> SONGS</h3>


    <table class="display" id="movie_media_table" style="width:100%">
      <div class="table responsive">

        <thead>
          <tr>
            <th> Song ID </th>
            <th> Title </th>
            <th> Lyrics</th>
            <th> Role </th>
          </tr>
        </thead>

        <?php

        // query string for the Query A.3
        $sql_D1 = "SELECT songs.song_id, songs.title, songs.lyrics, song_people.role 
                  FROM songs
                  INNER JOIN song_people ON song_people.song_id = songs.song_id";

        if (!$sql_D1_result = $db->query($sql_D1)) {
          die('There was an error running query[' . $db->error . ']');
        }

        // this is 1 to many relationship
        // So, many tuples may be returned
        // We will display those in a table in a while loop
        if ($sql_D1_result->num_rows > 0) {
          // output data of each row
          while ($d1_tuple = $sql_D1_result->fetch_assoc()) {
            echo '<tr>
                      <td>' . $d1_tuple["song_id"] . '</td>
                      <td>' . $d1_tuple["title"] . '</td>
                      <td>' . $d1_tuple["lyrics"] . '</td>
                      <td>' . $d1_tuple["role"] . ' </span> </td>
                  </tr>';
          } //end while

        } //end second if 

        $sql_D1_result->close();
        ?>

    </table>
  </div>
</div>




<!-- ================== JQuery Data Table script ================================= -->

<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    $('#info').DataTable({
      dom: 'lfrtBip',
      buttons: [
        'copy', 'excel', 'csv', 'pdf'
      ]
    });

    $('#info thead tr').clone(true).appendTo('#info thead');
    $('#info thead tr:eq(1) th').each(function(i) {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function() {
        if (table.column(i).search() !== this.value) {
          table
            .column(i)
            .search(this.value)
            .draw();
        }
      });
    });

    var table = $('#info').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      retrieve: true
    });

  });
</script>



<style>
  tfoot {
    display: table-header-group;
  }
</style>

<?php include("./footer.php"); ?>
