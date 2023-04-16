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
  $sql = "DELETE FROM `patient` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  if (isset( $_POST['snoEdit'])){
    $sno = $_POST["snoEdit"];
    $name = $_POST["nameEdit"];
    $email = $_POST["emailEdit"];
    $address = $_POST["addressEdit"];
    $consultingFor = $_POST["consultingForEdit"];
    $appointment = $_POST["appointmentEdit"];
    
  $sql ="UPDATE `patient` SET `name` = '$name',  `email` = '$email', `consultingFor` = '$consultingFor', `appointment` = '$appointment' WHERE `patient`.`sno` = $sno";
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
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $consultingFor = $_POST["consultingFor"];
    $appointment = $_POST["appointment"];
    
  $sql ="INSERT INTO patient ( name, email, consultingFor, appointment) values ('$name', '$email', '$consultingFor','$appointment')";
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
  <strong>Success!</strong> Your e-Clinic appointment has been booked successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>

<?php
if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Appointment slot has been deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>

<?php
if($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Appointment slot has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>


    <div class="container my-5">
        <h2>Enter Your Details</h2>
        <form action="/gfg/viewappointment.php" method="post">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    
              <div class="mb-3">
                <label for="address" class="form-label">Consulting For</label>
                <textarea class="form-control" id="consultingFor" name="consultingFor" rows="3"></textarea>
              </div>
              
              <div class="mb-3">
                <label for="type" class="form-label">Appointment</label>
                <input type="datetime-local" class="form-control" id="appointment" name="appointment">
              </div>
              <button type="submit" class="btn btn-primary">Book Appointment</button>
          </form>
    </div>
<br>
<div class="container">
</div>
<hr>
</div><br>
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
      <form action="/gfg/viewappointment.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="nameEdit" name="nameEdit">
              </div>
              
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="emailEdit" name="emailEdit" aria-describedby="emailHelp">
    
              <div class="mb-3">
                <label for="consultingFor" class="form-label">Consulting For</label>
                <textarea class="form-control" id="consultingForEdit" name="consultingForEdit" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="appointment" class="form-label">Appointment</label>
                <input type="text" class="form-control" id="appointmentEdit" name="appointmentEdit">
              </div>
              
              <button type="submit" class="btn btn-primary">Update Slot Details</button>
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
      $('#tablepatient').DataTable();

    });
  </script>
   <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ", );
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        
        email = tr.getElementsByTagName("td")[1].innerText;
        consultingFor = tr.getElementsByTagName("td")[2].innerText;
        appointment = tr.getElementsByTagName("td")[3].innerText;
        
        console.log(name, email, consultingFor, appointment);
        nameEdit.value =name;
        
        emailEdit.value =email;
        consultingForEdit.value =consultingFor;
        appointmentEdit.value =appointment;
        
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
          window.location = `/gfg/viewappointment.php?delete=${sno}`;
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