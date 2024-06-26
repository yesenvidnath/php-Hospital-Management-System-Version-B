<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

$action = '';
$staff_id = '';
$first_name = '';
$last_name = '';
$job_title = '';
$gender = '';
$phone_number = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $staff_id = $_POST['staff_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $job_title = $_POST['job_title'];
    $gender = $_POST['gender']; // Change this line
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];


    switch ($action) {
        case 'insert':
            $sql = "INSERT INTO staff ( staff_id,first_name, last_name, job_title, gender, phone_number, email) VALUES ('$staff_id', '$first_name', '$last_name', '$job_title', '$gender', '$phone_number', '$email')";
            $conn->query($sql);
            break;

        case 'update':
            $sql = "UPDATE staff SET first_name='$first_name', last_name='$last_name', job_title='$job_title', gender='$gender', phone_number='$phone_number', email='$email' WHERE staff_id='$staff_id'";
            $conn->query($sql);
            break;

        case 'delete':
            $sql = "DELETE FROM staff WHERE staff_id='$staff_id'";
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
                $gender = $row['gender'];
                $phone_number = $row['phone_number'];
                $email = $row['email'];
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
            <?php include('template-parts/dashbords/side_panel_admin.php');?>
        </div>

        <!-- Right Panel -->
        <div class="col-md-10 side-panel-r">

            <div class="container-fluid navigation-container">

                <?php include('template-parts/dashbords/navigation_admin.php');?>

            </div>
            <br>
            <div class="container" style="margin-top:-30px">

                <section class="title-of-dash">
                    <h2>Staff Management</h2>
                </section>

                <section>

                    <div class="row">

                        <div class="col-md-6">
                            
                            <form method="POST">

                                <div class="form-group">
                                    <label for="staff_id">Staff ID:</label>
                                    <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="job_title">Job Title:</label>
                                    <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo $job_title; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>">
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
                                    <input type="submit" class="btn btn-primary" name="action" value="insert">
                                    <input type="submit" class="btn btn-success" name="action" value="update">
                                    <input type="submit" class="btn btn-danger" name="action" value="delete">
                                    <input type="submit" class="btn btn-info" name="action" value="search">
                                    <input type="button" class="btn btn-secondary" onclick="clearForm()" value="clear">
                                </section>

                            </form>

                        </div>

                        <div class="col-md-6">

                            <?php
                                $result = $conn->query("SELECT * FROM staff");

                                if ($result->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Staff ID</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Job Title</th>
                                                    <th>Gender</th>
                                                    <th>Phone Number</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['staff_id']; ?></td>
                                                        <td><?php echo $row['first_name']; ?></td>
                                                        <td><?php echo $row['last_name']; ?></td>
                                                        <td><?php echo $row['job_title']; ?></td>
                                                        <td><?php echo $row['gender']; ?></td>
                                                        <td><?php echo $row['phone_number']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                } else {
                                    echo "<div class='alert alert-info mt-5'>No staff found</div>";
                                }
                            ?>

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
    document.getElementById("gender").value = "";
    document.getElementById("phone_number").value = "";
    document.getElementById("email").value = "";
    document.getElementById("availability").value = "";
}
</script>
<?php
  include('template-parts/dashbords/footer.php');
?>