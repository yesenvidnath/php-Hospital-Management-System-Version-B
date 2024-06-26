<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = '';
$invoice_id = '';
$patient_id = '';
$appointment_id = '';
$invoice_date = '';
$invoice_total = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $invoice_id = $_POST['invoice_id'];
    $patient_id = $_POST['patient_id'];
    $appointment_id = $_POST['appointment_id'];
    $invoice_date = $_POST['invoice_date'];
    $invoice_total = $_POST['invoice_total'];

    switch ($action) {
        case 'insert':
            $check_appointment = "SELECT * FROM appointments WHERE appointment_id = '$appointment_id'";
            $appointment_result = $conn->query($check_appointment);
            if ($appointment_result->num_rows > 0) {
                $sql = "INSERT INTO invoices (patient_id, appointment_id, invoice_date, invoice_total) VALUES ('$patient_id', '$appointment_id', '$invoice_date', '$invoice_total')";
                $conn->query($sql);
            } else {
                echo "<div class='alert alert-warning'>Invalid Appointment ID. Please provide a valid Appointment ID.</div>";
            }
        break;
        
        case 'update':
            $sql = "UPDATE invoices SET patient_id='$patient_id', appointment_id='$appointment_id', invoice_date='$invoice_date', invoice_total='$invoice_total' WHERE invoice_id='$invoice_id'";
            $conn->query($sql);
            break;

        case 'delete':
            $sql = "DELETE FROM invoices WHERE invoice_id='$invoice_id'";
            $conn->query($sql);
            break;

        case 'search':
            $sql = "SELECT * FROM invoices WHERE invoice_id='$invoice_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $patient_id = $row['patient_id'];
                $appointment_id = $row['appointment_id'];
                $invoice_date = $row['invoice_date'];
                $invoice_total = $row['invoice_total'];
            } else {
                echo "<div class='alert alert-warning'>No Payment Records found with the given ID</div>";
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
                    <h2>Manage Payment</h2>
                </section>

                <section>

                    <div class="row">

                        <div class="col-md-6">
                            
                            <form method="POST">

                                <div class="form-group">
                                    <label for="invoice_id">Invoice Id:</label>
                                    <input type="text" class="form-control" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="patient_id">Patient Id:</label>
                                    <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="appointment_id">Appointment Id:</label>
                                    <input type="text" class="form-control" id="appointment_id" name="appointment_id" value="<?php echo $appointment_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="invoice_date">Invoice Date:</label>
                                    <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="<?php echo $invoice_date; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="invoice_total">Invoice Total:</label>
                                    <input type="text" class="form-control" id="invoice_total" name="invoice_total" value="<?php echo $invoice_total; ?>">
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
                                $result = $conn->query("SELECT * FROM invoices");

                                if ($result->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Invoice Id</th>
                                                    <th>Patient Id </th>
                                                    <th>Staff Id </th>
                                                    <th>Appointment Id</th>
                                                    <th>Invoice Date</th>
                                                    <th>Invoice Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['invoice_id']; ?></td>
                                                        <td><?php echo $row['patient_id']; ?></td>
                                                        <td><?php echo $row['staff_id']; ?></td>
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
                                    echo "<div class='alert alert-info mt-5'>No users found</div>";
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
        document.getElementById("invoice_id").value = "";
        document.getElementById("patient_id").value = "";
        document.getElementById("appointment_id").value = "";
        document.getElementById("invoice_date").value = "";
        document.getElementById("invoice_total").value = "";
    }
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>