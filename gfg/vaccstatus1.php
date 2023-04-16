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
  $sql = "DELETE FROM `vacc` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  if (isset( $_POST['snoEdit'])){
    $sno = $_POST["snoEdit"];
    $name = $_POST["nameEdit"];
    $adhaar = $_POST["adhaarEdit"];
    $email = $_POST["emailEdit"];
    $address = $_POST["addressEdit"];
    $dose = $_POST["doseEdit"];
    $type = $_POST["typeEdit"];
    
  $sql ="UPDATE `vacc` SET `name` = '$name', `adhaar` = '$adhaar', `email` = '$email', `address` = '$address', `dose` = '$dose', `type` = '$type' WHERE `vacc`.`sno` = $sno";
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
    $adhaar = $_POST["adhaar"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $dose = $_POST["dose"];
    $type = $_POST["type"];
    
  $sql ="INSERT INTO vacc ( name, adhaar, email, address, dose, type) values ('$name', '$adhaar', '$email', '$address','$dose', '$type')";
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
<br><br><br>
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


    

<div class="container">



<table class="table" id="tablevacc">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Name</th>
      <th scope="col">Adhaar</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Dose</th>
      <th scope="col">Type</th>
      

    </tr>
  </thead>
  <tbody>

  <?php
$sql ="select * from vacc";
$result = mysqli_query($conn, $sql);
$sno = 0;
while($row = mysqli_fetch_assoc($result)){
  $sno = $sno + 1;
echo " <tr>
<th scope='row'>". $sno . "</th>
<td>". $row['name'] . "</td>
<td>". $row['adhaar'] . "</td>
<td>". $row['email'] . "</td>
<td>". $row['address'] . "</td>
<td>". $row['dose'] . "</td>
<td>". $row['type'] . "</td>

</tr>";

} 
  ?>
   
  </tbody> 
</table>
</div>





<hr>

</div><br><br><br>
<?php require 'foot.php' ?>
    

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
        name = tr.getElementsByTagName("td")[0].innerText;
        adhaar = tr.getElementsByTagName("td")[1].innerText;
        email = tr.getElementsByTagName("td")[2].innerText;
        address = tr.getElementsByTagName("td")[3].innerText;
        dose = tr.getElementsByTagName("td")[4].innerText;
        type = tr.getElementsByTagName("td")[5].innerText;
        console.log(name, adhaar, email, address, dose, type);
        nameEdit.value =name;
        adhaarEdit.value =adhaar;
        emailEdit.value =email;
        addressEdit.value =address;
        doseEdit.value =dose;
        typeEdit.value =type;
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
          window.location = `/crud/vaccstatus1.php?delete=${sno}`;
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