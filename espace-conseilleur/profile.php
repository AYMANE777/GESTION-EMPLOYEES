<?php
require_once("../header.php");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
			<div class="card-header cursor-pointer">
				<!--begin::Card title-->
				<div class="card-title m-0">
					<h3 class="fw-bolder m-0">Détails du profil</h3>
				</div>
				<!--end::Card title-->
				<!--begin::Action-->
				<a href="parametres" class="btn btn-primary align-self-center">Modifier le profil</a>
				<!--end::Action-->
			</div>
            
			<div class="card-body p-9">
				<div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Nom et prénom</label>
					<div class="col-lg-8">
						<span class="fw-bolder fs-6 text-gray-800"><?php echo $user->getPrenom() . " " . $user->getNom(); ?></span>
					</div>
				</div>
                <?php
                    if($user->getFonction() == "Stagiaire")
                    {
                        $credits["title"] = "Matricule";
                        $credits["value"] = $user->getMatricule();
                    }else if($user->getFonction() == "Formateur"){
                        $credits["title"] = "Matricule";
                        $credits["value"] = $user->getMatricule();
                    }else if($user->getFonction() == "Directeur" || $user->getFonction() == "Conseilleur"){
                        $credits["title"] = "CIN";
                        $credits["value"] = $user->getCIN();
                    }
                ?>
				<div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted"><?php echo $credits["title"]; ?></label>
					<div class="col-lg-8 fv-row">
						<span class="fw-bold text-gray-800 fs-6"><?php echo $credits["value"]; ?></span>
					</div>
				</div>

                <?php if($user->getFonction() == "Stagiaire" || $user->getFonction() == "Formatuer"){   ?>
				<div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Année de Formation
					<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="ça pourrait être changé" aria-label="ça pourrait être changé"></i></label>
					<div class="col-lg-8 d-flex align-items-center">
						<span class="fw-bolder fs-6 text-gray-800 me-2"><?php echo $user->getDateFormation(); ?></span>
					</div>
				</div>

                <div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Groupe</label>
					<div class="col-lg-8 d-flex align-items-center">
						<span class="fw-bolder fs-6 text-gray-800 me-2"><?php
                            if(empty($user->getGroupe()))
                            {
                                echo "-";
                            }else{
                                echo $user->getGroupe();
                            }
                        ?></span>
					</div>
				</div>
                <?php } ?>

                <?php if($user->getFonction() == "Stagiaire"){   ?>
				<div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Filiére</label>
					<div class="col-lg-8">
						<a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?php echo $user->getFiliere(); ?></a>
					</div>
				</div>
                <div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Niveau</label>
					<div class="col-lg-8">
						<a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?php echo $user->getNiveau(); ?></a>
					</div>
				</div>
                <?php } ?>

                <?php if($user->getFonction() == "Formateur"){   ?>
				<div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Module</label>
					<div class="col-lg-8">
						<a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?php echo $user->getModule(); ?></a>
					</div>
				</div>
                <?php } ?>

                <?php if($user->getFonction() == "Directeur"){   ?>
				<div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Fonction</label>
					<div class="col-lg-8">
						<a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?php echo $user->getFonction(); ?></a>
					</div>
				</div>
                <?php } ?>

                <?php if($user->getFonction() == "Conseilleur"){   ?>
				<div class="row mb-7">
					<label class="col-lg-4 fw-bold text-muted">Fonction</label>
					<div class="col-lg-8">
						<a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?php echo $user->getFonction(); ?></a>
					</div>
				</div>
                <?php }  ?>
                     
                
                <?php if($user->getFonction() == "Stagiaire" && $user->getGroupe() == ""){   ?>
				<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
					<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
							<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"></rect>
							<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"></rect>
						</svg>
					</span>
					<div class="d-flex flex-stack flex-grow-1">
						<div class="fw-bold">
							<h4 class="text-gray-900 fw-bolder">Nous avons besoin de votre attention !</h4>
							<div class="fs-6 text-gray-700">Vous n'êtes membre d'aucun groupe.</div>
						</div>
					</div>
				</div>
                <?php } ?>
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>