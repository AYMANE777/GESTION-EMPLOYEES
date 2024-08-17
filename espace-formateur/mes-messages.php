<?php
require_once("../header.php");
$mat = $user->getMatricule();

$QueryGetMessages = mysqli_query($connect, "SELECT message_id, subject, content, date_sent, isRead, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom 
FROM messages
INNER JOIN stagiaires
ON messages.sender_id = stagiaires.matricule
WHERE receiver_id=$mat AND isDeleted=0 ORDER BY message_id DESC");

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div id="kt_content_container" class="container-fluid">
			<div class="d-flex flex-column flex-lg-row">
				<?php 
                    require_once("../includes/sidebars/messages-sidebar-formateur.php");
                ?>
				<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
					<div class="card">
						<div class="card-header align-items-center py-5 gap-2 gap-md-5">
							<div class="d-flex flex-wrap gap-1">
								<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
									<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_inbox_listing .form-check-input" value="1" />
								</div>
								<div>
									<a href="#" class="btn btn-sm btn-icon btn-clear btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
										<span class="svg-icon svg-icon-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
											</svg>
										</span>
									</a>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
										<div class="menu-item px-3">
											<a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_read">Read</a>
										</div>
										<div class="menu-item px-3">
											<a href="#" class="menu-link px-3" data-kt-inbox-listing-filter="show_unstarred">Unstarred</a>
										</div>
									</div>
								</div>
								<button type="button" id="reloadMessages" class="btn btn-sm btn-icon btn-clear btn-active-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Recharger">
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="black" />
											<path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="black" />
										</svg>
									</span>
								</button>
								<button type="button" id="markAsRead" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Marquer comme lu">
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect opacity="0.5" x="7" y="2" width="14" height="16" rx="3" fill="black" />
											<rect x="3" y="6" width="14" height="16" rx="3" fill="black" />
										</svg>
									</span>
									
                                </button>
							</div>
							<div class="d-flex align-items-center flex-wrap gap-2">
								<div class="d-flex align-items-center position-relative">
									<span class="svg-icon svg-icon-2 position-absolute ms-4">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
											<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
										</svg>
									</span>
									<input type="text" data-kt-inbox-listing-filter="search" class="form-control form-control-sm form-control-solid mw-100 min-w-150px min-w-md-200px ps-12" placeholder="Rechercher dans la boîte de réception" />
								</div>
							</div>
						</div>
						<div class="card-body p-0">
							<table class="table table-hover table-row-dashed fs-6 gy-5 my-0" id="kt_inbox_listing">
								<thead class="d-none">
									<tr>
										<th>Checkbox</th>
										<th>Author</th>
										<th>Title</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									
									<?php
                                	    if(mysqli_num_rows($QueryGetMessages) > 0)
                                	    {
                                	        while($message = mysqli_fetch_assoc($QueryGetMessages))
                                	        {
                                	            $text = "";
                                	            $span_new = "";
                                	            if($message['isRead'] == 1)
                                	            {
													$read = "true";
                                	                $text = "text-muted";
                                	            }else{
                                	                $span_new = '<div class="badge badge-light-danger">Nouveau</div>';
													$read = "false";
                                	            }
												echo '<tr>
												<td class="ps-9">
													<div class="form-check form-check-sm form-check-custom form-check-solid mt-3">
														<input class="form-check-input" data-checkbox="message-inbox" type="checkbox" value="'.$message['message_id'].'" />
													</div>
												</td>
												<td class="w-150px w-md-175px">
													<a href="view-message?message-id='.$message['message_id'].'" class="d-flex align-items-center text-dark">
														<div class="symbol symbol-35px me-3">
															<div class="symbol-label bg-light-danger">
																<span class="text-danger">'.substr($message['stagiairePrenom'], 0, 1).'</span>
															</div>
														</div>
														<span class="fw-bold '.$text.'">'.$message['stagiairePrenom'].' '.$message['stagiaireNom'].'</span>
													</a>
												</td>
												<td>
													<div class="text-dark mb-1 '.$text.'">
														<a href="view-message?message-id='.$message['message_id'].'" class="text-dark">
															<span class="fw-bolder">'.$message['subject'].'</span>
															<span class="fw-bolder d-md-inine"></span>
														</a>
													</div>
												</td>
												<td class="w-100px text-end fs-7 pe-9">
													<span class="fw-bold '.$text.'">'.format_time_ago($message['date_sent']).'</span>
												</td>
											</tr>';
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="pageName" value='<?php echo $currentFileName; ?>'>
<?php
require_once("../footer.php");
?>