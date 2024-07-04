<?php
session_start();
$con = mysqli_connect('localhost','root','','crud');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- link css -->
    <link rel="stylesheet" href="style.css" class="css">
</head>

<body>

    <div class="container ">
        <div class="card bg-primary">
            <h1 class="text-center">Edit user Details</h1>

            <!-- edit function creation -->
            <?php
            if (isset($_GET['id'])) {
                $student_id = mysqli_real_escape_string($con, $_GET['id']);

                $query = "SELECT * FROM users WHERE id='$student_id'";

                $query_run = mysqli_query($con, $query);
                    if(mysqli_num_rows($query_run)>0){
                        $student=mysqli_fetch_array($query_run);
                        ?>


            <div class="formdesign">
                <form action="insert.php" method="post">

                    <!-- **** student id declearion **** -->
                    <input type="hidden" name="student_id" value="<?=  $student['id'];  ?>">


                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="<?=  $student['first_name'];  ?>"
                        required><br>

                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="<?=  $student['last_name'];  ?>"
                        required><br>

                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required
                        value="<?=  $student['email'];  ?>"><br>

                    <label for="">Mobile Number</label>
                    <input type="number" class="form-control" name="number" value="<?=  $student['number'];  ?>"><br>
                    <div class="text-center">
                        <input type="submit" value="Update-student" name="Update-student" class="btn btn-light">
                </form>
                <a href="table.php">
                    <button type="button" class="btn btn-danger">GO to Table</button>
                </a>

                <?php

                    }
                    else{
                        echo "not data in db";
                    }
                }
                
                ?>
            </div>



        </div>


    </div>
    </div>
    </div>


</body>

</html>