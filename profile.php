<?php

session_start();

$core_title_prefix = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];

if(isset($_POST['theme_id'])) {
	if(is_numeric($_POST['theme_id'])){
		setUserTheme($_SESSION['user_id'], $_POST['theme_id'], $xo);
		header("Location: " . BASE_URL . "profiel");
		exit();
	}
}


?>
<?php include "includes/header.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/functions.profile.php"; ?>
<?php include "includes/database.php"; ?>
<?php include "includes/db.php"; ?>
<?php
setSession($_SESSION['user_id'], $_SESSION['username'],$_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['email'], $_SESSION['status']);


?>

<div class="container">

	<div class="col s12 m6 l6">
		<div class="card white darken-1 hoverable">
			<div class="card-content black-text">
				<span class="card-title"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></span>
				<span class="right">Online sinds: <i><?php echo date("h:i:sa"); ?></i></span>

				<ul class="collapsible" data-collapsible="accordion">
					<li>
						<?php $countChannel = countTotalUsers($_SESSION['user_id'], $connection); ?>
						<div class="collapsible-header"><i class="material-icons">view_list</i>Gebruikers (<?php echo $countChannel; ?>)</div>
						<div class="collapsible-body">
							<div class="listItem"><?php showUsernames($_SESSION['user_id'], $connection)?></div>
						</div>
					</li>
				</div>
			</div>
		</div>

	</div>

	<?php include "includes/footer.php";?>

	<script>
		$(document).ready(function() {
			$(".theme_item").on("click", function(e) {
				$('#themeInput').val($(this).attr('data-theme'));
				$('#formTheme').submit();
			});
			$('.dropdown-theme').dropdown({
				constrain_width: false,
			}
			);
		});
	</script>
