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
$medical_history =  '';

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
    $medical_history = $_POST['medical_history'];

    switch ($action) {

        case 'insert':
            $sql = "INSERT INTO patients (first_name, last_name, date_of_birth, gender, address, phone_number, email, medical_history) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $first_name, $last_name, $date_of_birth, $gender, $address, $phone_number, $email, $medical_history);
            $stmt->execute();
        break;

        case 'update':
            $sql = "UPDATE patients SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', gender='$gender', address='$address', phone_number='$phone_number', email='$email',medical_history='$medical_history' WHERE patient_id='$patient_id'";
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
                $medical_history = $row['medical_history'];
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
            <?php include('template-parts/dashbords/side-panel.php');?>
        </div>

        <!-- Right Panel -->
        <div class="col-md-10 side-panel-r">

            <div class="container-fluid navigation-container">

                <?php include('template-parts/dashbords/navigation.php');?>

            </div>
            <br>
            <div class="container" style="margin-top:-30px"	>

                <section class="title-of-dash">
                    <h2>Patient Management</h2>
                </section>

                <section>

                    <div class="row">

                        <div class="col-md-4">
                            
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
                                <div class="form-group">
                                    <label for="email">Medical-History:</label>
                                    <textarea type="text" class="form-control" id="medical_history" name="medical_history"><?php echo $medical_history; ?></textarea>
                                </div>

                                <section class="button-section">
                                    <input type="submit" class="btn btn-primary" name="action" value="insert">
                                    <input type="submit" class="btn btn-success" name="action" value="update">
                                    <input type="submit" class="btn btn-info" name="action" value="search">
                                    <input type="button" class="btn btn-secondary" onclick="clearForm()" value="clear">
                                </section>
                            </form>

                        </div>

                        <div class="col-md-8">

                        <?php
                            $result = $conn->query("SELECT * FROM patients");

                            if ($result->num_rows > 0) {
                            ?>
                                <div class="table-responsive mt-5">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Patient ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Date of Birth</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                                <th>Medical History</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['patient_id']; ?></td>
                                                    <td><?php echo $row['first_name']; ?></td>
                                                    <td><?php echo $row['last_name']; ?></td>
                                                    <td><?php echo $row['date_of_birth']; ?></td>
                                                    <td><?php echo $row['gender']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['phone_number']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['medical_history']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                            } else {
                                echo "<div class='alert alert-info mt-5'>No Patient found</div>";
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
    document.getElementById("patient_id").value = "";
    document.getElementById("first_name").value = "";
    document.getElementById("last_name").value = "";
    document.getElementById("date_of_birth").value = "";
    document.getElementById("gender").value = "";
    document.getElementById("address").value = "";
    document.getElementById("phone_number").value = "";
    document.getElementById("email").value = "";
    document.getElementById("medical_history").value = "";
}
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>

