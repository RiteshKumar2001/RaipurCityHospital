<?php
$insert = false;
$update = false;
$delete = false;

$servername="localhost";
$username="root";
$password="";
$database= "vacci";
$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `status` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  if (isset( $_POST['snoEdit'])){
    $sno = $_POST["snoEdit"];
    $date = $_POST["dateEdit"];
    $newVaccinations = $_POST["newVaccinationsEdit"];
    $newCases = $_POST["newCasesEdit"];
    $newRecoveries = $_POST["newRecoveriesEdit"];
    $newDeaths = $_POST["newDeathsEdit"];
    
    
  $sql ="UPDATE `status` SET `date` = '$date', `newVaccinations` = '$newVaccinations', `newCases` = '$newCases', `newRecoveries` = '$newRecoveries', `newDeaths` = '$newDeaths',  WHERE `status`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);

  if($result){
    $update = true;
  }
  else{
    echo "error due to ---->";
    mysqli_error($conn);
  }
}
    else{
    $date = $_POST["date"];
    $newVaccinations = $_POST["newVaccinations"];
    $newCases = $_POST["newCases"];
    $newRecoveries = $_POST["newRecoveries"];
    $newDeaths = $_POST["newDeaths"];
   
    
  $sql ="INSERT INTO status ( date, newVaccinations, newCases, newRecoveries, newDeaths) values ('$date', '$newVaccinations', '$newCases', '$newRecoveries','$newDeaths')";
  $result = mysqli_query($conn, $sql);
  if($result){
    $insert = true;
  }
  else{
    echo "error due to ---->";
    mysqli_error($conn);
  }
}
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
 
    <title>Vaccination Details</title>

   
  </head>
  <body>
  <?php require '_nav.php' ?>

<?php
if($insert){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your vaccination slot has been booked successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>

<?php
if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your vaccination slot has been deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>

<?php
if($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your vaccination slot has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>


<div class="container my-5">
        <h2>Enter Your Details</h2>
        <form action="/gfg/status.php" method="post">
            <div class="form-group mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date">
              </div>
              <div class="mb-3">
                <label for="newVaccinations" class="form-label">New Vaccinations</label>
                <input type="text" class="form-control" id="newVaccinations" name="newVaccinations">
              </div>
            <div class="mb-3">
              <label for="newCases" class="form-label">New Cases</label>
              <input type="text" class="form-control" id="newCases" name="newCases" aria-describedby="emailHelp">
            </div>
              <div class="mb-3">
                <label for="newRecoveries" class="form-label">New Recoveries</label>
                <input type="text" class="form-control" id="newRecoveries" name="newRecoveries" aria-describedby="emailHelp">
              
              </div>
              <div class="mb-3">
                <label for="newDeaths" class="form-label">New Deaths</label>
                <input type="text" class="form-control" id="newDeaths" name="newDeaths">
              </div>
              
              <button type="submit" class="btn btn-primary">Update Details </button>
          </form>
    </div>


    
<br><br><br><br><br><br>
<div class="container">



<table class="table" id="tablevacc">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Date</th>
      <th scope="col">New Vaccinations</th>
      <th scope="col">New Cases</th>
      <th scope="col">New Recoveries</th>
      <th scope="col">New Deaths</th>
      
      <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>

  <?php
$sql ="select * from status";
$result = mysqli_query($conn, $sql);
$sno = 0;
while($row = mysqli_fetch_assoc($result)){
  $sno = $sno + 1;
echo " <tr>
<th scope='row'>". $sno . "</th>
<td>". $row['date'] . "</td>
<td>". $row['newVaccinations'] . "</td>
<td>". $row['newCases'] . "</td>
<td>". $row['newRecoveries'] . "</td>
<td>". $row['newDeaths'] . "</td>

<td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>   
<button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td>
</tr>";

} 
  ?>
   
  </tbody> 
</table>
</div>





<hr>

</div><br><br><br><br>
<?php require 'foot.php' ?>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
         
        </button>
      </div>
      <div class="modal-body">
      <form action="/gfg/status.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="dateEdit" name="dateEdit">
              </div>
              <div class="mb-3">
                <label for="newVaccinations" class="form-label">New Vaccinations</label>
                <input type="text" class="form-control" id="newVaccinationsEdit" name="newVaccinationsEdit">
              </div>
            <div class="mb-3">
              <label for="newCases" class="form-label">New Cases</label>
              <input type="email" class="form-control" id="newCasesEdit" name="newCasesEdit" aria-describedby="emailHelp">
    
              <div class="mb-3">
                <label for="newRecoveries" class="form-label">New Recoveries</label>
                <textarea class="form-control" id="newRecoveriesEdit" name="newRecoveriesEdit" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="newDeaths" class="form-label">New Deaths</label>
                <input type="text" class="form-control" id="newDeathsEdit" name="newDeathsEdit">
              </div>
              
              <button type="submit" class="btn btn-primary">Update  Details</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

   
  <script>
 
    $(document).ready(function () {
      $('#tablevacc').DataTable();

    });
  </script>
   <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ", );
        tr = e.target.parentNode.parentNode;
        date = tr.getElementsByTagName("td")[0].innerText;
        newVaccinations = tr.getElementsByTagName("td")[1].innerText;
        newCases = tr.getElementsByTagName("td")[2].innerText;
        newRecoveries = tr.getElementsByTagName("td")[3].innerText;
        newDeaths = tr.getElementsByTagName("td")[4].innerText;
        
        console.log(date, newVaccinations, newCases, newRecoveries, newDeaths);
        dateEdit.value =date;
        newVaccinationsEdit.value =newVaccinations;
        newCasesEdit.value =newCases;
        newRecoveriesEdit.value =newRecoveries;
        newDeathsEdit.value =newDeaths;
        
        snoEdit.value= e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');

  })
  })

  deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/gfg/status.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
  
  </body>
</html>