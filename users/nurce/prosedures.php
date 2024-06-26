<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = '';
$procedure_id =''; 
$staff_id = '';
$patient_id = '';
$operating_room_id = ''; 
$procedure_name = ''; 
$procedure_time = ''; 
$procedure_date = '';
$procedure_desc = '';
$procedure_cost = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];
    $procedure_id = $_POST['procedure_id'];
    $staff_id = $_POST['staff_id'];
    $patient_id = $_POST['patient_id'];
    $operating_room_id = $_POST['operating_room_id'];
    $procedure_name = $_POST['procedure_name'];
    $procedure_time = $_POST['procedure_time'];
    $procedure_date = $_POST['procedure_date'];
    $procedure_desc = $_POST['procedure_desc'];
    $procedure_cost = $_POST['procedure_cost'];

    switch ($action) {
        case 'insert':
            $sql = "INSERT INTO procedures (`staff_id`, `patient_id`, `operating_room_id`, `procedure_name`, `procedure_time`, `procedure_date`, `procedure_desc`, `procedure_cost`) VALUES ('$staff_id','$patient_id','$operating_room_id','$procedure_name','$procedure_time','$procedure_date','$procedure_desc','$procedure_cost')";
            $conn->query($sql);
            break;

        case 'update':
            $sql = "UPDATE `procedures` SET `staff_id`='$staff_id',`patient_id`='$patient_id',`operating_room_id`='$operating_room_id',`procedure_name`='$procedure_name',`procedure_time`='$procedure_time',`procedure_date`='$procedure_date',`procedure_desc`='$procedure_desc',`procedure_cost`='$procedure_cost' WHERE procedure_id='$procedure_id'";
            $conn->query($sql);
            break;

        case 'search':
            $sql = "SELECT * FROM procedures WHERE procedure_id='$procedure_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();                
                $procedure_id = $row['procedure_id'];
                $staff_id = $row['staff_id'];
                $patient_id = $row['patient_id'];
                $operating_room_id = $row['operating_room_id'];
                $procedure_name = $row['procedure_name'];
                $procedure_time = $row['procedure_time'];
                $procedure_date = $row['procedure_date'];
                $procedure_desc = $row['procedure_desc'];
                $procedure_cost = $row['procedure_cost'];
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
                    <h2>Procedures</h2>
                </section>


                <section>

                    <div class="row">

                        <div class="col-md-5">

                            <form method="POST">

                                <div class="form-group">
                                    <label for="procedure_id">Procedure ID:</label>
                                    <input type="text" class="form-control" id="procedure_id" name="procedure_id" value="<?php echo $procedure_id; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="patient_id">Pitent ID:</label>
                                    <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="staff_id">Staff ID:</label>
                                    <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="operating_room_id">Operating Room ID:</label>
                                    <input type="text" class="operating_room_id" id="operating_room_id" name="operating_room_id" value="<?php echo $operating_room_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="procedure_name">Procedure Name:</label>
                                    <input type="text" class="form-control" id="procedure_name" name="procedure_name" value="<?php echo $procedure_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="procedure_time">Procedure Time:</label>
                                    <input type="time" class="form-control" id="procedure_time" name="procedure_time" value="<?php echo $procedure_time; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="procedure_date">Procedure Date:</label>
                                    <input type="date" class="form-control" id="procedure_date" name="procedure_date" value="<?php echo $procedure_date; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="procedure_desc">Procedure Discription:</label>
                                    <input type="text" class="form-control" id="procedure_desc" name="procedure_desc" value="<?php echo $procedure_desc; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="procedure_cost">Procedure Cost:</label>
                                    <input type="text" class="form-control" id="procedure_cost" name="procedure_cost" value="<?php echo $procedure_cost; ?>">
                                </div>

                                <section class="button-section">
                                    <input type="submit" class="btn btn-primary" name="action" value="insert">
                                    <input type="submit" class="btn btn-success" name="action" value="update">
                                    <input type="submit" class="btn btn-info" name="action" value="search">
                                    <input type="button" class="btn btn-secondary" onclick="clearForm()" value="clear">
                                </section>

                            </form>

                        </div>

                        <div class="col-md-7 ml-auto">

                            <?php
                                $result = $conn->query("SELECT * FROM procedures");

                                if ($result->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>procedure_id</th>
                                                    <th>staff_id</th>
                                                    <th>patient_id</th>
                                                    <th>operating_room_id</th>
                                                    <th>procedure_name</th>
                                                    <th>procedure_time</th>
                                                    <th>procedure_date</th>
                                                    <th>procedure_desc</th>
                                                    <th>procedure_cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['procedure_id']; ?></td>
                                                        <td><?php echo $row['staff_id']; ?></td>
                                                        <td><?php echo $row['patient_id']; ?></td>
                                                        <td><?php echo $row['operating_room_id']; ?></td>
                                                        <td><?php echo $row['procedure_name']; ?></td>
                                                        <td><?php echo $row['procedure_time']; ?></td>
                                                        <td><?php echo $row['procedure_date']; ?></td>
                                                        <td><?php echo $row['procedure_desc']; ?></td>
                                                        <td><?php echo $row['procedure_cost']; ?></td>
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
    document.getElementById("procedure_id").value = "";
    document.getElementById("staff_id").value = "";
    document.getElementById("patient_id").value = "";
    document.getElementById("operating_room_id").value = "";
    document.getElementById("procedure_name").value = "";
    document.getElementById("procedure_time").value = "";
    document.getElementById("procedure_date").value = "";
    document.getElementById("procedure_desc").value = "";
    document.getElementById("procedure_cost").value = "";
}
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>