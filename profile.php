
<?php include "includes/functions.php"; ?>
<?php include "includes/functions.profile.php"; ?>
<?php include "includes/database.php"; ?>
<?php include "includes/db.php"; ?>
<?php

session_start();

?>

<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<div class="container">

	<div class="col s12 m6 l6">
		<div class="card white darken-1 hoverable">
			<div class="card-content black-text">
				<span class="card-title"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></span>
				<span class="right">Online sinds: <i><?php echo date("h:i:sa"); ?></i></span>

				<ul class="collapsible" data-collapsible="accordion">
					<li>
						<?php $countChannel = countTotalUsers($_SESSION['user_id'], $connection); ?>
						<div class="collapsible-header"><i class="material-icons">view_list</i>Openstaande Direct Messages (<?php echo $countChannel; ?>)</div>
						<div class="collapsible-body">
							<div class="listItem"><?php showExistingUsernames($_SESSION['user_id'], $connection)?></div>
						</div>
					</li>
				</ul>
				<div class="col s6" style="text-align: right;">
					<a style="margin: 0.82rem 0 0.656rem 0;"  class="waves-effect waves-light btn-floating hide-on-large-only <?php echo $core_colors['accent']; ?> modal-trigger modalButton2" data-target="modal2">
						<i class="material-icons left">edit</i>direct message aanmaken
					</a>
					<a style="margin: 0.82rem 0 0.656rem 0;" class="waves-effect hide-on-med-and-down hide-on-small-only waves-light btn <?php echo $core_colors['accent']; ?> modal-trigger modalButton2" data-target="modal2">
						<i class="material-icons left">edit</i>direct message aanmaken
					</a>
				</div>
				<div id="modal2" class="modal">
					<div class="modal-content">
						<h4>Maak een Direct Message</h4>
						<p><b>Selecteer een gebruiker</b></p>
						<?php showNonExistingUsernames($_SESSION['user_id'], $connection); ?>
						<br>
						
					</div>
				</div>
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
