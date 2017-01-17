<?php

	// Check if user is allowed to view this group
	$user_perm = getUserPermission($core_user_item['user_id'], $group_id, $core_db_link);
	if($user_perm === false) {
		header("Location: " . BASE_URL . "dashboard");
		exit();
	}
	$groupMembersArray = getAllSubscribersFromGroup($group_id, $core_db_link);
	$groupMemberCount = count($groupMembersArray);
	$usernamesArray = getUsernames($group_id, $core_db_link);

	$group_item = getSingleGroup($group_id, $core_db_link);
	$userRights = getUserPermission($core_user_item['user_id'], $group_id, $core_db_link);

	$error_color = "green";
	$errors = "";

	/*
	 * Edit Group
	 */
	if(isset($_POST['editGroup']))
	{
		if(isset($_POST['groupName']) && isset($_POST['groupDescription']))
		{
			if($userRights != false && $userRights <= 2) {
				$grid = escapeString($_POST['groupIDEdit'], $core_db_link);

				$groupName = escapeString($_POST['groupName'], $core_db_link);
				$groupDescription = escapeString($_POST['groupDescription'], $core_db_link);
				$groupPassword = escapeString($_POST['groupPassword'], $core_db_link);
				$groupPasswordCheck = escapeString($_POST['groupPasswordCheck'], $core_db_link);

				if($groupPassword == $groupPasswordCheck)
				{
					editGroup($grid, $groupName, $groupDescription, $groupPassword, $core_db_link);

					$errors .= "U heeft de groep succesvol gewijzigd!";
				}
				else
				{
					$errors .= "Wachtwoorden komen niet overeen!";
					$error_color = "red";
				}

				if(isset($_POST['checkPassword']) && isset($_POST['checkPassword']) == "emptyPassword")
				{
					editGroupPassword($grid, $core_db_link);
				}
			}
			else {
				echo "U heeft geen rechten tot deze actie!";
				die();
			}
		}
	}
	$core_back_link = "kanaal/" . $group_item['channel_id'];
	$core_title_prefix = $group_item['group_name'];

	include(T_ROOT . "page-elements/header.php");?>
	<style>
		#contentContainer {
			height: 100%;
		}
	</style>
	<div class="container" style="height: 100%;">

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

		<div class="row" style="height: 100%; margin-bottom: 0;">
			<div class="col s12 m12 l7" style="overflow-y: scroll; height: 100%;">
				<div class="row">
					<div class="col s12 pageHeadColumn">
						<div class="row">
							<div class="col s6">
								<h5>Blokken</h5>
							</div>
							<div class="col s6" style="text-align: right;">
								<?php
									if($userRights != false && $userRights <= 2) {
										echo '<a style="margin: 0.82rem 0 0.656rem 0;" href="' . BASE_URL . 'blok/toevoegen/' . $group_id . '" class="hide-on-large-only waves-effect waves-light btn-floating ' . $core_colors['accent'] . ' modal-trigger modalButton2">';
										echo '<i class="material-icons left">add</i>Blok aanmaken';
										echo '</a>';
										echo '<a style="margin: 0.82rem 0 0.656rem 0;" href="' . BASE_URL . 'blok/toevoegen/' . $group_id . '" class="waves-effect waves-light hide-on-med-and-down btn ' . $core_colors['accent'] . 'modal-trigger modalButton2">';
										echo '<i class="material-icons left">add</i>Blok aanmaken';
										echo '</a>';
									}
								?>
							</div>
						</div>
					</div>
					<div class="col s12">
						<?php
							if($block_array != false) {
								echo '<ul class="collection" id="blockList">';
								foreach($block_array as $key=>$block){
									$user_item = getUser($block['last_edit_user'], "", $core_db_link); ?>
									<li class="collection-item avatar blockListItem">
										<a class="blockListItemLink" href="<?php echo BASE_URL . "blok/" . $block['block_id'] ?>">
											<i class="material-icons circle">folder</i>
											<span class="title black-text" style="font-weight:bold;"><?php echo $block["block_name"] ?></span>
											<p class="grey-text text-darken-2">Laatst bewerkt door: <?php echo $user_item['user_firstname'] . " " . $user_item['user_lastname']; ?></p>
											<?php
												$uploads = getAllUploads($block['block_id'], $core_db_link);
												if(count($uploads) > 0) {
													echo '<a href="#!" class="secondary-content ' . $core_colors['accent'] . '-text">';
													echo '<i style="vertical-align: bottom;display: inline-block;" class="material-icons">attach_file</i>';
													echo '<div class="blockListItemGrade">' . count($uploads) . '</div>';
													echo '</a>';
												}
											?>
										</a>
									</li>
								<?php
								}
								echo '</ul>';
							}
							else {
								echo '<div class="col s12 center-align">';
								echo '<div class="card white black-text text-darken-2 errorCard" style="padding: 16px 0;">';
								echo 'Er zijn (nog) geen blokken aangemaakt in deze groep.';
								echo '</div>';
								echo '</div>';
							}
						?>
					</div>
				</div>
			</div>
			<div class="col s12 m12 l5" id="chatMainContainer">
				<div class="row" style="margin-bottom: 0;">
					<div class="col s12 pageHeadColumn">
						<div class="row">
							<div class="col s6">
								<h5>Chat</h5>
							</div>
							<div class="col s6" style="text-align: right;">
								<a class="rightwaves-effect waves-light btn-floating hide-on-large-only modal-trigger <?php echo $core_colors['accent']; ?>" href="#modal1" style="margin: 0.82rem 0 0.656rem 0;">
									<i class="material-icons" style="vertical-align: bottom;">info_outline</i> Groeps informatie
								</a>
								<a class="rightwaves-effect waves-light hide-on-med-and-down hide-on-small-only btn modal-trigger <?php echo $core_colors['accent']; ?>" href="#modal1" style="margin: 0.82rem 0 0.656rem 0;">
									<i class="material-icons" style="vertical-align: bottom;">info_outline</i> Groeps informatie
								</a>
							</div>
						</div>
					</div>
				</div>
				<div id="modal1" class="modal bottom-sheet">
					<div class="modal-content">
						<div class="row">
							<div class="col s6 left-align">
								<h4>Deelnemers</h4>
							</div>
							<div class="col s6 right-align">
								<?php
									if($userRights != false && $userRights <= 2) {
										echo '<a class="waves-effect hide-on-large-only waves-light btn-floating ' . $core_colors['accent'] . ' modal-trigger modalEditButton" data-target="modalEdit" data-editgroupid="' . $group_id . '"><i class="material-icons left">edit</i>Aanpassen</a>';
										echo '<a class="waves-effect waves-light btn ' . $core_colors['accent'] . ' modal-trigger modalEditButton hide-on-med-and-down hide-on-small-only" data-target="modalEdit" data-editgroupid="' . $group_id . '"><i class="material-icons left">edit</i>Aanpassen</a>';
										echo '<a style="margin-left: 16px;" href="' . BASE_URL . 'groep-rechten/' . $group_id . '" class="hide-on-med-and-down waves-effect waves-light btn ' . $core_colors['accent'] . '"><i class="material-icons right">edit</i>Rechten aanpassen</a>';
										echo '<a style="margin-left: 16px;" href="' . BASE_URL . 'groep-rechten/' . $group_id . '" class="hide-on-large-only waves-effect waves-light btn ' . $core_colors['accent'] . '"><i class="material-icons right">edit</i>Rechten aanpassen</a>';
									}
									if($userRights == true)
									{
										echo '<a class="waves-effect hide-on-large-only waves-light btn-floating ' . $core_colors['accent'] . ' modal-trigger modalEditButton" data-target="modalEdit" data-editgroupid="' . $group_id . '">
												<i class="material-icons left">edit</i>Aanpassen</a>
										<a class="waves-effect waves-light btn ' . $core_colors['accent'] . ' modal-trigger modalEditButton hide-on-med-and-down hide-on-small-only" data-target="modalEdit" data-editgroupid="' . $group_id . '">
												<i class="material-icons left">edit</i>Aanpassen</a>';
									}
								?>

								<button style="margin-left: 16px;" id="closeModalButton" class="hide-on-med-and-down waves-effect waves-light btn <?php echo $core_colors['accent']; ?>"><i class="material-icons right">close</i>Sluiten</button>
								<button style="margin-left: 16px;" id="closeModalButton" class="hide-on-large-only waves-effect waves-light btn-floating <?php echo $core_colors['accent']; ?>"><i class="material-icons right">close</i>Sluiten</button>
							</div>

						</div>
						<div class="col 12">
							<?php
								if($groupMemberCount > 0) {
									echo '<div class="italic bold">Aantal deelnemers: ' . $groupMemberCount . '</div>';
									echo '<ul class="collection">';
									foreach ($groupMembersArray as $key=>$member){
										echo '<li class="collection-item">' . $member["user_firstname"] . " " . $member["user_lastname"] . '</li>';
									}
									echo '</ul>';
								}
								else {
									echo '<div class="italic">Deze groep heeft nog geen deelnemers!</div>';
								}
							?>
						</div>
					</div>
				</div>
				<div id="chatHistoryContainer">
				</div>
				<div id="chatSendContainer" style="position: absolute; bottom: 0px; left: 0px; width: 100%; box-sizing: border-box; margin-bottom: 16px;">

					<form name="addMessage" method="post" action="chat.php">
						<div class="row" style="margin: 0;">
							<div class="valign-wrapper">
								<ul class="collapsible subscribers" data-collapsible="accordion">
							  	</ul>
								<div class="input-field col s10">
								  <textarea class="materialize-textarea" id="chatTextarea" rows="4" name="message" style="min-height: 3em; height: 3em; border: 1px solid #e0e0e0; padding: 8px; background-color: #ffffff; margin: 0; max-height: 10em; border-radius: 5px;" placeholder="Typ hier..."></textarea>
								</div>
								<div class="col s2">
									<div id="chatSendButton" class="clickableDiv" name="submit" style="padding: 8px; border-radius: 50%; width: 60px; height: 60px; margin-top: 5px; float: right; border: 1px solid #e0e0e0; text-align: center;background-color: #ffffff;">
										<i class="valign material-icons <?php echo $core_colors['accent']; ?>-text" style="font-size: 30px; line-height: 46px;">message</i>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Edit group info -->
	<div id="modalEdit" class="modal">
		  <div class="modal-content">
		    <h4>Pas hier de groep aan</h4>
			<p>Voer de benodidge gegevens in</p>
			<div class="form-data">
				<form method="post" id="form1" action="<?php echo BASE_URL . "groep/" . $group_id?>">
					<input type="text" id="groupName" name="groupName" value="<?php echo $group_item['group_name']; ?>" placeholder="Vul groep naam in"/>
					<input type="text" id="groupDescription" name="groupDescription" value="<?php echo $group_item['group_description']; ?>" length="190" placeholder="Vul groep omschrijving in"/>
					<input type="password" id="groupPassword" name="groupPassword" placeholder="Vul channel wachtwoord in"/>
					<input type="password" id="groupPasswordCheck" name="groupPasswordCheck" placeholder="Herhaal uw wachtwoord in"/>
					<input type="hidden" id="groupEdit" name="groupIDEdit" value="0"/>
				</form>
			</div>
			<div class="modal-footer">
			<br>
				<button class="btn <?php echo $core_colors['main']; ?> waves-effect waves-light" data-dismiss="modalEdit" form="form1" type="submit" name="editGroup">Wijzigen
					<i class="material-icons right">send</i>
				</button>
				<input type="checkbox" name="checkPassword" value="emptyPassword" class="left filled-in" id="filled-in-box" form="form1" />
	  			<label for="filled-in-box">Wachtwoord verwijderen</label>
			</div>
		</div>
	</div>

	<script>
		var this_user = "<?php echo $core_user_item['user_id']; ?>";
		$(document).ready(function(){

			$(".modalEditButton").on("click", function(e) {
				$('#modalEdit').openModal();
				$('#groupEdit').val($(this).attr('data-editgroupid'));
			})

			$(".subscribers").empty();

			$('#chatSendButton').click(function(event) {
				sendChatMessage();
				event.preventDefault();
			});
			$('#chatTextarea').keydown(function(e) {
				if(e.keyCode == 13 && $(this).val().split("\n").length >= $(this).attr('rows')) {
					return false;
				}
				$('#chatMainContainer').css('padding-bottom', $('#chatSendContainer').outerHeight(true) + 'px');
				var scrollToPos = document.getElementById("chatHistoryContainer").scrollHeight;
			});

			$('.subscribers li').on("click", function(){
				console.log("testnu");
			});

			$('#chatTextarea').bind('input propertychange', function() {
			 	if(this.value.indexOf("@") > -1)
			 	{
			 		$(".subscribers").empty();
			 		loadSubscribers();
			 	}
			 	else
			 	{
			 		$(".subscribers").empty();
			 	}
			});



			loadAjax();
			setInterval(function()
			{
				loadAjax();
			}, 2000);
			$('#closeModalButton').click(function() {
				$('#modal1').closeModal();
			});
		});

		function sendChatMessage() {
			var newMessage = $('#chatTextarea').val();
			if (newMessage == '')
			{
				alert("Je kan geen leeg bericht sturen");
			}
			else
			{
				$.ajax({
					url: '<?php echo BASE_URL; ?>api/addmessage',
					type: 'POST',
					data: {
						"message": newMessage,
						"submit": "true",
						"group_id": "<?php echo $group_id; ?>",
					},
					success: function (data) {
						$('#chatTextarea').val('');
						loadAjax();
					}
				});
			}
		}

		function nl2br (str, is_xhtml) {
			var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
			return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
		}

		function loadSubscribers()
		{
			var url = "api/getSubscribers";

			$.ajax({
				url:'<?php echo BASE_URL; ?>' + url,
				type:'GET',
				data:{"group_id": "<?php echo $group_id; ?>"},
				success : function(data){
					$(".subscribers").append(data).show("fadeIn");
				}
			});
		}

		function loadAjax()
		{
			var url = "api/getchat";
			$.ajax({
				url: '<?php echo BASE_URL; ?>' + url,
				type: 'GET',
				data: { "group_id": "<?php echo $group_id; ?>" },
				success: function (data) {
					console.log(data);
					if(data == "empty") {
						var no_chat_msg = '<div class="col s12 center-align"><div class="card white black-text text-darken-2 errorCard" style="padding: 16px 0;">Er zijn nog geen berichten in deze chat groep, zeg eens hallo!</div></div></div>';
						document.getElementById('chatHistoryContainer').innerHTML = no_chat_msg;
					}
					else {
						loadData(data);
					}
				},
			});
		}

		function loadData(response)
		{
			var items = JSON.parse(response);
			var i;
			var output = '';

			for(i = 0; i < items.length; i++)
			{
				var extra_class = '';
				if(this_user == items[i].user_id) {
					extra_class = 'Right';
				}
				var username = items[i].user_firstname + ' ' + items[i].user_lastname;
				var chattime = items[i].format_time;
				var chatdate = items[i].format_date;
				var chatmessage = nl2br(items[i].chat_message, true);
				var color = items[i].color;
				output += '<div class="chatHistoryRow' + extra_class + '"><div class="chatHistoryBalloon black-text white"><span class="' + color + '">' + username + '</span></br>' + chatmessage + '</div><div class="chatRowDateContainer"><div class="chatRowTime">' + chattime + '</div><div class="chatRowDate">' + chatdate + '</div></div></div>';
			}
			document.getElementById('chatHistoryContainer').innerHTML = output;
			$('#chatHistoryContainer').animate({scrollTop: $('#chatHistoryContainer').prop("scrollHeight")}, 300);
		}
	</script>
<?php include(T_ROOT . "page-elements/footer.php");?>
