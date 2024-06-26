<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

$action = '';
$operating_room_id = '';
$operating_room_availability = '';
$operating_room_name = '';
$operating_room_description = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $operating_room_id = $_POST['operating_room_id'];
    $operating_room_availability = $_POST['operating_room_availability'];
    $operating_room_name = $_POST['operating_room_name'];
    $operating_room_description = $_POST['operating_room_description'];

    switch ($action) {
        case 'insert':
            $sql = "INSERT INTO operating_rooms (operating_room_name, availability, operating_room_description) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $operating_room_name, $operating_room_availability, $operating_room_description);
            $stmt->execute();
            break;        

        case 'update':
            $sql = "UPDATE operating_rooms SET operating_room_name=?, availability=?, operating_room_description=? WHERE operating_room_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $operating_room_name, $operating_room_availability, $operating_room_description, $operating_room_id);
            $stmt->execute();
        break;

        case 'delete':
            $sql = "DELETE FROM operating_rooms WHERE operating_room_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $operating_room_id);
            $stmt->execute();
            break;

        case 'search':
            $sql = "SELECT * FROM operating_rooms WHERE operating_room_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $operating_room_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $operating_room_id = $row['operating_room_id'];
                $operating_room_availability = $row['availability'];
                $operating_room_name = $row['operating_room_name'];
                $operating_room_description = $row['operating_room_description'];
            } else {
                echo "<div class='alert alert-warning'>No room found with the given ID</div>";
            }
            break;
    }
}
?>

<div class="container-fluid" >
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
                    <h2>Operating Room Management</h2>
                </section>

                <section>

                    <div class="row">

                        <div class="col-md-6">
                            
                            <form method="POST">

                                <div class="form-group">
                                    <label for="operating_room_id">Operating Room ID:</label>
                                    <input type="text" class="form-control" id="operating_room_id" name="operating_room_id" value="<?php echo $operating_room_id; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="operating_room_name">Operating Room Name:</label>
                                    <input type="text" class="form-control" id="operating_room_name" name="operating_room_name" value="<?php echo $operating_room_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="operating_room_availability">Operating Room Availability:</label>
                                    <input type="text" class="form-control" id="operating_room_availability" name="operating_room_availability" value="<?php echo $operating_room_availability; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="operating_room_description">Operating Room Discription:</label>
                                    <input type="text" class="form-control" id="operating_room_description" name="operating_room_description" value="<?php echo $operating_room_description; ?>">
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
                                $result = $conn->query("SELECT * FROM operating_rooms");

                                if ($result->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Operating Room ID</th>
                                                    <th>Operating Room Name</th>
                                                    <th>Operating Room Availability</th>
                                                    <th>Operating Room Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['operating_room_id']; ?></td>
                                                        <td><?php echo $row['operating_room_name']; ?></td>
                                                        <td><?php echo $row['availability']; ?></td>
                                                        <td><?php echo $row['operating_room_description']; ?></td>
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
    document.getElementById("operating_room_id").value = "";
    document.getElementById("operating_room_name").value = "";
    document.getElementById("operating_room_availability").value = "";
    document.getElementById("operating_room_description").value = "";
    document.getElementById("max_capacity").value = "";
}
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>