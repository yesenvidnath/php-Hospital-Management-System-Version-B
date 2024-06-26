<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = '';
$user_id = '';
$username = '';
$password = '';
$user_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    switch ($action) {
        case 'insert':
            $sql = "INSERT INTO users (user_id, username, password, user_type) VALUES ('$user_id', '$username', '$password', '$user_type')";
            $conn->query($sql);
            break;

        case 'update':
            $sql = "UPDATE users SET username='$username', password='$password', user_type='$user_type' WHERE user_id='$user_id'";
            $conn->query($sql);
            break;

        case 'delete':
            $sql = "DELETE FROM users WHERE user_id='$user_id'";
            $conn->query($sql);
            break;

        case 'search':
            $sql = "SELECT * FROM users WHERE user_id='$user_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['username'];
                $password = $row['password'];
                $user_type = $row['user_type'];
            } else {
                echo "<div class='alert alert-warning'>No user found with the given ID</div>";
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
                    <h2>User Management</h2>
                </section>

                <section>

                    <div class="row">

                        <div class="col-md-6">
                            
                        <form method="POST">
                            <div class="form-group">
                                <label for="user_id">User ID:</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_type">User Type:</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="staff" <?php echo ($user_type == 'staff') ? 'selected' : ''; ?>>Staff</option>
                                    <option value="patient" <?php echo ($user_type == 'patient') ? 'selected' : ''; ?>>Patient</option>
                                    <option value="admin" <?php echo ($user_type == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                </select>
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
                                $result = $conn->query("SELECT * FROM users");

                                if ($result->num_rows > 0) {
                                ?>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>User Name</th>
                                                    <th>Password</th>
                                                    <th>User Types</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['user_id']; ?></td>
                                                        <td><?php echo $row['username']; ?></td>
                                                        <td><?php echo $row['password']; ?></td>
                                                        <td><?php echo $row['user_type']; ?></td>
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
    document.getElementById("user_id").value = "";
    document.getElementById("username").value = "";
    document.getElementById("password").value = "";
    document.getElementById("user_type").value = "";
}
</script>

<?php
  include('template-parts/dashbords/footer.php');
?>