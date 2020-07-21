<?php

  $nav_selected = "PEOPLE"; 
  $left_buttons = "YES"; 
  $left_selected = "PEOPLE"; 

  include("./nav.php");
  global $db;

  ?>

<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">People -> People List</h3>

    <button><a class="btn btn-sm" href="create_people.php">Create a Person</a></button>
       
<br>

        <table id="info" cellpadding="0" cellspacing="0" border="0"
            class="datatable table table-striped table-bordered datatable-style table-hover"
            width="100%" style="width: 100px;">
              <thead>
                <tr id="table-first-row">
                        <th>id</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name </th>
                        <th>Stage Name </th>
                        <th>Gender </th>
                        <th>Image </th>

                        <th> Actions </th>
                </tr>
              </thead>

              <tbody>

              <?php

$sql = "SELECT * from people ORDER BY people_id ASC;";
$result = $db->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["people_id"].'</td>
                                <td>'.$row["first_name"].' </span> </td>
                                <td>'.$row["middle_name"].'</td>
                                <td>'.$row["last_name"].'</td>
                                <td>'.$row["stage_name"].'</td>
                                <td>'.$row["gender"].'</td>
                                <td>'.$row["image_name"].'</td>
                                <td><a class="btn btn-info btn-sm" href="people_info.php?people_id='.$row["people_id"].'">Display</a>
                                    <a class="btn btn-warning btn-sm" href="modify_people.php?people_id='.$row["people_id"].'">Modify</a>
                                    <a class="btn btn-danger btn-sm" href="delete_people.php?people_id='.$row["people_id"].'">Delete</a></td>          
                            </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else

                 $result->close();
                ?>

              </tbody>
        </table>


        <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#info').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#info thead tr').clone(true).appendTo( '#info thead' );
        $('#info thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#info').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>

        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
