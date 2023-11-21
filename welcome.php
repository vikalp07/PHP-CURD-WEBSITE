<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
  header("location: login.php");
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Welcome - <?php $_SESSION['username']?></title>
  </head>
  <body>
    <?php require 'nav.php' ?>
    
    <div class="container my-4">
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username']?></h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to logout you can <a href="/vikalp/Login/logout.php">use this link</a></p>
</div>
    </div>
    <div class="curd">
    <?php
$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "note";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("connection was not successfully because of this error" . mysqli_connect_error());
} else {
    echo "<br>";
}
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `notes`.`S No.` = $sno";
    $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["snoEdit"])) {
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];

        $sql = "UPDATE `notes` SET `title` = '$title' , `Description` = '$description' WHERE `notes`.`S No.`='$sno'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // echo " Recoard has been created sccessfully";
            $update = true;
        } else {
            echo "table was not created successfully because of " . mysqli_error($conn);
        }
    } else {

        $title = $_POST["title"];
        $description = $_POST["description"];

        $sql = "INSERT INTO `notes` (`title`, `Description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // echo " Recoard has been created sccessfully";
            $insert = true;
        } else {
            echo "table was not created successfully because of " . mysqli_error($conn);
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <title>iNote</title>
</head>

<body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/vikalp/Login/welcome.php" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="title" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp" placeholder="Title">

                        </div>
                        <div class="form-group">
                            <label for="desc">New Description</label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3" placeholder="Description"></textarea>
                        </div>


                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="/vikalp/project/php.img" alt="error" height="30px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                <li class="nav-item active">
                    <a class="nav-link" href="#">About <span class="sr-only">(current)</span></a>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Contact <span class="sr-only">(current)</span></a>



            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav> -->

    <?php
    if ($insert) {
        echo "<div class='alert alert-Success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Data inserted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    // else{
    //     echo "data entry has been failed because of this error" . mysqli_error($conn);
    //   }
    // else{
    //     echo "Data not inserted successfully";
    // }
    ?>

    <?php
    if ($update) {
        echo "<div class='alert alert-Success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Record has been updated successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    // else{
    //     echo "data entry has been failed because of this error" . mysqli_error($conn);
    //   }
    // else{
    //     echo "Data not inserted successfully";
    // }
    ?>

    <?php
    if ($delete) {
        echo "<div class='alert alert-Success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Record has been deleted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    // else{
    //     echo "data entry has been failed because of this error" . mysqli_error($conn);
    //   }
    // else{
    //     echo "Data not inserted successfully";
    // }
    ?>
    <div class="container my-3">
        <h1>Add Notes!</h1>
        <form action="/vikalp/Login/welcome.php" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="title" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Title">

            </div>
            <div class="form-group">
                <label for="desc">New Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Add note</button>
        </form>
        <hr>

        <table class="table my-3" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";
                $sno = 0;
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo var_dump($row);
                    $sno = $sno + 1;
                    echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td >" . $row['Title'] . "</td>
            <td >" . $row['Description'] . "</td>
            <td ><button class='edit btn btn-sm btn-primary' id = " . $row['S No.'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id = d" . $row['S No.'] . ">Delete</button> </td>
        </tr>";
                }
                ?>



            </tbody>
        </table>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <!-- <script
        src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous">
    </script> -->
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText
                description = tr.getElementsByTagName("td")[1].innerText
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');



            })

        })


        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ", );
                sno = e.target.id.substr(1, );
                if (confirm("Are you sure you wnat to delete this note !")) {
                    console.log("Yes")
                    window.location = `/vikalp/Login/welcome.php?delete= ${sno}`;
                } else {
                    console.log("No");
                }



            })

        })
    </script>
</body>

</html>
    </div>
  
    
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    
  </body>
</html>