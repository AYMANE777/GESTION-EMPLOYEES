<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
$currentYear = date("Y");
$QueryCAD = mysqli_query($connect, "SELECT stagiaire_mat, fonction, stagiaires.nom AS stagiaireNom, stagiaires.prenom AS stagiairePrenom, stagiaires.filiere AS stagiaireFiliere
FROM cad
INNER JOIN stagiaires
ON cad.stagiaire_mat = stagiaires.matricule
");

$QueryTotal = mysqli_query($connect, "SELECT * FROM cad");
$TotalCAD = mysqli_num_rows($QueryTotal);

$QueryGetActivites = mysqli_query($connect, "SELECT *
FROM activities");

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="col-lg-6">
			<div class="card card-flush h-lg-100">
				<div class="card-header mt-6">
					<div class="card-title flex-column">
						<h3 class="fw-bolder mb-1">Composition du comité d'auto discipline</h3>
						<div class="fs-6 text-gray-400">Totale des stagiaires du CAD est <?php echo $TotalCAD; ?> </div>
					</div>
				</div>
				<div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                    <?php

                        if($TotalCAD > 0)
                        {
                            while($st = mysqli_fetch_assoc($QueryCAD))
                            {
                                if($st["stagiaire_mat"] == $user->getMatricule())
                                {
                                    $textColor = "text-primary";
                                    $colorSymbol = "success";
                                }else{
                                    $textColor = "text-gray-900";
                                    $colorSymbol = "danger";
                                }
                                echo '<div class="d-flex align-items-center mb-5">
                                <div class="me-5 position-relative">
                                    <div class="symbol symbol-35px me-3">
                                        <div class="symbol-label bg-light-'.$colorSymbol.'">
                                            <span class="text-'.$colorSymbol.'">'.substr($st['stagiairePrenom'], 0, 1).'</span>
                                        </div>
                                     </div>
                                </div>
                                <div class="fw-bold">
                                    <span class="fs-5 fw-bolder '.$textColor.'">'.$st['stagiairePrenom'].' '.$st['stagiaireNom'].'</span>
                                    <div class="text-gray-400">'.$st['stagiaireFiliere'].'</div>
                                </div>
                            </div>';
                            }
                        }
                    ?>

				</div>

			</div>
		</div>
        <br>
        <div class="col-lg-12">
            <div class="card card-flush h-lg-100">
                <div class="card-header card-header-stretch">
					<div class="card-title d-flex align-items-center">
                        <i style="font-size: 20px;"class="fa fa-history"></i>&nbsp&nbsp
					    <h3 class="fw-bolder m-0 text-gray-800">Les Activités</h3>
					</div>
				</div>
                <div class="card-body">
                    <div class="timeline">
                        <?php
                            if(mysqli_num_rows($QueryGetActivites) > 0)
                            {
                                while($activity = mysqli_fetch_assoc($QueryGetActivites))
                                {
                                    if(!empty($activity['attachment']))
                                    {
                                        $attachment = '<div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                        <div class="overlay me-10">
                                            <div class="overlay-wrapper">
                                                <img alt="img" class="rounded w-150px" src="'.$activity['attachment'].'" />
                                            </div>
                                            <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                <a data-fslightbox="gallery" href="'.$activity['attachment'].'" class="btn btn-sm btn-primary btn-shadow">Affichier</a>
                                            </div>
                                        </div>
                                    </div>';
                                    }else{
                                        $attachment = "";
                                    }
                                    echo '<div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                        <div class="symbol-label bg-light">
                                            <span class="svg-icon svg-icon-2 svg-icon-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black" />
                                                    <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-5 fw-bold mb-2">'.$activity["title"].'</div>
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">Ajouté à '.dateToFrench($activity['added_date'], "l j F Y H:i").' par</div>
                                                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="'.$activity['author'].'">
                                                    <div class="symbol-label fs-8 fw-bold bg-primary text-inverse-primary">
                                                        <span class="text-white">'.substr($activity["author"], 0, 1).'</span>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <p>'.$activity['description'].'</p>

                                            </div>

                                            '.$attachment.'
                                        </div>
                                    </div>
                                </div>';
                                }
                            }else{
                                echo '<div class="alert alert-warning">
						<span class="svg-icon svg-icon-2hx svg-icon-warning me-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"/>
<rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(-45 9 13.0283)" fill="black"/>
<rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(45 9.86664 7.93359)" fill="black"/>
</svg></span>		<span>Aucun activité trouvé!</span>			
					</div>';
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
