<div class="outerbox">
    <div class="container-fluid dark-container bg-dark">
        <form  action="" method="post">
            <fieldset>
                <img src="../pic/Logo.png" alt="Company Logo" width="200px" class="d-block w-50 mx-auto">
                <legend class="text-center">Add New <?php echo $user ?></legend>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="fullname" placeholder="Enter full name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" name="phoneNumber" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                </div>
            </fieldset>
            <div class="text-center mt-4">
                <button type="submit" name="submit" class="btn btn-warning">Register</button><br><br>
            </div>
        </form>
    </div>
</div>
<br>