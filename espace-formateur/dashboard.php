<?php
require_once("../header.php");

$matricule = $user->getMatricule();

$groupe_id = $_SESSION['groupe_id'];
$QueryGetGroupe = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id=$groupe_id");
$QueryGetActivites = mysqli_query($connect, "SELECT * FROM activities");
$TotalEntretiens = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM entretiens WHERE formateur_mat='$matricule'"));
$QueryGetEntretiens = mysqli_query($connect, "SELECT * FROM entretiens WHERE formateur_mat='$matricule' LIMIT 3");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
		<div class="row g-5 g-xxl-10">
			<div class="card col-xl-5 col-xxl-6 mb-5 mb-xxl-10">
				<div class="card-body pt-9 pb-0">
					<!--begin::Details-->
					<div class="d-flex flex-wrap flex-sm-nowrap mb-6">
						<div class="flex-grow-1">
							<!--begin::Head-->
							<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
								<!--begin::Details-->
								<div class="d-flex flex-column">
									<div class="d-flex align-items-center mb-1">
										<span class="svg-icon svg-icon-muted svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"/>
												<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"/>
											</svg>
										</span>
										<a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3"><?php echo $user->getPrenom() . " " . $user->getNom(); ?></a>
										<span class="badge badge-primary me-auto"><?php echo $user->getFonction(); ?></span>
									</div>
									<div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
										<span class="svg-icon svg-icon-muted svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black"/>
												<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black"/>
												<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black"/>
											</svg>
										</span>
									<strong style="padding-top: 5px;">&nbsp;&nbsp;<?php echo $user->getMatricule(); ?></strong></div>
								</div>
							</div>
							<div class="d-flex flex-wrap justify-content-start">
								<div class="d-flex flex-wrap">
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<div class="d-flex align-items-center">
											<div class="fs-4 fw-bolder"><?php echo dateToFrench(date("Y-m-d"), "l j F Y");?></div>
										</div>
										<div class="fw-bold fs-6 text-gray-400">Date d'ajourd'hui</div>
									</div>
									<?php
										$QueryGetTotalProblems = mysqli_query($connect, "SELECT * FROM problemes WHERE stagiaire_mat IN (SELECT matricule FROM stagiaires WHERE groupe_id='$groupe_id')");
										$TotalProblemes = mysqli_num_rows($QueryGetTotalProblems);
									?>
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<div class="d-flex align-items-center">
											<span class="svg-icon svg-icon-muted svg-icon-2hx">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black"/>
													<rect x="6" y="12" width="7" height="2" rx="1" fill="black"/>
													<rect x="6" y="7" width="12" height="2" rx="1" fill="black"/>
												</svg>
											</span>&nbsp; &nbsp;
											<div class="fs-4 fw-bolder" data-kt-countup="true" data-kt-countup-value="<?php echo $TotalProblemes; ?>">0</div>
										</div>
										<div class="fw-bold fs-6 text-gray-400">Totale des réclamations</div>
									</div>
									<?php
										$QueryGetTotalMessages = mysqli_query($connect, "SELECT * FROM messages WHERE receiver_id='$matricule'");
										$TotalMessages = mysqli_num_rows($QueryGetTotalMessages);
									?>
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<div class="d-flex align-items-center">
											<span class="svg-icon svg-icon-muted svg-icon-2hx">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M21 18H3C2.4 18 2 17.6 2 17V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V17C22 17.6 21.6 18 21 18Z" fill="black"/>
													<path d="M11.4 13.5C11.8 13.8 12.3 13.8 12.6 13.5L21.6 6.30005C21.4 6.10005 21.2 6 20.9 6H2.99998C2.69998 6 2.49999 6.10005 2.29999 6.30005L11.4 13.5Z" fill="black"/>
												</svg>
											</span>
											&nbsp; &nbsp;
											<div class="fs-4 fw-bolder" data-kt-countup="true" data-kt-countup-value="<?php echo $TotalMessages; ?>">0</div>
										</div>

										<div class="fw-bold fs-6 text-gray-400">Totale des messages</div>
									</div>
								</div>
								<div class="symbol-group symbol-hover mb-3">
									
									<?php
										$QueryGetStagiairesGroupe = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id = $groupe_id LIMIT 6");
										$allStagaires =  mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id = $groupe_id");
										$totalSt = mysqli_num_rows($allStagaires);
										if(mysqli_num_rows($QueryGetStagiairesGroupe) > 0)
										{
											
											while($stagiaire = mysqli_fetch_assoc($QueryGetStagiairesGroupe))
											{
												echo '<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="'.$stagiaire['prenom'].' '.$stagiaire['nom'].'">
												<span class="symbol-label bg-warning text-inverse-warning fw-bolder">'.substr($stagiaire['prenom'], 0, 1).'</span>
											</div>';
											}
										
											if($totalSt > 6)
						    				{
						    					$left = $totalSt - 6;
						    					echo '<span class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
						    					<span class="symbol-label bg-light text-gray-400 fs-8 fw-bolder">+'.$left.'</span>
						   						 </span>';
						    				}
										}
									?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-5 col-xxl-6 mb-5 mb-xxl-10">
				<div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px h-xl-100 bg-gray-200 border-0" style="background-position: 100% 100%;background-size: 280px auto;background-image:url('../assets/media/illustrations/dashboard-help.svg')">
					<div class="card-body d-flex flex-column justify-content-center ps-lg-15">
						<h4 class="text-gray-800 fs-2qx fw-boldest mb-4 mb-lg-8">Bonjour!
						<br>Heureux de vous revoir</h4>
						<div class="m-0">
							<a href="mes-messages" class="btn btn-danger fw-bold">Ma Boîte de messages</a>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="row g-5 g-xxl-10">
			<div class="col-xl-4 mb-xxl-10">
				<div class="card card-flush h-xl-100">
					<div class="card-header pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder text-dark">Totale des réclamations</span>
						</h3>
					</div>
					<div class="card card-bordered">
    					<div class="card-body">
    					    <div id="reclamations_chart" style="height: 350px;"></div>
    					</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
    			<div class="card card-flush h-xl-100">
    			    <div class="card-header pt-7">
    			        <h3 class="card-title align-items-start flex-column">
    			            <span class="card-label fw-bolder text-dark">Activtés de C.A.D</span>
    			        </h3>
    			        <div class="card-toolbar">
    			            <a href="cad" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-custom-class="tooltip-dark" title="" data-bs-original-title="Pour afficher les détails des activités">Afficher tout</a>
    			        </div>
    			    </div>
    			    <div class="card-body">
    			        <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
							<div class="timeline-label">
								<?php
								if(mysqli_num_rows($QueryGetActivites) > 0)
								{
									while($activity = mysqli_fetch_assoc($QueryGetActivites))
									{
										echo '<div class="timeline-item">
										<div style="width: 70px;" class="timeline-label fw-bolder text-gray-800 fs-9">'.format_time_ago($activity['added_date']).'</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-'.getColor().' fs-1"></i>
										</div>
										<div class="fw-bold text-gray-700 ps-3 fs-7">'.$activity['title'].'</div>
									</div>';
									}
								}
								?>
							</div>
    			        </div>
    			    </div>
    			</div>
			</div>
			<div class="col-xl-4">
				<div class="card card-flush">
					<div class="card-header pt-7">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder text-gray-800">Entretiens</span>
							<span class="text-gray-400 mt-1 fw-bold fs-6"><?php echo $TotalEntretiens; ?> Entretiens</span>
						</h3>
						<div class="card-toolbar">
							<a href="entretiens" class="btn btn-sm btn-primary" data-bs-toggle='tooltip' data-bs-dismiss='click' data-bs-custom-class="tooltip-dark" title="Pour afficher votre entretiens avec les stagiaires">Afficher Tout</a>
						</div>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane fade show active">
								<?php
									if(mysqli_num_rows($QueryGetEntretiens) > 0)
									{
										while($entretien = mysqli_fetch_assoc($QueryGetEntretiens))
										{
											echo '<div class="m-0">
											<div class="d-flex align-items-sm-center mb-5">
												<div class="symbol symbol-45px me-4">
													<span class="symbol-label bg-primary">
														<span class="svg-icon svg-icon-2x svg-icon-white">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
																<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
															</svg>
														</span>
													</span>
												</div>
												<div class="d-flex align-items-center flex-row-fluid flex-wrap">
													<div class="flex-grow-1 me-2">
														<a href="view-entretien?id='.$entretien['entretien_id'].'" class="text-gray-400 fs-6 fw-bold">'.$entretien['subject'].'</a>
														<span class="text-gray-800 fw-bolder d-block fs-4">#ENTRETIEN-'.$entretien['entretien_id'].'</span>
													</div>
												</div>
											</div>
											<div class="timeline">
												<div class="timeline-item align-items-center mb-7">
													<div class="timeline-line w-40px mt-6 mb-n12"></div>
													<div class="timeline-icon" style="margin-left: 11px">
														<span class="svg-icon svg-icon-2 svg-icon-danger">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="black" />
																<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="black" />
															</svg>
														</span>
													</div>
													<div class="timeline-content m-0">
														<span class="fs-6 text-gray-400 fw-bold d-block">Type</span>
														<span class="fs-6 fw-bolder text-gray-800">'.$entretien['type'].'</span>
													</div>
												</div>
		
												<div class="timeline-item align-items-center">
													<div class="timeline-line w-40px"></div>
													<div class="timeline-icon" style="margin-left: 11px">
														<span class="svg-icon svg-icon-2 svg-icon-info">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
																<path d="M11.276 13.654C11.276 13.2713 11.3367 12.9447 11.458 12.674C11.5887 12.394 11.738 12.1653 11.906 11.988C12.0833 11.8107 12.3167 11.61 12.606 11.386C12.942 11.1247 13.1893 10.896 13.348 10.7C13.5067 10.4947 13.586 10.2427 13.586 9.944C13.586 9.636 13.4833 9.356 13.278 9.104C13.082 8.84267 12.69 8.712 12.102 8.712C11.486 8.712 11.066 8.866 10.842 9.174C10.6273 9.482 10.52 9.82267 10.52 10.196L10.534 10.574H8.826C8.78867 10.3967 8.77 10.2333 8.77 10.084C8.77 9.552 8.90067 9.07133 9.162 8.642C9.42333 8.20333 9.81067 7.858 10.324 7.606C10.8467 7.354 11.4813 7.228 12.228 7.228C13.1987 7.228 13.9687 7.44733 14.538 7.886C15.1073 8.31533 15.392 8.92667 15.392 9.72C15.392 10.168 15.322 10.5507 15.182 10.868C15.042 11.1853 14.874 11.442 14.678 11.638C14.482 11.834 14.2253 12.0533 13.908 12.296C13.544 12.576 13.2733 12.8233 13.096 13.038C12.928 13.2527 12.844 13.528 12.844 13.864V14.326H11.276V13.654ZM11.192 15.222H12.928V17H11.192V15.222Z" fill="black"/>
															</svg>
														</span>
													</div>
													<div class="timeline-content m-0">
														<span class="fs-6 text-gray-400 fw-bold d-block">Outil</span>
														<span class="fs-6 fw-bolder text-gray-800">'.$entretien['outil'].'</span>
													</div>
												</div>
											</div>
										</div>
										<div class="separator separator-dashed my-6"></div>';
										}
									}
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>