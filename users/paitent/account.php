
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
            <div class="container-fluid">

                <section class="title-of-dash">
                    <h2>My Profile</h2>
                </section>


                <section style="margin-top:-30px">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="card cards card-2 " style="width: auto;">
                              <a href="">
                                  <div class="card-body">
                                      <h5 class="card-title text-center">About Me</h5>
                                      <p class="card-text" style="text-align: left; pading-left:30px;">
                                          <strong>Patient ID:</strong> <span id="staff_id"><?php echo htmlspecialchars ($patient_id); ?></span><br><br>
                                          <strong>Name:</strong> <span id="first_name"><?php echo htmlspecialchars ($patient_fname); ?></span> <span id="last_name"><?php echo htmlspecialchars ($patient_lname); ?></span><br><br>
                                          <strong>Birth Day:</strong> <span id="job_title"><?php echo htmlspecialchars ($patient_bday); ?></span><br><br>
                                          <strong>Address:</strong> <span id="phone_number"><?php echo htmlspecialchars ($patient_add); ?></span><br><br>
                                          <strong>gender:</strong> <span id="phone_number"><?php echo htmlspecialchars ($gender); ?></span><br><br>
                                          <strong>Phone Number:</strong> <span id="email"><?php echo htmlspecialchars ($patient_phone); ?></span><br><br>
                                          <strong>Email:</strong> <span id="user_id"><?php echo htmlspecialchars ($patient_email); ?></span></span><br><br>
                                          <strong>User ID:</strong> <span id="availability"><?php echo htmlspecialchars ($user_id); ?></span>
                                      </p>
                                  </div>
                              </a>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="card cards card-2 " style="width: auto;">
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">My Medical History</h5>
                                        <p class="card-text">
                                            <?php echo htmlspecialchars ($patient_medical_h); ?>
                                        </p>
                                    </div>
                                </a>
                            </div> <br>

                            <div class="card cards card-2 " style="width: auto;">
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">My Invoices</h5>
                                            <p class="card-text">
                                                    <?php
                                                    $patient_id = $row['patient_id'];

                                                    $sql = "SELECT * FROM invoices WHERE patient_id = ?";
    
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
                                                                    <th>Invoice ID</th>
                                                                    <th>Appointment ID</th>
                                                                    <th>Invoice Date</th>
                                                                    <th>Invoice Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($doctor as $row) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['patient_id']; ?></td>
                                                                        <td><?php echo $row['appointment_id']; ?></td>
                                                                        <td><?php echo $row['invoice_date']; ?></td>
                                                                        <td><?php echo $row['invoice_total']; ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php
                                                    } else {
                                                        echo "<div class='alert alert-info mt-5'>No Invoices found</div>";
                                                    }
                                                ?>
                                            </p>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>
                             
                    <div class="row">
                        <div class="col-6">
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

                        <div class="col-6">
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

                    </div>

                </section>
                
            </div>
        </div>
    </div>
</div>