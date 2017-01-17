
<?php include "includes/functions.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "config.php"; ?>
<?php //include "common.php"; ?>

<?php session_start(); ?>

<?php
	// check is user is already logged in, else redirct to login page
    if (!isset($_SESSION['user_id']))
    {
        header("Location: index.php");
    }
?>

<?php
	$groupsArray = getChannelGroups();
	$user_perm = getUserPermission($_SESSION['user_id']);

	$error_color = "green";
	$errors = "";

	/*
	 * Subscribe to private group
	 */
	if(isset($_POST['joinPrivateGroup']))
	{
		if(isset($_POST['password']))
		{
			$grid = escapeString($_POST['groupID']); // save sent groupid
			$submittedPwd = escapeString($_POST['password']); // save sent password

			$groupData = getPrivateGroup($grid);
			$password = $groupData['group_password'];
			$gid = $groupData['group_id'];
			$groupRights = 1;
			$subbed = subscribedGroup($_SESSION['user_id'], $gid);
			$verifyHashpassword = verifyPassword($submittedPwd, $password);

			if($verifyHashpassword == true)
			{ // if passwords are equal
				if($subbed == false)
				{
					signupPrivateGroup($gid, $_SESSION['user_id'], $groupRights);
					$errors .= "U bent succesvol aangemeld voor deze groep!";
				}
				else
				{
					$errors .= "U heeft zich al aangemeld voor deze groep!";
					$error_color = "red";
				}
			}
			else
			{
        		echo $verifyHashpassword;
				$errors .= "Wachtwoord is onjuist!";
				$error_color = "red";
			}

		}
	}

	/**
	 * Subscribe to public group
	 */
	if(isset($_POST['joinOpenGroup']))
	{
		// Execute signup functions
		$grid = escapeString($_POST['groupIDPublic']); // save sent groupid
		//$groupData = getPublicGroup($grid);
		//$gid = $groupData['group_id'];
		$groupRights = 1;
		$subbed = subscribedGroup($_SESSION['user_id'], $grid);

		if($subbed == false)
		{
			signupPrivateGroup($grid, $_SESSION['user_id'], $groupRights);
			$errors .= "U bent succesvol aangemeld voor deze groep!";
		}
		else
		{
			$errors .= "U heeft zich al aangemeld voor deze groep!";
			$error_color = "red";
		}
	}

	/*
	 * Unsubscribe to a group
	 */
	if(isset($_POST['unsubGroup']))
	{
		// Run the unsub query/function in here
		$grid = escapeString($_POST['groupIDUnsub']); // save sent groupid
		unsubscribeGroup($_SESSION['user_id'], $grid);
		header("Location: groepen.php");
		exit();
	}

	/*
	 * Create new group
	 */
	if(isset($_POST['submitNewGroup']))
	{
		if(!empty($_POST['groupName']) && !empty($_POST['groupDescription']) && !empty($_POST['groupPassword']))
		{
			$groupName = escapeString($_POST['groupName']);
			$groupDescription = escapeString($_POST['groupDescription']);
			$groupPassword = escapeString($_POST['groupPassword']);

			$hashpassword = generateHash($groupPassword);

			if (groupnameExists($groupName))
			{
				$errors .= "Groepsnaam bestaat al!";
				$error_color = "red";
			} 
			else
			{
				createGroup($groupName, $groupDescription, $hashpassword);

				header("Location: groepen.php");
			}			
		}
		elseif(!empty($_POST['groupName']) && !empty($_POST['groupDescription']) && empty($_POST['groupPassword']))
		{
			$groupName = escapeString($_POST['groupName']);
			$groupDescription = escapeString($_POST['groupDescription']);
			$groupPassword = escapeString($_POST['groupPassword']);

			$hashpassword = generateHash($groupPassword);

			createGroup($groupName, $groupDescription);

			header("Location: groepen.php");
		}
		else
		{
			$errors .= "Groepsnaam en omschrijving zijn verplicht!";
			$error_color = "red";
		}
	}

	/*
	 * Delete group as admin
	 */
	if(isset($_POST['deleteGroup']) == 'emptyPassword')
	{
		$grid = escapeString($_POST['groupIDDelete']); // save sent groupid
		deleteGroup($grid);

		header("Location: groepen.php");

		//header("Location: " . BASE_URL . "kanaal/" . $channel_id);
	}
?>
	<?php include "includes/header.php"; ?>
	<?php include "includes/navbar.php"; ?>

	<div class="container">
		<?php if($errors != ""): ?>
		<div class="row errorRow">
			<div class="col s3">&nbsp;</div>
			<div class="col s6 center-align">
				<div class="card white <?php echo $error_color; ?>-text text-darken-2 errorCard" style="padding: 16px 0;">
					<?php echo $errors; ?>
				</div>
			</div>
			<div class="col s3">&nbsp;</div>
		</div>
		<?php endif; ?>

		<div class="row">
			<div class="col s12">
				<div class="row">
					<div class="col s12 pageHeadColumn">
						<div class="row">
							<div class="col s6">
								<h5>Chats</h5>
							</div>
							<?php if($user_perm == 1) { ?>
							<div class="col s6" style="text-align: right;">
								<a style="margin: 0.82rem 0 0.656rem 0;"  class="waves-effect waves-light btn-floating hide-on-large-only <?php echo $core_colors['accent']; ?> modal-trigger modalButton2" data-target="modal2">
									<i class="material-icons left">edit</i>Groep aanmaken
								</a>
								<a style="margin: 0.82rem 0 0.656rem 0;"  class="waves-effect hide-on-med-and-down hide-on-small-only waves-light btn <?php echo $core_colors['accent']; ?> modal-trigger modalButton2" data-target="modal2">
									<i class="material-icons left"></i>Groep aanmaken
								</a>
							</div>
							<?php } ?>
						</div>
					</div>

					<?php foreach((array)$groupsArray as $key => $groups): ?>
						<?php $subscribed = subscribedGroup($_SESSION['user_id'], $groups['group_id']); ?>
						<div class="col s12 m6 l6">
						<?php if ($groups != false) { ?>
							<div class="card white darken-1 hoverable">
								<div class="card-content black-text" style="height: 200px;">
									<span class="card-title truncate"><?php echo $groups['group_name']; ?></span>
									<?php if($user_perm == 1) { ?>
										<i class="small material-icons right-align modalDeleteButton clickableDiv tooltipped" data-position="top" data-tooltip="Klik hier om de groep te verwijderen" style="float: right;" data-deletegroupid="<?php echo $groups['group_id']; ?>">delete</i>
									<?php } ?>

									<i class="small material-icons right-align tooltipped" data-position="top" data-tooltip="Gesloten groep" style="float: right;"><?php echo $groups['group_password'] === "" ? '' : 'lock_outline'; ?></i>

									<p><?php echo $groups['group_description']; ?></p>

								</div>
								<div class="card-action">
									<?php
									if($subscribed == false)
									{
										echo $groups['group_password'] === "" ? '<button class="btn ' . $core_colors['main'] . ' modal-trigger modalButtonPublic" data-target="modalPublic" data-publicid="' . $groups['group_id'] . '">Aansluiten</button>'
											: '<button class="btn ' . $core_colors['main'] . ' modal-trigger modalButton" data-target="modal1" data-groupid="' . $groups['group_id'] . '">Aansluiten</button>';
									}
									else
									{
										echo '<a class="waves-effect waves-light btn" href="groep/' . $groups['group_id'] . '">Openen</a>';
										echo '<a style="color: #F44336; font-weight: bold;" class="card-title unsub modalUnsubButton clickableDiv ' . $core_colors['accent'] . '-text" data-target="modalUnsub" data-unsubid="' . $groups['group_id'] . '">Afmelden</a>';
									}
									?>
								</div>
							</div>
							<?php }
							else
							{ ?>
								<div class="row errorRow">
									<div class="col s12">&nbsp;</div>
										<div class="col s12 center-align">
											<div class="card white <?php echo $error_color; ?>-text text-darken-2" style="padding: 16px 0;">
												Er zijn nog geen groepen aagemaakt!
											</div>
										</div>
									<div class="col s12">&nbsp;</div>
								</div>
							<?php } ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Create group -->
<div id="modal2" class="modal">
	  <div class="modal-content">
	    <h4>Maak een groep</h4>
		<p>Voer de benodidge gegevens in</p>
		<div class="form-data">
			<form method="post" id="form2" action="groepen.php">
				<input type="text" id="groupName" name="groupName" placeholder="Vul groep naam in"/>
				<input type="text" id="groupDescription" name="groupDescription" length="190" placeholder="Vul groep omschrijving in"/>
				<input type="password" id="groupPassword" name="groupPassword" placeholder="Vul groep wachtwoord in"/>
			</form>
		</div>
		<br><div class="modal-footer">
			<button class="btn waves-effect waves-light <?php echo $core_colors['accent']; ?>" data-dismiss="modal2" form="form2" type="submit" name="submitNewGroup">Aanmaken

			<i class="material-icons right">send</i>
			</button>
		</div>
	</div>
</div>

<!-- Modal Join private group -->
<div id="modal1" class="modal">
	  <div class="modal-content">
	    <h4>Aansluiten Groep</h4>
		<p>Dit is een prive groep. Vul het wachtwoord in om u aan te sluiten.</p>
		<div class="form-data">
				<form method="post" id="form1">
					<input type="password" id="groupPwd" name="password" placeholder="Vul groep wachtwoord in"/>
					<input type="hidden" id="groupValue" name="groupID" value="0"/>
				</form>
		</div>
		<br><div class="modal-footer">
			<button class="btn <?php echo $core_colors['main']; ?> colo waves-effect waves-light" data-dismiss="modal1" form="form1" type="submit" name="joinPrivateGroup">Aanmelden
		    <i class="material-icons right">send</i>
		  </button>
		</div>
	</div>
</div>

<!-- Modal Join public group -->
<div id="modalPublic" class="modal">
	  <div class="modal-content">
	    <h4>Aansluiten Groep</h4>
		<p>Dit is een open groep. Om u aan te melden, klik dan op de aanmeld knop hier beneden.</p>
		<div class="form-data">
			<form method="post" id="form3">
				<input type="hidden" id="groupValuePublic" name="groupIDPublic" value="0"/>
			</form>
		</div>
		<br><div class="modal-footer">
			<button class="btn <?php echo $core_colors['main']; ?> waves-effect waves-light" data-dismiss="modalPublic" form="form3" type="submit" name="joinOpenGroup">Aanmelden
		    <i class="material-icons right">send</i>
		  </button>
		</div>
	</div>
</div>

<!-- Modal delete group -->
<div id="modalDelete" class="modal">
	  <div class="modal-content">
	    <h4>Groep verwijderen</h4>
		<p>Weet u zeker dat u deze groep wilt verwijderen?</p>
		<div class="form-data">
			<form method="post" id="form4">
				<input type="hidden" id="groupDelete" name="groupIDDelete" value="0"/>
			</form>
		</div>
		<br><div class="modal-footer">
			<button class="btn <?php echo $core_colors['accent']; ?> waves-effect waves-light" data-dismiss="modalDelete" form="form4" type="submit" name="deleteGroup">Verwijderen
		    <i class="material-icons right">send</i>
		  </button>
		</div>
	</div>
</div>

<!-- Modal unsubscribe group -->
<div id="modalUnsub" class="modal">
	  <div class="modal-content">
	    <h4>Groep afmelden</h4>
		<p>Weet u zeker dat u zich wilt afmelden?</p>
		<div class="form-data">
			<form method="post" id="form5">
				<input type="hidden" id="groupUnsub" name="groupIDUnsub" value="0"/>
			</form>
		</div>
		<br><div class="modal-footer">
			<button class="btn <?php echo $core_colors['accent']; ?> waves-effect waves-light" data-dismiss="modalUnsub" form="form5" type="submit" name="unsubGroup">Afmelden
		    <i class="material-icons right">send</i>
		  </button>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$(".modalButton").on("click", function(e) {
		$('#modal1').openModal();
		$('#groupValue').val($(this).attr('data-groupid'));
		// Make password field empty
		$('.modal-content').find("input[type=password]").val("");
	});

	$(".modalButtonPublic").on("click", function(e) {
		$('#modalPublic').openModal();
		$('#groupValuePublic').val($(this).attr('data-publicid'));
	});

	$(".modalButton2").on("click", function(e) {
		$('#modal2').openModal();
	});

	$(".modalDeleteButton").on("click", function(e) {
		$('#modalDelete').openModal();
		$('#groupDelete').val($(this).attr('data-deletegroupid'));
	})

	$(".modalUnsubButton").on("click", function(e) {
		$('#modalUnsub').openModal();
		$('#groupUnsub').val($(this).attr('data-unsubid'));
	})

	$(".modalEditButton").on("click", function(e) {
		$('#modalEdit').openModal();
		$('#channelEdit').val($(this).attr('data-editchannelid'));
	})

	$('.tooltipped').tooltip({delay: 500});
});
</script>

<?php include "includes/footer.php"; ?>
