<?php 
        //include constant.php
         include('../config/constants.php');
        // get the ID of customer to be deleted
        $id = $_GET['id'];
        //create sql query to delete customer
        $sql = "DELETE FROM customer WHERE custID=$id";
        //redirect to manage customer page with messsage
        $res = mysqli_query($conn,$sql);
        //check whether the query is executed succefully or not
        if($res==true){
            //Query executed successfully and customer deleted
            // echo "Customer Deleted";
            //Create Session variable to display message
            $_SESSION['delete']= "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Customer Deleted Succeussfully</div>";
            header('location:'.SITEURL.'Staff_Page/manageCustomer.php');
        }
        else{
            // echo "Failed to Delete customer";
            $_SESSION['delete']= "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Failed to delete customer. Try again Later</div>";
            
            header('location:'.SITEURL.'Staff_Page/manageCustomer.php');
        }

    //redirect to manage customer page with messsage
?>