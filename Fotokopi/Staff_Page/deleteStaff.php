<?php 
        //include constant.php
         include('../config/constants.php');
        // get the ID of staff to be deleted
        $id = $_GET['id'];
        //create sql query to delete staff
        $sql = "DELETE FROM staff WHERE staffID=$id";
        //redirect to manage staff page with messsage
        $res = mysqli_query($conn,$sql);
        //check whether the query is executed succefully or not
        if($res==true){
                //Query executed successfully and admin deleted
                // echo "Admin Deleted";
                //Create Session variable to display message
                $_SESSION['delete']= "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Staff Deleted Succeussfully</div>";
                header('location:'.SITEURL.'Staff_Page/manageStaff.php');
            }
            else{
                // echo "Failed to Delete admin";
                $_SESSION['delete']= "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Failed to delete staff. Try again Later</div>";
                
                header('location:'.SITEURL.'Staff_Page/manageStaff.php');
            }

    //redirect to manage staff page with messsage
?>