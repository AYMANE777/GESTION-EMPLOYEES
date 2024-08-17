<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
$groupeID = $_SESSION['groupe_id'];
$QueryGetGroupe = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id=$groupeID");

$QueryGetFormateur = mysqli_query($connect, "SELECT * FROM formateurs WHERE groupe_id=$groupeID");
$formateur = mysqli_fetch_assoc($QueryGetFormateur);
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="row g-7">
            <div class="col-lg-6 col-xl-3">
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
                                                    <a href="#" class="fs-6 fw-bolder text-gray-900 text-hover-primary mb-2">'.$stagiaire['prenom'].' '.$stagiaire['nom'].'</a>
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