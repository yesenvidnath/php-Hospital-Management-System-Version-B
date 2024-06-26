<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

$action = '';
$room_id = '';
$room_name = '';
$room_type = '';
$max_capacity = '';
$max_capacity = '';
$availability = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $action = $_POST['action'];
    $room_id = $_POST['room_id'];
    $room_name = $_POST['room_name'];
    $room_type = $_POST['room_type'];
    $max_capacity = $_POST['max_capacity'];
    $availability = $_POST['availability'];

    switch ($action) {

        case 'update':
            $sql = "UPDATE rooms SET room_name='$room_name', room_type='$room_type', max_capacity='$max_capacity', availability='$availability' WHERE room_id='$room_id'";
            $conn->query($sql);
            break;

        case 'search':
            $sql = "SELECT * FROM rooms WHERE room_id='$room_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $room_name = $row['room_name'];
                $room_type = $row['room_type'];
                $max_capacity = $row['max_capacity'];
                $max_capacity = $row['max_capacity'];
                $availability = $row['availability'];
            } else {
                echo "<div class='alert alert-warning'>No room found with the given ID</div>";
            }
            break;
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
        <div class="col-md-10 side-panel-r" >

            <div class="container-fluid navigation-container">

                <?php include('template-parts/dashbords/navigation.php');?>

            </div>
            <br>
            <div class="container" style="margin-top:-30px">

                <section class="title-of-dash">
                    <h2>Room Management</h2>
                </section>

                <section>

                    <div class="row">

                        <div class="col-md-6">
                            
                            <form method="POST">

                                <div class="form-group">
                                    <label for="room_id">Room ID:</label>
                                    <input type="text" class="form-control" id="room_id" name="room_id" value="<?php echo $room_id; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="room_name">Room Name:</label>
                                    <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $room_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="room_type">Room Type:</label>
                                    <input type="text" class="form-control" id="room_type" name="room_type" value="<?php echo $room_type; ?>">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="max_capacity">Max Capacity:</label>
                                            <input type="text" class="form-control" id="max_capacity" name="max_capacity" value="<?php echo $max_capacity; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="availability">Availability:</label>
                                            <input type="text" class="form-control" id="availability" name="availability" value="<?php echo $availability; ?>">
                                        </div>
                                    </div>
                                </div>

                                <section class="button-section">
                                    <input type="submit" class="btn btn-success" name="action" value="update">
                                    <input type="submit" class="btn btn-info" name="action" value="search">
                                    <input type="button" class="btn btn-secondary" onclick="clearForm()" value="clear">
                                </section>

                            </form>

                        </div>

                        <div class="col-md-6">

                            <?php
                                $result = $conn->query("SELECT * FROM rooms");

                                if ($result->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Room ID</th>
                                                    <th>Room Name</th>
                                                    <th>Room Type</th>
                                                    <th>Max Capacity</th>
                                                    <th>Availability</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['room_id']; ?></td>
                                                        <td><?php echo $row['room_name']; ?></td>
                                                        <td><?php echo $row['room_type']; ?></td>
                                                        <td><?php echo $row['max_capacity']; ?></td>
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
                                    echo "<div class='alert alert-info mt-5'>No rooms found</div>";
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
    document.getElementById("room_id").value = "";
    document.getElementById("room_name").value = "";
    document.getElementById("room_type").value = "";
    document.getElementById("max_capacity").value = "";
    document.getElementById("availability").value = "";
}
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>