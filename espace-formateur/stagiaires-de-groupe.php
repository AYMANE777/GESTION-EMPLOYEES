<?php
require_once("../header.php");

$groupe_id = $_SESSION['groupe_id'];
$QueryGetGroupe = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id=$groupe_id");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
		<div class="row g-7">
			<div class="col-lg-6 col-xl-6">
			    <div class="card card-flush" id="kt_contacts_list">
			    	<div class="card-header pt-7" id="kt_contacts_list_header">
        	            <h4>Groupe: <label class="text-hover-primary"><?php echo $user->getGroupe();?></label></h4>
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
        	                                        <a href="#" onclick="showStagiaireDetails('.$stagiaire['matricule'].')" class="fs-6 fw-bolder text-gray-900 text-hover-primary mb-2">'.$stagiaire['prenom'].' '.$stagiaire['nom'].'</a>
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
				<div class="card card-flush h-lg-100">
					<div class="card-header pt-7" id="kt_chat_contacts_header">
						<div class="card-title">
							<span class="svg-icon svg-icon-1 me-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
									<path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
								</svg>
							</span>
							<h2>Details du Stagiaire</h2>
						</div>
						<div class="card-toolbar gap-3">

							<a href="nouveau-message" class="btn btn-sm btn-light btn-active-light-primary">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M8 8C8 7.4 8.4 7 9 7H16V3C16 2.4 15.6 2 15 2H3C2.4 2 2 2.4 2 3V13C2 13.6 2.4 14 3 14H5V16.1C5 16.8 5.79999 17.1 6.29999 16.6L8 14.9V8Z" fill="black" />
									<path d="M22 8V18C22 18.6 21.6 19 21 19H19V21.1C19 21.8 18.2 22.1 17.7 21.6L15 18.9H9C8.4 18.9 8 18.5 8 17.9V7.90002C8 7.30002 8.4 6.90002 9 6.90002H21C21.6 7.00002 22 7.4 22 8ZM19 11C19 10.4 18.6 10 18 10H12C11.4 10 11 10.4 11 11C11 11.6 11.4 12 12 12H18C18.6 12 19 11.6 19 11ZM17 15C17 14.4 16.6 14 16 14H12C11.4 14 11 14.4 11 15C11 15.6 11.4 16 12 16H16C16.6 16 17 15.6 17 15Z" fill="black" />
								</svg>
							</span>
							Message</a>
						</div>
					</div>
					<div id="loader" style="margin-left: 50%; margin-top: 25%; display: none;" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>
					<div class="card-body pt-5" id="kt_stagiaire_main" style="display: none;">
						<div class="d-flex gap-7 align-items-center">
							<div class="symbol symbol-circle symbol-100px">
								<img src="../assets/media/user-96.png" alt="image" />
							</div>
							<div class="d-flex flex-column gap-2">
								<h3 class="mb-0" id="stagiaire-fullname"></h3>
								<div class="d-flex align-items-center gap-2">
									<span class="svg-icon svg-icon-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M11.2166 8.50002L10.5166 7.80007C10.1166 7.40007 10.1166 6.80005 10.5166 6.40005L13.4166 3.50002C15.5166 1.40002 18.9166 1.50005 20.8166 3.90005C22.5166 5.90005 22.2166 8.90007 20.3166 10.8001L17.5166 13.6C17.1166 14 16.5166 14 16.1166 13.6L15.4166 12.9C15.0166 12.5 15.0166 11.9 15.4166 11.5L18.3166 8.6C19.2166 7.7 19.1166 6.30002 18.0166 5.50002C17.2166 4.90002 16.0166 5.10007 15.3166 5.80007L12.4166 8.69997C12.2166 8.89997 11.6166 8.90002 11.2166 8.50002ZM11.2166 15.6L8.51659 18.3001C7.81659 19.0001 6.71658 19.2 5.81658 18.6C4.81658 17.9 4.71659 16.4 5.51659 15.5L8.31658 12.7C8.71658 12.3 8.71658 11.7001 8.31658 11.3001L7.6166 10.6C7.2166 10.2 6.6166 10.2 6.2166 10.6L3.6166 13.2C1.7166 15.1 1.4166 18.1 3.1166 20.1C5.0166 22.4 8.51659 22.5 10.5166 20.5L13.3166 17.7C13.7166 17.3 13.7166 16.7001 13.3166 16.3001L12.6166 15.6C12.3166 15.2 11.6166 15.2 11.2166 15.6Z" fill="black"/>
										<path opacity="0.3" d="M5.0166 9L2.81659 8.40002C2.31659 8.30002 2.0166 7.79995 2.1166 7.19995L2.31659 5.90002C2.41659 5.20002 3.21659 4.89995 3.81659 5.19995L6.0166 6.40002C6.4166 6.60002 6.6166 7.09998 6.5166 7.59998L6.31659 8.30005C6.11659 8.80005 5.5166 9.1 5.0166 9ZM8.41659 5.69995H8.6166C9.1166 5.69995 9.5166 5.30005 9.5166 4.80005L9.6166 3.09998C9.6166 2.49998 9.2166 2 8.5166 2H7.81659C7.21659 2 6.71659 2.59995 6.91659 3.19995L7.31659 4.90002C7.41659 5.40002 7.91659 5.69995 8.41659 5.69995ZM14.6166 18.2L15.1166 21.3C15.2166 21.8 15.7166 22.2 16.2166 22L17.6166 21.6C18.1166 21.4 18.4166 20.8 18.1166 20.3L16.7166 17.5C16.5166 17.1 16.1166 16.9 15.7166 17L15.2166 17.1C14.8166 17.3 14.5166 17.7 14.6166 18.2ZM18.4166 16.3L19.8166 17.2C20.2166 17.5 20.8166 17.3 21.0166 16.8L21.3166 15.9C21.5166 15.4 21.1166 14.8 20.5166 14.8H18.8166C18.0166 14.8 17.7166 15.9 18.4166 16.3Z" fill="black"/>
									</svg>
									</span>
									<a href="#" class="text-muted text-hover-primary" id="stagiaire-matricule"></a>
								</div>
							</div>
						</div>
						<div class="tab-content" id="">
							<div class="tab-pane fade show active" id="kt_contact_view_general" role="tabpanel">
								<div class="d-flex flex-column gap-5 mt-7">
									<div class="d-flex flex-column gap-1">
										<div class="fw-bolder text-muted">Filiere</div>
										<div class="fw-bolder fs-5" id="stagiaire-filiere"></div>
									</div>
									<div class="d-flex flex-column gap-1">
										<div class="fw-bolder text-muted">Niveau</div>
										<div class="fw-bolder fs-5" id="stagiaire-niveau"></div>
									</div>
									<div class="d-flex flex-column gap-1">
										<div class="fw-bolder text-muted">Année</div>
										<div class="fw-bolder fs-5" id="stagiaire-année"></div>
									</div>
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