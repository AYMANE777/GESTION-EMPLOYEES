<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }

$matricule = $user->getMatricule();

$groupe_id = $_SESSION['groupe_id'];
$QueryGetGroupe = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id=$groupe_id");

$QueryGetFormateur = mysqli_query($connect, "SELECT * FROM formateurs WHERE groupe_id=$groupe_id");
$formateur = mysqli_fetch_assoc($QueryGetFormateur);
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
										<span class="badge badge-warning me-auto"><?php echo $user->getFonction(); ?></span>
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
							<!--end::Head-->
							<!--begin::Info-->
							<div class="d-flex flex-wrap justify-content-start">
								<!--begin::Stats-->
								<div class="d-flex flex-wrap">
									<!--begin::Stat-->
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<!--begin::Number-->
										<div class="d-flex align-items-center">
											<div class="fs-4 fw-bolder"><?php echo dateToFrench(date("Y-m-d"), "l j F Y");?></div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-bold fs-6 text-gray-400">Date d'ajourd'hui</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
									<!--begin::Stat-->
									<?php
										$QueryGetTotalProblems = mysqli_query($connect, "SELECT * FROM problemes WHERE stagiaire_mat='$matricule'");
										$TotalProblemes = mysqli_num_rows($QueryGetTotalProblems);
									?>
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<!--begin::Number-->
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
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-bold fs-6 text-gray-400">Totale de mes réclamations</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
									<!--begin::Stat-->
									<?php
										$QueryGetTotalMessages = mysqli_query($connect, "SELECT * FROM messages WHERE receiver_id='$matricule'");
										$TotalMessages = mysqli_num_rows($QueryGetTotalMessages);
									?>
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<!--begin::Number-->
										<div class="d-flex align-items-center">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
											<span class="svg-icon svg-icon-muted svg-icon-2hx">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M21 18H3C2.4 18 2 17.6 2 17V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V17C22 17.6 21.6 18 21 18Z" fill="black"/>
													<path d="M11.4 13.5C11.8 13.8 12.3 13.8 12.6 13.5L21.6 6.30005C21.4 6.10005 21.2 6 20.9 6H2.99998C2.69998 6 2.49999 6.10005 2.29999 6.30005L11.4 13.5Z" fill="black"/>
												</svg>
											</span>
											&nbsp; &nbsp;
											<!--end::Svg Icon-->
											<div class="fs-4 fw-bolder" data-kt-countup="true" data-kt-countup-value="<?php echo $TotalMessages; ?>">0</div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-bold fs-6 text-gray-400">Totale des messages</div>
										<!--end::Label-->
									</div>
									
									<!--end::Stat-->
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
								<!--end::Users-->
							</div>
							<!--end::Info-->
						</div>
						<!--end::Wrapper-->
					</div>
				</div>
			</div>

			<div class="col-xl-5 col-xxl-6 mb-5 mb-xxl-10">
				<div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px h-xl-100 bg-gray-200 border-0" style="background-position: 100% 100%;background-size: 280px auto;background-image:url('../assets/media/illustrations/dashboard-help.svg')">
					<div class="card-body d-flex flex-column justify-content-center ps-lg-15">
						<h3 class="text-gray-800 fs-2qx fw-boldest mb-4 mb-lg-8">Bonjour!
						<br>Heureux de vous revoir</h3>
						<div class="m-0">
							<a href="mes-messages" class="btn btn-danger fw-bold">Ma Boîte de messages</a>
						</div>
					</div>
				</div>
			</div>

		</div>
		
		
		
		<div class="row gy-5 g-xl-10">
			<div class="col-xl-4">
				<!--begin::Engage widget 1-->
				<div class="card h-xl-100">
					<!--begin::Body-->
					<div class="card-body d-flex flex-column flex-center">
						<!--begin::Heading-->
						<div class="mb-2">
							<!--begin::Title-->
							<h1 class="fw-bold text-gray-800 text-center lh-lg">Besoin d'assitance ?
							<br></h1>
							<div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-300px my-5 my-lg-12" style="background-image:url('../assets/media/illustrations/dozzy-1/17.png')"></div>
						</div>
						<!--end::Heading-->
						<!--begin::Links-->
						<div class="text-center">
							<!--begin::Link-->
							<a href="assistance" class="btn btn-sm btn-primary me-2" >Reclamer ici</a>

						</div>
						<!--end::Links-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Engage widget 1-->
			</div>
			<div class="col-lg-6 col-xl-6">
		    	<div class="card card-flush" id="kt_contacts_list">
		    		<div class="card-header pt-7" id="kt_contacts_list_header">
            	        <h4>
							<span class="svg-icon svg-icon-muted svg-icon-2hx">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="black"/>
									<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
									<path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="black"/>
									<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
								</svg>
							</span>
							<label class="text-hover-primary"><?php echo $user->getGroupe();?></label></h4>
		    		</div>
		    		<div class="card-body pt-5" id="kt_contacts_list_body">
		    			<div class="scroll-y me-n5 pe-5 h-300px h-xl-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_contacts_list_header" data-kt-scroll-wrappers="#kt_content, #kt_contacts_list_body" data-kt-scroll-stretch="#kt_contacts_list, #kt_contacts_main" data-kt-scroll-offset="5px">
            	            <?php
            	                if(mysqli_num_rows($QueryGetGroupe) > 0)
            	                {
            	                    while($stagiaire = mysqli_fetch_assoc($QueryGetGroupe))
            	                    {
            	                        if($stagiaire['matricule'] != $user->getMatricule())
            	                        {
            	                            echo '<div class="d-flex flex-stack py-4">
            	                            <div class="d-flex align-items-center">
            	                                <div class="symbol symbol-40px symbol-circle">
            	                                    <span class="symbol-label bg-light-warning text-warning fs-6 fw-bolder">'.substr($stagiaire['prenom'], 0, 1).'</span>
            	                                </div>
            	                                <div class="ms-4">
            	                                    <span class="fs-6 fw-bolder text-gray-900 mb-2">'.$stagiaire['prenom'].' '.$stagiaire['nom'].'</span>
            	                                    <div class="fw-bold fs-7 text-muted">'.$stagiaire['matricule'].'</div>
            	                                </div>
            	                            </div>
            	                        </div><div class="separator separator-dashed d-none"></div>';
            	                        }
            	                    }
            	                }
            	            ?>
		    			</div>
		    		</div>
		    	</div>          
			</div>
			<div class="col-xl-6">
				<div class="card card-flush h-lg-100" id="kt_contacts_main">
					<div class="card-header pt-7" id="kt_chat_contacts_header">
						<div class="card-title">
							<span class="svg-icon svg-icon-1 me-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black"></path>
									<path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black"></path>
								</svg>
							</span>
							<h2>Formateur Responsable</h2>
						</div>
					</div>
					<div class="card-body pt-5">
						<div class="d-flex gap-7 align-items-center">
                            <div class="symbol symbol-60px me-3">
                                <div class="symbol-label bg-light-danger">
                                 <div class="symbol-label fs-1 fw-bolder bg-light-danger text-danger"><?php echo substr($formateur['prenom'], 0, 1) ?></div>
                                </div>
                            </div>
							<div class="d-flex flex-column gap-2">
								<h3 class="mb-0"><?php echo $formateur["prenom"] . " " . $formateur['nom']; ?></h3>
								<div class="d-flex align-items-center gap-2">
                                    <i style="font-size: 20px;" class="fonticon-bookmark"></i>
									<a href="#" class="text-muted text-hover-primary"><?php echo $formateur['module']; ?></a>
								</div>
								<div class="d-flex align-items-center gap-2">
                                    <i style="font-size: 20px;" class="fonticon-pin"></i>
									<a href="#" class="text-muted text-hover-primary"><?php echo $formateur['matricule']; ?></a>
								</div>
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