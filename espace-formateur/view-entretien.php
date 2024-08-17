<?php
require_once("../header.php");
if(!isset($_GET['id']))
{
    echo '<script>location.replace("entretiens")</script>';
}else{
    $entretien_id = $_GET['id'];
}

if(!checkEntretienID($entretien_id))
{
    echo '<script>location.replace("entretiens")</script>';
}
$mat = $user->getMatricule();
$QueryGetEntretien = mysqli_query($connect, "SELECT *, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom FROM entretiens 
INNER JOIN stagiaires
ON entretiens.stagiaire_mat = stagiaires.matricule
WHERE entretien_id = $entretien_id AND formateur_mat = $mat");
$entretien = mysqli_fetch_assoc($QueryGetEntretien);

$parts1 = explode(':', $entretien['heure_debut']);
$parts2 = explode(':', $entretien['heure_fin']);

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <a href="entretiens" class="btn btn-icon btn-light-primary btn-sm ms-auto me-lg-n7">
		    <span class="svg-icon svg-icon-2">
		    	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
		    		<path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black"></path>
		    	</svg>
		    </span>
		</a>
        <div class="tab-pane fade show">
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
                                <span class="badge badge-primary fw-bolder me-auto px-4 py-3"><?php echo $parts1[0] . ":" . $parts1[1]; ?>h - <?php echo $parts2[0] . ":" . $parts2[1]; ?>h</span>
                            </div>
                        </div>
                        <div class="card-body p-9">
                            <div class="fs-3 fw-bolder text-dark"><?php echo $entretien['subject']; ?></div>
                            <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7"><?php echo $entretien['description']; ?></p>
                            <div class="d-flex flex-wrap mb-5">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bolder"><?php echo dateToFrench($entretien['date_entretien'], "l j F Y"); ?></div>
                                    <div class="fw-bold text-gray-400">La date d'entretien</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bolder"><?php echo $entretien['type']; ?></div>
                                    <div class="fw-bold text-gray-400">Type d'entretien</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bolder"><?php echo $entretien['outil']; ?></div>
                                    <div class="fw-bold text-gray-400">Outil d'entretien</div>
                                </div>
                            </div>
                            <div class="symbol-group symbol-hover">
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?php echo $user->getPrenom() . " " . $user->getNom(); ?>">
                                    <span class="symbol-label bg-primary text-inverse-warning fw-bolder"><?php echo substr($user->getPrenom(), 0, 1) ?></span>
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?php echo $entretien["stagiairePrenom"] . " " . $entretien["stagiaireNom"]; ?>">
                                    <span class="symbol-label bg-warning text-inverse-warning fw-bolder"><?php echo substr($entretien["stagiairePrenom"], 0, 1); ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
	</div>
</div>
<?php
require_once("../footer.php");
?>