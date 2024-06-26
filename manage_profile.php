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

			<?php include('users/admin/manage_profile.php'); ?>

		<?php } elseif ($_SESSION ['user_type'] == 'staff') {?>
			
            <?php
                // Fetch the staff type and other details from the database
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM staff WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                $staff_id = $row['staff_id'];
                $staff_fname = $row['first_name'];
                $staff_lname = $row['last_name'];
                $staff_job = $row['job_title'];
                $gender = $row['gender'];
                $staff_pho = $row['phone_number'];
                $staff_email = $row['email'];
                $staff_avilable = $row['availability'];
                // Add other details you want to fetch

                if ($staff_job == 'Nurse') {
                    include('users/nurce/manage_profile.php');
                } elseif ($staff_job == 'Doctor') {
                    include('users/doctor/manage_profile.php');
                }
            ?>

		<?php } elseif ($_SESSION ['user_type'] == 'patient') {?>

				<?php 
				$user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM patients WHERE user_id = '$user_id'";
                $resul = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($resul);

                $patient_id = $row['patient_id'];
                $patient_fname = $row['first_name'];
                $patient_lname = $row['last_name'];
                $patient_bday = $row['date_of_birth'];
                $gender = $row['gender'];
                $patient_add = $row['address'];
                $patient_phone = $row['phone_number'];
                $patient_email = $row['email'];
                $patient_medical_h = $row['medical_history'];
				?>

			<?php include('users/paitent/manage_profile.php'); ?>
		
		<?php }?>
    </div>
</div>
</div>

<?php } else {

	header("Location: index.php");
}?>


<?php include('template-parts/dashbords/footer.php'); ?>