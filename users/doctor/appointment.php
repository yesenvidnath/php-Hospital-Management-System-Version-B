
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

                                <div class="form-group">
                                    <label for="staff_id">Staff ID
                                    <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>" style="width:100%">
                                </div>

                                <div class="form-group">
                                    <label for="room_id">Room ID:</label>
                                    <input type="text" class="form-control" id="room_id" name="room_id" value="<?php echo $room_id; ?>">
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

                            <?php
                                $result = $conn->query("SELECT * FROM Appointments");

                                if ($result->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Appointment ID</th>
                                                    <th>Patient ID</th>
                                                    <th>Staff ID</th>
                                                    <th>Room ID</th>
                                                    <th>Appointment Date</th>
                                                    <th>Appointment Time</th>
                                                    <th>Discharge Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['appointment_id']; ?></td>
                                                        <td><?php echo $row['patient_id']; ?></td>
                                                        <td><?php echo $row['staff_id']; ?></td>
                                                        <td><?php echo $row['room_id']; ?></td>
                                                        <td><?php echo $row['appointment_date']; ?></td>
                                                        <td><?php echo $row['appointment_time']; ?></td>
                                                        <td><?php echo $row['discharge_date']; ?></td>
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

                        </div>

                    </div>

                </section>

            </div>
        </div>
    </div>
</div>

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