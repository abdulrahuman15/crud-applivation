<?php
session_start();

$con = mysqli_connect('localhost','root','','crud');


// ******delete Query************
if(isset($_POST['delete_student'])){
    $student_id=$_POST['delete_student'];
    $query="DELETE FROM users WHERE id='$student_id'";
    $query_run =mysqli_query($con,$query);
    if($query_run){
        
        $_SESSION['success']="Deleted SUCCESFULLY";
        header('location:table.php');
    }
    else{

        $_SESSION['failure']="NOT Deleted ";
        header('location:table.php');
    }

}




// **** EDIT SECTION ****
if(isset($_POST['Update-student'])){

    // **** student id declearion ****
    $student_id=$_POST['student_id'];


    $firstname=$_POST['first_name'];
    $lastname=$_POST['last_name'];
    $email=$_POST['email'];
    $mobilenumber=$_POST['number'];

    $query="UPDATE  users SET  first_name='$firstname',last_name='$lastname',email='$email',number='$mobilenumber' WHERE id='$student_id' ";
    $query_run =mysqli_query($con,$query);
    if($query_run){

        $_SESSION['success']="UPDATED IN DB SUCCESFULLY";
        header('location:table.php');
    }
    else{
        $_SESSION['failure']="NOT UPDATE ";
        header('location:table.php');
    }

}

// INSET qUERY

if(isset($_POST['submit'])){

    $firstname=$_POST['first_name'];
    $lastname=$_POST['last_name'];
    $email=$_POST['email'];
    $mobilenumber=$_POST['number'];

    

    $query="INSERT INTO users (first_name,last_name,email,number) VALUES ('$firstname','$lastname','$email','$mobilenumber')";

    $result = mysqli_query($con,$query);

    if($result){
       
        $_SESSION['success']="data insert into database";
        header('location:table.php');
    }
    else{
        $_SESSION['failure']="data  not insert into database";
        header('location:index.php');
    }
}

?>