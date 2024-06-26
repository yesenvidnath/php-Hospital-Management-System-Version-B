<?php
  include('template-parts/header.php');
?>

<div class="container-fluid background-main-login">

    <div class="row">

        <div class="col-md-6">

            <form id="login-form" action="login.php" method="POST">

                <!-- Display the error based on the error -->
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger"><?= $_GET['error'] ?> 😒</div>
                <?php } ?>

                <div class="form-group">
                    <label for="utype">User Type</label>
                    <select id="utype" name="utype" class="form-control">
                        <option value="">Select User Type</option>
                        <option value="staff">Staff</option>
                        <option value="patient">Patient</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="uname">Username</label>
                    <input id="uname" type="text" placeholder="Enter Username" name="uname" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="psw">Password</label>
                    <input id="password" type="password" placeholder="Enter Password" name="psw" required class="form-control">
                </div>
                <br>
                <div class="row">
                        
                    <div class="col-6">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Login</button> 
                            <label class="ml-2">
                                <input type="checkbox" checked="checked" name="remember"> Remember me
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="btn btn-primary">Back to Home </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-md-6">
            <div class="img-left-side-log"></div>
        </div>
    </div>
</div>


<style>
    nav{
        display: none;
    }

    footer{
        display: none;
    }
</style>

<?php
  include('template-parts/footer.php');
?>