
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
                    <h2>My ToDo List</h2>
                </section>


                <section style="margin-top:-30px">

                    <div class="row">

                        <div class="col-md-5">

                            <div class="card cards card-2 " style="width: auto;">
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Doctors Need to See</h5>
                                        <p class="card-text">
                                                <?php
                                                    $sql = "SELECT * FROM staff WHERE job_title='Doctor'"; // Enclose 'Doctor' in quotes
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

                        <div class="col-md-7">

                            <div class="card cards card-2 " style="width: auto;">
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">My appoiintments</h5>
                                        <p class="card-text">
                                            <?php
                                                $staff_id = $row['staff_id'];

                                                $sql = "SELECT appointments.*, patients.first_name, patients.last_name
                                                FROM appointments
                                                JOIN patients ON appointments.patient_id = patients.patient_id
                                                WHERE appointments.staff_id = ?";
                                        
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i", $staff_id);
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
                                                                <th>Appointment ID</th>
                                                                <th>Patient Name</th>
                                                                <th>Room ID</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($patients as $row) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $row['appointment_id']; ?></td>
                                                                    <td><?php echo $row['first_name']; ?></td>
                                                                    <td><?php echo $row['room_id']; ?></td>
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


                            <br>

                            <div class="card cards card-2 " style="width: auto;">
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Assigned Prosedures</h5>
                                        <p class="card-text">
                                            <?php
                                                $user_id = $_SESSION['user_id'];
                                                $query = "SELECT * FROM staff WHERE user_id = '$user_id'";
                                                $result = mysqli_query($conn, $query);
                                                $staff_row = mysqli_fetch_assoc($result);
                                                $staff_id = $staff_row['staff_id'];
                                                $sql = "SELECT procedures.*, procedures.procedure_name, procedures.procedure_time, procedures.procedure_date, procedures.procedure_desc, operating_rooms.operating_room_name
                                                FROM procedures 
                                                JOIN operating_rooms ON procedures.operating_room_id = operating_rooms.operating_room_id 
                                                WHERE procedures.staff_id = ?";                                        

                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i", $staff_id);
                                                $stmt->execute();

                                                $result = $stmt->get_result();
                                                $pro = $result->fetch_all(MYSQLI_ASSOC);

                                                $stmt->close();

                                                if ($result->num_rows > 0) {
                                                    ?>
                                                    <div class="table-responsive mt-5">
                                                        <table class="table table-striped table-bordered table-hover" >
                                                            <thead>
                                                                <tr>
                                                                    <th>Procedure</th>
                                                                    <th>About</th>
                                                                    <th>Time</th>
                                                                    <th>Date</th>
                                                                    <th>Operating Room</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($pro as $row) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['procedure_name']; ?></td>
                                                                        <td><?php echo $row['procedure_desc']; ?></td>
                                                                        <td><?php echo $row['procedure_time']; ?></td>
                                                                        <td><?php echo $row['procedure_date']; ?></td>
                                                                        <td><?php echo $row['operating_room_name']; ?></td>
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