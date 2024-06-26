<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action =  '';
$patient_id =  '';
$first_name =  '';
$last_name =  '';
$date_of_birth = '';
$gender = '';
$address =  '';
$phone_number =  '';
$email =  '';
//$medical_history =  '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    //$medical_history = $_POST['medical_history'];

    switch ($action) {

        case 'update':
            $sql = "UPDATE patients SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', gender='$gender', address='$address', phone_number='$phone_number', email='$email' WHERE patient_id='$patient_id'";
            $conn->query($sql);
            break;

        case 'search':
            $sql = "SELECT * FROM patients WHERE patient_id='$patient_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $date_of_birth = $row['date_of_birth'];
                $gender = $row['gender'];
                $address = $row['address'];
                $phone_number = $row['phone_number'];
                $email = $row['email'];
            } else {
                echo "<div class='alert alert-warning'>No patient found with the given ID</div>";
            }
        break;
    }
}
?>

<div class="container-fluid">
    <div class="row main-section">

        <!-- Left Panel -->
        <div class="col-md-2 side-panel-l text-center">
            <?php include('template-parts/dashbords/side_panel_paitent.php');?>
        </div>

        <!-- Right Panel -->
        <div class="col-md-10 side-panel-r">

            <div class="container-fluid navigation-container">

                <?php include('template-parts/dashbords/navigation_paitent.php');?>

            </div>
            <br>
            <div class="container" style="margin-top:-30px">

                <section class="title-of-dash">
                    <h2>Patient Management</h2>
                </section>

                <section>

                    <div class="row">

                        <div class="col-md-6">
                            
                            <form method="POST">

                                <div class="form-group">
                                    <label for="patient_id">Patient ID:</label>
                                    <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name: </label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth:</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="email">Medical-History:</label>
                                    <textarea type="text" class="form-control" id="medical_history" name="medical_history"><?php //echo $medical_history; ?></textarea>
                                </div> -->

                                <section class="button-section">
                                <input type="submit" class="btn btn-success" name="action" value="update">
                                    <input type="submit" class="btn btn-info" name="action" value="search">
                                    <input type="button" class="btn btn-secondary" onclick="clearForm()" value="clear">
                                </section>
                            </form>

                        </div>

                        <div class="col-md-6">

                            <div class="card cards card-2 " style="width: auto;">
                              <a href="">
                                  <div class="card-body">
                                      <h5 class="card-title text-center">About Me</h5>
                                      <p class="card-text" style="text-align: left; pading-left:30px;">
                                          <strong>Patient ID:</strong> <span id="patient_id"><?php echo htmlspecialchars ($patient_id); ?></span><br><br>
                                          <strong>Name:</strong> <span id="first_name"><?php echo htmlspecialchars ($patient_fname); ?></span> <span id="last_name"><?php echo htmlspecialchars ($patient_lname); ?></span><br><br>
                                          <strong>Birth Day:</strong> <span id="patient_bday"><?php echo htmlspecialchars ($patient_bday); ?></span><br><br>
                                          <strong>gender:</strong> <span id="patient_bday"><?php echo htmlspecialchars ($gender); ?></span><br><br>
                                          <strong>Address:</strong> <span id="patient_add"><?php echo htmlspecialchars ($patient_add); ?></span><br><br>
                                          <strong>Phone Number:</strong> <span id="patient_phone"><?php echo htmlspecialchars ($patient_phone); ?></span><br><br>
                                          <strong>Email:</strong> <span id="user_id"><?php echo htmlspecialchars ($patient_email); ?></span></span><br><br>
                                          <strong>User ID:</strong> <span id="availability"><?php echo htmlspecialchars ($user_id); ?></span>
                                      </p>
                                  </div>
                              </a>
                            </div> 
                            <br>

                            <div class="card cards card-2 " style="width: auto;">
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">My Medical History</h5>
                                        <p class="card-text">
                                            <?php echo htmlspecialchars ($patient_medical_h); ?>
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <br>
                            <div class="card cards card-2 " style="width: auto;">
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">My Prosedures</h5>
                                        <p class="card-text">
                                        <?php
                                                $patient_id = $row['patient_id'];
                                                $sql = "SELECT * FROM procedures WHERE patient_id = ?";

                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i", $patient_id);
                                                $stmt->execute();

                                                $result = $stmt->get_result();
                                                $patient = $result->fetch_all(MYSQLI_ASSOC);

                                                $stmt->close();

                                                if ($result->num_rows > 0) {
                                                    ?>
                                                    <div class="table-responsive mt-5">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Procedure</th>
                                                                    <th>Time</th>
                                                                    <th>Date</th>
                                                                    <th>About</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($patient as $row) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['procedure_name']; ?></td>
                                                                        <td><?php echo $row['procedure_time']; ?></td>
                                                                        <td><?php echo $row['procedure_date']; ?></td>
                                                                        <td><?php echo $row['procedure_desc']; ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php
                                                    } else {
                                                        echo "<div class='alert alert-info mt-5'>No Prosedures Yet</div>";
                                                    }
                                                ?>
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
        document.getElementById("patient_id").value = "";
        document.getElementById("first_name").value = "";
        document.getElementById("last_name").value = "";
        document.getElementById("date_of_birth").value = "";
        document.getElementById("address").value = "";
        document.getElementById("phone_number").value = "";
        document.getElementById("email").value = "";
        document.getElementById("gender").value = "";
    }
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>

