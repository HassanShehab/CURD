<?php 
$host = "localhost";
$user = "root";
$password = "";
$dbName ="crud";
$conn = mysqli_connect($host,$user,$password,$dbName);

#============================ *CRUD OPERATION ===============================

#============================ *CREAT ===================================

if(isset($_POST['send'])){
    $n = $_POST['username'];
    $s = $_POST['salary'];
    $insert = "INSERT INTO `users` VALUES (NULL , '$n' , $s)";
    mysqli_query($conn,$insert);
}

#============================ *READ ======================================

$select = "SELECT * FROM `users`";
$i = mysqli_query($conn,$select);

#============================ *DELETE =====================================

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM `users` WHERE ID = $id";
    mysqli_query($conn,$delete);
    header("location:index.php");
}

#============================ *UPDATE =====================================

$name = "";
$salary = "";
$any = true ;
if(isset($_GET['edit'])){
    $any = false ;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `users` WHERE ID = $id";
    $ss = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($ss);
    $name = $row['Name'];
    $salary = $row['salary'];

    if(isset($_POST['update'])){
        $n = $_POST['username'];
        $s = $_POST['salary'];
        $update = "UPDATE `users` SET Name = '$n' , salary = $s where ID = $id";
        mysqli_query($conn,$update);
        header("location:index.php");
    }
}

?>

<!-- ========== *HTML CODE ========== -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- ==== BOOTSTRAPE LINK ==== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="./main.css">
</head>
<body>
    <h1 class="text-center text-info display-2"> CURD Users </h1>
    <div class="container text-center">
        <div class="card">
            <div class="card-body">
                <form method ="POST">
                    <div class="form-group">
                        <label for="">User Name</label>
                        <input value="<?php echo $name ?>" name="username" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">User salary</label>
                        <input value="<?php echo $salary ?>" name="salary" type="text" class="form-control">
                    </div>
                    <?php if($any) :?>
                    <button name="send" class="btn btn-info"> Send Data </button>
                    <?php else :?>
                    <button name="update" class="btn btn-primary"> Update </button>
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>

    <div class="container text-center mt-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark col-12">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                    <?php foreach($i as $data) {?>
                    <tr>
                        <th> <?php echo $data['ID'] ?> </th>
                        <th> <?php echo $data['Name'] ?> </th>
                        <th> <?php echo $data['salary'] ?> </th>
                        <th> <a href="index.php?delete=<?php echo $data['ID'] ?>" class="btn btn-danger"> <i class="fas fa-trash-alt" style="font-size: 25px;"></i> </a> 
                        </th>
                        <th> <a href="index.php?edit=<?php echo $data['ID'] ?>" class="btn btn-info"> 
                        <i class="fas fa-edit" style="font-size: 25px;"></i> </a> 
                        </th>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>

    <!-- ==== FONT AWESOME LINK ==== -->
    <script src="https://kit.fontawesome.com/f8905b4eb0.js" crossorigin="anonymous"></script>
</body>
</html> 