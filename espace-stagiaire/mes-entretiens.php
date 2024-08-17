<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
$matricule = $user->getMatricule();
$QueryTotalEntretien = mysqli_query($connect, "SELECT * FROM entretiens WHERE stagiaire_mat = '$matricule'");
$TotalEntretiens = mysqli_num_rows($QueryTotalEntretien);

$QueryGetDates = mysqli_query($connect, "SELECT entretien_id, date_entretien FROM entretiens WHERE stagiaire_mat = '$matricule'");
$QueryGetDetails = mysqli_query($connect, "SELECT entretien_id, type, outil, heure_debut, heure_fin, description, subject, date_entretien, formateurs.nom as formateurNom, formateurs.prenom as formateurPrenom
FROM entretiens
INNER JOIN formateurs
ON entretiens.formateur_mat = formateurs.matricule
WHERE stagiaire_mat = '$matricule'");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="col-lg-12">
			<div class="card card-flush h-lg-100">
				<div class="card-header mt-6">
					<div class="card-title flex-column">
						<h3 class="fw-bolder mb-1">Tout mes entretiens</h3>
						<div class="fs-6 text-gray-400">Totale des entretiens <?php echo $TotalEntretiens; ?></div>
					</div>
				</div>
				<div class="card-body p-9 pt-4">
					<ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2">
                        <?php
                            if(mysqli_num_rows($QueryGetDates) > 0)
                            {
                                while($dateEntretien = mysqli_fetch_assoc($QueryGetDates))
                                {
                                    $parts = explode('-', $dateEntretien['date_entretien']);
                                    $day = dateToFrench($dateEntretien['date_entretien'], "l");
                                    $dayNum = dateToFrench($dateEntretien['date_entretien'], "j");
                                    $month = dateToFrench($dateEntretien['date_entretien'], "F");
                                    echo '<li class="nav-item me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$dateEntretien['date_entretien'].'">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#entretien_'.$dateEntretien['entretien_id'].'">
                                        <span class="opacity-50 fs-7 fw-bold">'.substr($day, 0, 3).'</span>
                                        <span class="fs-6 fw-bolder">'.$dayNum.'</span>
                                    </a>
                                </li>';
                                }
                            }
                        ?>
						
					</ul>
					<div class="tab-content">
                        <?php 
                            if(mysqli_num_rows($QueryGetDetails) > 0)
                            {
                                while($entretien = mysqli_fetch_assoc($QueryGetDetails))
                                {
                                    $parts1 = explode(':', $entretien['heure_debut']);
                                    $parts2 = explode(':', $entretien['heure_fin']);
                                    echo '<div id="entretien_'.$entretien['entretien_id'].'" class="tab-pane fade show">
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <div class="col-md-6 col-xl-4">
                                            <a href="#" class="card border-hover-primary">
                                                <div class="card-header border-0 pt-9">
                                                    <div class="card-title m-0">
                                                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                                                <rect x="11" y="17" width="7" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                                                                <rect x="11" y="9" width="2" height="2" rx="1" transform="rotate(-90 11 9)" fill="black"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <span class="badge badge-primary fw-bolder me-auto px-4 py-3">'.$parts1[0].':'.$parts1[1].'h - '.$parts2[0].':'.$parts2[1].'h</span>
                                                    </div>
                                                </div>
                                                <div class="card-body p-9">
                                                    <div class="fs-3 fw-bolder text-dark">'.$entretien['subject'].'</div>
                                                    <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">'.$entretien['description'].'</p>
                                                    <div class="d-flex flex-wrap mb-5">
                                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                                            <div class="fs-6 text-gray-800 fw-bolder">'.dateToFrench($entretien['date_entretien'], "l j F Y").'</div>
                                                            <div class="fw-bold text-gray-400">La date d\'entretien</div>
                                                        </div>
                                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                                            <div class="fs-6 text-gray-800 fw-bolder">'.$entretien['type'].'</div>
                                                            <div class="fw-bold text-gray-400">Type d\'entretien</div>
                                                        </div>
                                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                                            <div class="fs-6 text-gray-800 fw-bolder">'.$entretien['outil'].'</div>
                                                            <div class="fw-bold text-gray-400">Outil d\'entretien</div>
                                                        </div>
                                                    </div>
                                                    <div class="symbol-group symbol-hover">
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="'.$entretien["formateurPrenom"].' '.$entretien["formateurNom"].'">
                                                            <span class="symbol-label bg-primary text-inverse-warning fw-bolder">'.substr($entretien["formateurPrenom"], 0, 1).'</span>
                                                        </div>
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="'.$user->getPrenom().' '.$user->getNom().'">
                                                            <span class="symbol-label bg-warning text-inverse-warning fw-bolder">'.substr($user->getPrenom(), 0, 1).'</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
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
<?php
require_once("../footer.php");
?>