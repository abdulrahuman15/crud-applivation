<?php
session_start();

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

    <div class="container formfirst">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <img src="https://avmc.edu.in/wp-content/uploads/2021/12/avmc-logo-01.png" alt=""
                            class="imgsize">


                    </div>
                    <div class="card-body">

                        <form action="insert.php" method="post">
                            <?php  
                    if(isset($_SESSION['success'])){
                        echo '<div class="text-center" style="color:green; background-color:white;"> <h6> '. $_SESSION['success'].' </h6> </div>';
                        unset($_SESSION['success']);
                    }
                    if (isset($_SESSION['failure'])) {
    
                        echo '<div class="text-center" style="color:red; 
                        background-color:white;"> <h6> '. $_SESSION['failure'].' </h6> </div>';
                        unset($_SESSION['failure']);
    
                    }
                    
                    ?>
                            <label for="" id="fontstyle">First Name</label>
                            <input type="text" class="form-control" name="first_name" required><br>

                            <label for="" id="fontstyle">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required><br>

                            <label for="" id="fontstyle">Email</label>
                            <input type="email" class="form-control" name="email" required><br>

                            <label for="" id="fontstyle">Mobile Number</label>
                            <input type="text" class="form-control" name="number" pattern="[1-9]{1}[0-9]{9}"
                                required><br>
                                <!-- select option -->
                                <!-- <label for="" id="fontstyle">select menu</label>
                                <select class="form-select" aria-label="Default select example" name="usertype">
                                  <option selected>Open this select menu</option>
                                       <option value="user">user</option>
                                       <option value="admin">admin</option>
                                       
                                    </select> -->


                            <div class="text-center my-3">
                                <input type="submit" value="submit" name="submit" class="btn btn-primary">
                                
                        </form>
                        <a href="table.php">
                            <button type="button" class="btn btn-danger">GO to Table</button>
                        </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>






</body>

</html>