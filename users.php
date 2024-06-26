<?php include('template-parts/dashbords/header.php');?>
<?php
session_start();
include "connect.php";

if(isset($_SESSION['username']) && isset($_SESSION['user_id'])) 
	{ ?>

<div class="container-fluid">
    <div class="row main-section">

		<!-- If Admin Logged in  -->
		<?php if ($_SESSION ['user_type'] == 'admin') {?>

			<?php include('users/admin/users.php'); ?>
		
		<?php }else {?>
            <?php echo "<h2> Opps Wrog User type  <h2>"?>
        <?php } ?>
    </div>
</div>
</div>

<?php } else {

	header("Location: index.php");
}?>

<?php include('template-parts/dashbords/footer.php'); ?>