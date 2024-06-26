<?php
include('connect.php');

$action = '';
$staff_id = '';
$first_name = '';
$last_name = '';
$job_title = '';
$phone_number = '';
$email = '';
$availability = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $staff_id = $_POST['staff_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $job_title = $_POST['job_title'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $availability = $_POST['availability'];

    switch ($action) {

        case 'update':
            $sql = "UPDATE staff SET first_name='$first_name', last_name='$last_name', job_title='$job_title', phone_number='$phone_number', email='$email', availability='$availability' WHERE staff_id='$staff_id'";
            $conn->query($sql);
            break;

        case 'search':
            $sql = "SELECT * FROM staff WHERE staff_id='$staff_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $job_title = $row['job_title'];
                $phone_number = $row['phone_number'];
                $email = $row['email'];
                $availability = $row['availability'];
            } else {
                echo "<div class='alert alert-warning'>No staff found with the given ID</div>";
            }
        break;
    }
}
?>

<div class="container-fluid">
    <div class="row main-section">

        <!-- Left Panel -->
        <div class="col-md-2 side-panel-l text-center">
            <?php include('template-parts/dashbords/side-panel.php');?>
        </div>

        <!-- Right Panel -->
        <div class="col-md-10 side-panel-r">

            <div class="container-fluid navigation-container">

                <?php include('template-parts/dashbords/navigation.php');?>

            </div>
            <br>
            <div class="container-fluid">

                <section class="title-of-dash">
                    <h2>Manage My Profile</h2>
                </section>


                <section style="margin-top:-30px">

                    <div class="row">

                        <div class="col-md-5">

                            <form method="POST">

                                <div class="form-group">
                                    <label for="staff_id">Staff ID:</label>
                                    <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>" required>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="job_title">Job Title:</label>
                                            <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo $job_title; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="availability">availability:</label>
                                            <input type="text" class="form-control" id="availability" name="availability" value="<?php echo $availability; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="job_title">Job Title:</label>
                                    <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo $job_title; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                </div>

                                <section class="button-section">
                                    <input type="submit" class="btn btn-info" name="action" value="search">
                                    <input type="submit" class="btn btn-success" name="action" value="update">
                                    <input type="button" class="btn btn-secondary" onclick="clearForm()" value="clear">
                                </section>

                            </form>

                        </div>

                        <div class="col-md-4" style="margin-left: 10em;">

                            <div class="card cards card-2 " style="width: auto;">
                              <a href="">
                                  <div class="card-body">
                                      <h5 class="card-title text-center">About Me</h5>
                                      <p class="card-text" style="text-align: left; pading-left:30px;">
                                      <strong>Staff ID:</strong> <span id="staff_id"><?php echo $staff_id; ?></span><br><br>
                                      <strong>Name:</strong> <span id="first_name"><?php echo $first_name; ?></span> <span id="last_name"><?php echo $last_name; ?></span><br><br>
                                      <strong>Job Title:</strong> <span id="job_title"><?php echo $job_title; ?></span><br><br>
                                      <strong>Phone Number:</strong> <span id="phone_number"><?php echo $phone_number; ?></span><br><br>
                                      <strong>Email:</strong> <span id="email"><?php echo $email; ?></span><br><br>
                                      <strong>Availability:</strong> <span id="availability"><?php echo $availability; ?></span>
                                      </p>
                                  </div>
                              </a>
                            </div>

                        </div>

                    </div>
                                   
                </section>
                
            </div>
        </div>
    </div>
</div>

<script>
    function clearForm() {
    document.getElementById("staff_id").value = "";
    document.getElementById("first_name").value = "";
    document.getElementById("last_name").value = "";
    document.getElementById("job_title").value = "";
    document.getElementById("phone_number").value = "";
    document.getElementById("email").value = "";
    document.getElementById("availability").value = "";
}
</script>