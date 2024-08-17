<?php
require_once("../header.php");
if(!isDirecteur())
{
	echo '<script>location.replace("../404.php")</script>';
}

$SQLGetTotalStagiaires = mysqli_query($connect, "SELECT * FROM stagiaires");
$totalStagiaires = mysqli_num_rows($SQLGetTotalStagiaires);
$SQLGetStagiaires = mysqli_query($connect, "SELECT nom, prenom FROM stagiaires LIMIT 6");
$QueryGetActivites = mysqli_query($connect, "SELECT * FROM activities");

$QueryGetGroupes = mysqli_query($connect, "SELECT * FROM groupes");
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
									<strong style="padding-top: 5px;">&nbsp;&nbsp;<?php echo $user->getCIN(); ?></strong></div>
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
										$QueryGetTotalProblems = mysqli_query($connect, "SELECT * FROM problemes");
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
										$QueryGetTotalMessages = mysqli_query($connect, "SELECT * FROM messages");
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
										$QueryGetStagiairesGroupe = mysqli_query($connect, "SELECT * FROM stagiaires LIMIT 6");
										$allStagaires =  mysqli_query($connect, "SELECT * FROM stagiaires ");
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
			


			<div class="col-xl-3 mb-5 mb-xxl-10">
				<div class="card card-flush h-xl-100">
					<div class="card-header py-7">
						<div class="card-title pt-3 mb-0 gap-4 gap-lg-10 gap-xl-15 nav nav-tabs border-bottom-0" data-kt-table-widget-3="tabs_nav">
							<?php $TotalGroupes = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM groupes")); ?>
							<div class="fs-4 fw-bolder pb-3 border-bottom border-3 border-primary cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Show All">Groupes (<?php echo $TotalGroupes; ?>)</div>
						</div>
					</div>
					<div class="card-body pt-1">
						<table id="kt_widget_table_3" class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3" data-kt-table-widget-3="all">
							<thead class="d-none">
								<tr>
									<th>Groupe Nom</th>
									<th>Stagiaires</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(mysqli_num_rows($QueryGetGroupes) > 0)
								{
									while($groupe = mysqli_fetch_assoc($QueryGetGroupes))
									{
										echo '<tr>
										<td class="min-w-175px">
											<div class="position-relative ps-6 pe-3 py-2">
												<div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-info"></div>
												<a href="tout-les-groupes" class="mb-1 text-dark text-hover-primary fw-bolder">'.$groupe['groupe_nom'].'</a>
											</div>
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
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>