
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$appointment_id = '';
$patient_id = '';
$staff_id = '';
$room_id = '';
$appointment_date = '';
$appointment_time = '';
$discharge_date = '';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $appointment_id = $_POST['appointment_id'];
    $patient_id = $_POST['patient_id'];
    $staff_id = $_POST['staff_id'];
    $room_id = $_POST['room_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $discharge_date = $_POST['discharge_date'];

    switch ($action) {
        case 'insert':
            $sql = "INSERT INTO Appointments (patient_id, staff_id, room_id, appointment_date, appointment_time, discharge_date) VALUES ('$patient_id', '$staff_id', '$room_id', '$appointment_date', '$appointment_time', '$discharge_date')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Appointment inserted successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error inserting appointment: " . $conn->error . "</div>";
            }
            break;

        case 'update':
            $sql = "UPDATE appointments SET patient_id='$patient_id', staff_id='$staff_id', room_id='$room_id', appointment_date='$appointment_date', appointment_time='$appointment_time', discharge_date='$discharge_date' WHERE appointment_id='$appointment_id'";
            $conn->query($sql);
            break;

        case 'delete':
            $sql = "DELETE FROM appointments WHERE appointment_id='$appointment_id'";
            $conn->query($sql);
            break;

        case 'search':
            $sql = "SELECT * FROM appointments WHERE appointment_id='$appointment_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $patient_id = $row['patient_id'];
                $staff_id = $row['staff_id'];
                $room_id = $row['room_id'];
                $appointment_date = $row['appointment_date'];
                $appointment_time = $row['appointment_time'];
                $discharge_date = $row['discharge_date'];
            } else {
                echo "<div class='alert alert-warning'>No appointment found with the given ID</div>";
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
                    <h2>Appointments</h2>
                </section>


                <section>

                    <div class="row">

                        <div class="col-md-5">

                            <form method="POST">

                                <div class="form-group">
                                    <label for="appointment_id">Appointment ID:</label>
                                    <input type="text" class="form-control" id="appointment_id" name="appointment_id" value="<?php echo $appointment_id; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="patient_id">Patient ID:</label>
                                    <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="staff_id">Staff ID
                                            <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>" style="width:100%">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="room_id">Room ID:</label>
                                            <input type="text" class="form-control" id="room_id" name="room_id" value="<?php echo $room_id; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="appointment_date">Appointment Date:</label>
                                    <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $appointment_date; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="appointment_time">Appointment Time:</label>
                                    <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo $appointment_time; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="discharge_date">Discharge Date:</label>
                                    <input type="date" class="form-control" id="discharge_date" name="discharge_date" value="<?php echo $discharge_date; ?>">
                                </div>

                                <section class="button-section">

                                    <!-- Buton List -->
                                    <input type="submit" class="btn btn-primary" name="action" value="insert">
                                    <input type="submit" class="btn btn-success " name="action" value="update">
                                    <input type="submit" class="btn btn-danger " name="action" value="delete">
                                    <input type="submit" class="btn btn-info" name="action" value="search">
                                    <input type="button" class="btn btn-secondary" onclick="clearForm()" value="clear">

                                </section>

                            </form>

                        </div>

                        <div class="col-md-7">

                            <div class="row">

                                <div class="card cards card-2 " style="width: auto;">
                                    <a href="">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">My Appointments</h5>
                                            <p class="card-text">

                                                <?php
                                                    $patient_id = $row['patient_id'];

                                                    $sql = "SELECT appointments.appointment_id, appointments.appointment_date, appointments.appointment_time, staff.first_name, staff.job_title
                                                    FROM appointments
                                                    JOIN staff ON appointments.staff_id = staff.staff_id
                                                    WHERE appointments.patient_id = ?";
    
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->bind_param("i", $patient_id);
                                                    $stmt->execute();
    
                                                    $result = $stmt->get_result();
                                                    $patients = $result->fetch_all(MYSQLI_ASSOC);
    
                                                    $stmt->close();

                                                if ($result->num_rows > 0) {
                                                ?>
                                                    <div class="table-responsive mt-5">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>appointment ID </th>
                                                                    <th>Doctor/<br>Nurce</th>
                                                                    <th>Staff Name </th>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($patients as $row) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['appointment_id']; ?></td>
                                                                        <td><?php echo $row['job_title']; ?></td>
                                                                        <td><?php echo $row['first_name']; ?></td>
                                                                        <td><?php echo $row['appointment_date']; ?></td>
                                                                        <td><?php echo $row['appointment_time']; ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                <?php
                                                    } else {
                                                        echo "<div class='alert alert-info mt-5'>No appointments found</div>";
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="row">

                                <div class="card cards card-2 " style="width: auto;">
                                    <a href="">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">All Nurses</h5>
                                            <p class="card-text">
                                                    <?php
                                                        $sql = "SELECT * FROM staff WHERE job_title='Nurse'";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute();

                                                        $result2 = $stmt->get_result();
                                                        $doctor = $result2->fetch_all(MYSQLI_ASSOC);

                                                        $stmt->close();
                                                        if ($result2->num_rows > 0) {
                                                    ?>
                                                    <div class="table-responsive mt-5">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nurse ID</th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name</th>
                                                                    <th>Availability</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($doctor as $row) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['staff_id']; ?></td>
                                                                        <td><?php echo $row['first_name']; ?></td>
                                                                        <td><?php echo $row['last_name']; ?></td>
                                                                        <td><?php echo $row['availability']; ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php
                                                    } else {
                                                        echo "<div class='alert alert-info mt-5'>No appointments found</div>";
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>

                            </div>

                            <div class="row">
                                <div class="card cards card-2 " style="width: auto;">
                                    <a href="">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">All Doctors</h5>
                                                <p class="card-text">
                                                        <?php
                                                            $sql = "SELECT * FROM staff WHERE job_title='Doctor'";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->execute();

                                                            $result2 = $stmt->get_result();
                                                            $doctor = $result2->fetch_all(MYSQLI_ASSOC);

                                                            $stmt->close();
                                                            if ($result2->num_rows > 0) {
                                                        ?>
                                                        <div class="table-responsive mt-5">
                                                            <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Doctor ID</th>
                                                                        <th>First Name</th>
                                                                        <th>Last Name</th>
                                                                        <th>Availability</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($doctor as $row) {
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $row['staff_id']; ?></td>
                                                                            <td><?php echo $row['first_name']; ?></td>
                                                                            <td><?php echo $row['last_name']; ?></td>
                                                                            <td><?php echo $row['availability']; ?></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php
                                                        } else {
                                                            echo "<div class='alert alert-info mt-5'>No appointments found</div>";
                                                        }
                                                    ?>
                                                </p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>

                </section>

            </div>
        </div>
    </div>
</div>


<?php
if (isset($_SESSION['user_type'])) {
  if ($_SESSION['user_type'] === 'admin') {
    echo "<style>/* Your CSS for admin user here */</style>";
  } elseif ($_SESSION['user_type'] === 'patient') {
    echo "<style> table-responsive{ display: none; } </style>";
  } elseif ($_SESSION['user_type'] === 'staff') {
    echo "<style>/* Your CSS for staff user here */</style>";
  }
}
?>


<script>
function clearForm() {
    document.getElementById("appointment_id").value = "";
    document.getElementById("patient_id").value = "";
    document.getElementById("staff_id").value = "";
    document.getElementById("room_id").value = "";
    document.getElementById("appointment_date").value = "";
    document.getElementById("appointment_time").value = "";
    document.getElementById("discharge_date").value = "";
}
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>