<?php include('partials/menu.php');?>

    <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
    ?>

    <div class="outerbox">
        <div class="container-fluid dark-container bg-dark">
            <form  action="" method="post">
                <fieldset>
                    <img src="../pic/Logo.png" alt="Company Logo" width="200px" class="d-block w-50 mx-auto">
                    <legend class="text-center">Change Password</legend>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Current Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter current password" name="current_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter New password" name="new_password" required>
                    </div>

                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm New Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter New password" name="confirm_password" required>
                    </div>
                </fieldset>
                <div class="text-center mt-4">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <button type="submit" name="submit" class="btn btn-warning">Change Password</button><br><br>
                </div>
            </form>
        </div>
    </div>
    <br>
<?php include('partials/footer.php');?>

<?php
    if(isset($_POST['submit'])){
        // echo "clicked";

        //remove md5 if not working
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM customer WHERE custID=$id AND custPassword = '$current_password'";
        $res = mysqli_query($conn,$sql);

        if($res==true){
            //check if data available
            $count=mysqli_num_rows($res);
            // echo $count;
            if($count == 1){
                //user exists and password can be changed
                // echo "user found";
                // echo "<br>";
                // echo md5($current_password);
                // echo "<br>";
                // echo $new_password;
                // echo "<br>";
                // echo $confirm_password;
                // echo "<br>";
                if($new_password==$confirm_password){
                    //update password
                    $sql2 = "UPDATE customer SET custPassword='$new_password' WHERE custID=$id";

                    $res2 = mysqli_query($conn,$sql2);
                    
                    if ($res2 == true) {
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                        header('location:' . SITEURL . 'Staff_Page/manageCustomer.php');
                    } else {
                        $_SESSION['change-pwd'] = "<div class='error'>Password change failed</div>";
                        header('location:' . SITEURL . 'Staff_Page/manageCustomer.php');
                    }                    
                }
                else{
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Not Match</div>";
                    //redirect
                    header('location:'.SITEURL.'Staff_Page/manageCustomer.php');
                }
                
            }
            else{
                // echo "user not found";
                // echo "<br>";
                // echo md5($current_password);
                // echo "<br>";
                // echo $new_password;
                // echo "<br>";
                // echo $confirm_password;
                // echo "<br>";
                // //user doesn't exist
                // $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                // //redirect
                // header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }
    }
?>