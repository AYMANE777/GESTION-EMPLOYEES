<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }

if(!isset($_GET['message-id']))
{
    echo '<script>location.replace("mes-messages")</script>';
}else{
    $messageID = secureData($_GET['message-id']);
}

if(!checkMessageID($messageID, $user->getMatricule()))
{
    echo '<script>location.replace("mes-messages")</script>';
}
$matricule = $user->getMatricule();
$QueryGetMessage = mysqli_query($connect, "SELECT subject, content, date_sent, sender_id, receiver_id 
FROM messages
WHERE message_id='$messageID'");
$message = mysqli_fetch_assoc($QueryGetMessage);

if($message['receiver_id'] == $matricule || $message['sender_id'] == $matricule)
{
    if($message['receiver_id'] == $matricule)
	{
		$receiver_id = $message['sender_id'];
		$QueryGetSender = mysqli_query($connect, "SELECT * FROM formateurs WHERE matricule='$receiver_id'");
		$formateur = mysqli_fetch_assoc($QueryGetSender);
		$sender_name = $formateur['prenom'] . " " . $formateur['nom'];
		$receiver_name = "moi";
	}else if($message['sender_id'] == $matricule)
	{
		$receiver_id = $message['receiver_id'];
		$QueryGetSender = mysqli_query($connect, "SELECT * FROM formateurs WHERE matricule='$receiver_id'");
		$formateur = mysqli_fetch_assoc($QueryGetSender);
		$sender_name = $user->getPrenom() . " ". $user->getNom();
		$receiver_name = $formateur['prenom'] . " " . $formateur['nom'];
	}
}else{
	echo '<script>location.replace("mes-messages")</script>';
}

if(!checkMessageRead($messageID))
{
	$QueryUpdate = mysqli_query($connect, "UPDATE messages SET isRead=1 WHERE message_id='$messageID'");
	if($QueryUpdate)
	{
		echo '';
	}else{
		echo $connect->error;
	}
}

$_SESSION['message-id'] = $messageID;
?>
<div id="kt_content_container" class="container-fluid">
							<div class="d-flex flex-column flex-lg-row">
								<!--begin::Sidebar-->
								<?php require_once("../includes/sidebars/messages-sidebar.php"); ?>
								<!--end::Sidebar-->
								<!--begin::Content-->
								<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
									<!--begin::Card-->
									<div class="card">
										<div class="card-header align-items-center py-5 gap-5">
											<!--begin::Actions-->
											<div class="d-flex">
												<!--begin::Back-->
												<a href="mes-messages" class="btn btn-sm btn-icon btn-clear btn-active-light-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Retour">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
													<span class="svg-icon svg-icon-1 m-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black"></rect>
															<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black"></path>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</a>
												<!--end::Back-->
												
											</div>
											<!--end::Actions-->
										</div>
										<div class="card-body">
											<div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
												<div class="d-flex align-items-center flex-wrap gap-2">
													<h2 class="fw-bold me-3 my-1"><?php echo $message['subject']; ?></h2>
													<span class="badge badge-light-primary my-1 me-2">inbox</span>
												</div>
											</div>
											<!--end::Title-->
											<!--begin::Message accordion-->
											<div data-kt-inbox-message="message_wrapper">
												<!--begin::Message header-->
												<div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
													<!--begin::Author-->
													<div class="d-flex align-items-center">
														<!--begin::Avatar-->
														<div class="symbol symbol-35px me-3">
                                                            <div class="symbol-label bg-light-danger">
                                                                <span class="text-danger"><?php echo substr($sender_name, 0, 1); ?></span>
                                                            </div>
                                                        </div>
														<!--end::Avatar-->
														<div class="pe-5">
															<!--begin::Author details-->
															<div class="d-flex align-items-center flex-wrap gap-1">
																<a href="#" class="fw-bolder text-dark text-hover-primary"><?php echo $sender_name; ?></a>
																<!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
																<span class="svg-icon svg-icon-7 svg-icon-success mx-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<circle fill="#000000" cx="12" cy="12" r="8"></circle>
																	</svg>
																</span>
																<!--end::Svg Icon-->
																<span class="text-muted fw-bolder"><?php echo format_time_ago($message['date_sent']); ?></span>
															</div>
															<!--end::Author details-->
															<!--begin::Message details-->
															<div data-kt-inbox-message="details">
																<span class="text-muted fw-bold">À <?php echo $receiver_name; ?></span>
																<!--begin::Menu toggle-->
																<a href="#" class="me-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
																	<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
																	<span class="svg-icon svg-icon-5 m-0">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black"></path>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</a>
																<!--end::Menu toggle-->
																<!--begin::Menu-->
																<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-300px p-4" data-kt-menu="true">
																	<!--begin::Table-->
																	<table class="table mb-0">
																		<tbody>
																			<!--begin::From-->
																			<tr>
																				<td class="w-75px text-muted">À partir de</td>
																				<td><?php echo $sender_name; ?></td>
																			</tr>
																			<!--end::From-->
																			<!--begin::Date-->
																			<tr>
																				<td class="text-muted">Date</td>
																				<td><?php echo (strftime($message['date_sent']));  ?></td>
																			</tr>
																			<!--end::Date-->
																			<!--begin::Subject-->
																			<tr>
																				<td class="text-muted">Sujet</td>
																				<td><?php echo $message['subject']?></td>
																			</tr>
																			<!--end::Subject-->

																		</tbody>
																	</table>
																	<!--end::Table-->
																</div>
																<!--end::Menu-->
															</div>
															<!--end::Message details-->
															<!--begin::Preview message-->
															<!--end::Preview message-->
														</div>
													</div>
													<!--end::Author-->
													<!--begin::Actions-->
													<div class="d-flex align-items-center flex-wrap gap-2">
														<!--begin::Date-->
														<span class="fw-bold text-muted text-end me-3"><?php echo dateToFrench($message['date_sent'], "l j F Y H:i");?> (<?php echo format_time_ago($message['date_sent']); ?>)</span>
														<!--end::Date-->
														<div class="d-flex">

															<!--begin::Reply-->
															<a href="#" id="focusReply" class="btn btn-sm btn-icon btn-clear btn-active-light-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Réponse">
																<!--begin::Svg Icon | path: icons/duotune/general/gen055.svg-->
																<span class="svg-icon svg-icon-2 m-0">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"></path>
																		<path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"></path>
																		<path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"></path>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<!--end::Reply-->
														</div>
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Message header-->
												<!--begin::Message content-->
												<div class="collapse fade show" data-kt-inbox-message="message">
													<div id="content" class="py-5">
													<?php echo htmlspecialchars_decode($message['content']);?>
													</div>
												</div>
												<!--end::Message content-->
												
											</div>
											<div class="separator my-6"></div>
											<?php
												$QueryGetReplies = mysqli_query($connect, "SELECT sender_id, reply, reply_date FROM replies WHERE message_id='$messageID'");
												if(mysqli_num_rows($QueryGetReplies) > 0)
												{
													while($reply = mysqli_fetch_assoc($QueryGetReplies))
													{
														if($reply['sender_id'] == $matricule)
														{
															$reply_sender = $user->getPrenom() . " " . $user->getNom();
														}else{
															$reply_sender_id = $reply['sender_id'];
															$QueryGetReplier = mysqli_query($connect, "SELECT * FROM formateurs WHERE matricule='$reply_sender_id'");
															$formateur = mysqli_fetch_assoc($QueryGetReplier);
															$reply_sender = $formateur['prenom'] . " " . $formateur['nom'];
														}
														
														echo '<div data-kt-inbox-message="message_wrapper">
														<div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
															<div class="d-flex align-items-center">
																<div class="symbol symbol-35px me-3">
                                                            		<div class="symbol-label bg-light-success">
                                                                		<span class="text-success">'.substr($reply_sender, 0, 1).'</span>
                                                            		</div>
                                                        		</div>
																<div class="pe-5">
																	<div class="d-flex align-items-center flex-wrap gap-1">
																		<a href="#" class="fw-bolder text-dark text-hover-primary">'.$reply_sender.'</a>
																		<span class="svg-icon svg-icon-7 svg-icon-success mx-3">
																			<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<circle fill="#000000" cx="12" cy="12" r="8"></circle>
																			</svg>
																		</span>
																		<span class="text-muted fw-bolder">'.format_time_ago($reply['reply_date']).'</span>
																	</div>
																	<div class="d-none" data-kt-inbox-message="details">
																		<span class="text-muted fw-bold">to me</span>
																		<a href="#" class="me-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
																			<span class="svg-icon svg-icon-5 m-0">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black"></path>
																				</svg>
																			</span>
																		</a>
																	</div>
																	<div class="text-muted fw- mw-450px" data-kt-inbox-message="preview">'.$reply['reply'].'</div>
																</div>
															</div>
														</div>
													</div><div class="separator my-6"></div>';
													}
												}
											?>
											
											
											
											<!--begin::Form-->
											<form id="kt_inbox_reply_form" class="rounded border mt-10">
												<!--begin::Body-->
												<div class="d-block">
													<!--begin::Message-->
													<textarea id="reply-message" class="form-control" cols="30" rows="10"></textarea>
													<!--end::Message-->
												</div>
												<!--end::Body-->
												<!--begin::Footer-->
												<div class="d-flex flex-stack flex-wrap gap-2 py-5 ps-8 pe-5 border-top">
													<!--begin::Actions-->
													<div class="d-flex align-items-center me-3">
														<!--begin::Send-->
														<div class="btn-group me-4">
															<!--begin::Submit-->
															<button type="button" id="sendReply" class="btn btn-primary fs-bold px-6">
																<span id="span-reply" class="indicator-label">Envoyer</span>
																<span id="span-progress-reply" class="indicator-progress">En cours de traitement... 
																<span id="span-reply-spinner" class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
															</button>
															<!--end::Submit-->
														</div>
														<!--end::Send-->
													</div>
													<!--end::Actions-->
													<!--begin::Toolbar-->
													<div onClick="document.getElementById('reply-message').value = ''" class="d-flex align-items-center">
														<!--begin::Dismiss reply-->
														<span class="btn btn-icon btn-sm btn-clean btn-active-light-primary" data-inbox="dismiss" data-toggle="tooltip" title="Ignorer la réponse">
															<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
															<span class="svg-icon svg-icon-2">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
																	<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
																	<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
																</svg>
															</span>
															<!--end::Svg Icon-->
														</span>
														<!--end::Dismiss reply-->
													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Footer-->
											</form>
											<!--end::Form-->
										</div>
									</div>
									<!--end::Card-->
								</div>
								<!--end::Content-->
							</div>
							<!--end::Inbox App - View & Reply -->
</div>

<input type="hidden" id="pageName" value='<?php echo $currentFileName; ?>'>
<?php
require_once("../footer.php");
?>