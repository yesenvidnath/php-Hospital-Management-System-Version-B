
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
            <div class="container-fluid"style="margin-top:-30px">

                <section class="title-of-dash">
                    <h2>My Profile</h2>
                </section>


                <section >

                    <div class="row">

                        <div class="col-md-6">

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

                        <div class="col-md-6">

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
                                   
                </section>
                
            </div>
        </div>
    </div>
</div>