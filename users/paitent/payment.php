
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
                    <h2>My Invoices</h2>
                </section>


                <section style="margin-top:-30px" >

                    <div class="row">

                        <div class="col-md-12">

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
                           
                </section>
                
            </div>
        </div>
    </div>
</div>