<?php
require_once("../header.php");
$currentYear = date("Y");
$QueryCAD = mysqli_query($connect, "SELECT cad.id, stagiaire_mat, fonction, stagiaires.nom AS stagiaireNom, stagiaires.prenom AS stagiairePrenom, stagiaires.filiere AS stagiaireFiliere
FROM cad
INNER JOIN stagiaires
ON cad.stagiaire_mat = stagiaires.matricule
");

$QueryTotal = mysqli_query($connect, "SELECT * FROM cad");
$TotalCAD = mysqli_num_rows($QueryTotal);
$QueryGetActivites = mysqli_query($connect, "SELECT *
FROM activities");
$currentDate = date("Y-m-d h:m:s");
$QueryGetStagiaires = mysqli_query($connect, "SELECT * FROM stagiaires");
$fullname = $user->getPrenom() . " " . $user->getNom();
$message = "";

if(isset($_POST['addActivity']))
{
    $message = "";
    $status = true;
    if(!empty($_FILES["image"]["name"]))
    {
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            if (file_exists($target_file)) {
              $message = "Désolé, l'image existe déjà.";
              $status = false;
            }else{
                if ($_FILES["image"]["size"] > 10000000) {
                    $message = "Désolé, votre image est trop volumineux.";
                    $status = false;
                }else{
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $message = "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                        $status = false;
                    }else{
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                        $status = true;
                    }
                }
            }
        } else {
            $message = "Le fichier n'est pas une image.";
            $status  = false;
        }
    }

    if(!empty($_POST['title']) && !empty($_POST['description']) && $status)
    {
        $image = 0;
        $title = $_POST['title'];
        $description = $_POST['description'];
        if(!empty($_FILES["image"]["name"]))
        {
            $image = $target_file;
        }

        $Query = mysqli_query($connect, "INSERT INTO activities(title, description, author, added_date, attachment)
            VALUES ('$title', '$description', '$fullname', '$currentDate', '$image')");
        if($Query)
        {
            echo '<script>location.replace("cad")</script>';
        }else{
            $message = $connect->error;
        }
    }
}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
    <?php
            if(!empty($message))
            {
                echo '<div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"/>
                        <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(-45 9 13.0283)" fill="black"/>
                        <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(45 9.86664 7.93359)" fill="black"/>
                    </svg>
                </span>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-danger">Erreur!</h4>
                    <span>'.$message.'</span>
                </div>
            </div>';
            }
        ?>
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
                        <span class="svg-icon svg-icon-1 svg-icon-primary me-3 lh-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
								<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
								<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
							</svg>
						</span>&nbsp&nbsp
					    <h3 class="fw-bolder m-0 text-gray-800">Les Activités</h3>
					</div>
                    <div class="card-toolbar m-0">
                        <a style="margin-top: 10px;" class="btn btn-flex h-40px btn-primary" data-bs-toggle="modal" data-bs-target="#add_activity">Ajouter une activité</a>
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
                                                <a data-fslightbox="gallery" href="'.$activity['attachment'].'" class="btn btn-sm btn-primary btn-shadow">Afficher</a>
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
                            }
                        ?>

					</div>
                </div>
            </div>
        </div>
	</div>
</div>
<div class="modal fade" tabindex="-1" id="add_activity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une nouveau activité</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" >
                    <div class="fv-row mb-10">
				    	<label class="form-label fs-6 fw-bolder text-dark">Titre</label>
				    	<div class="input-group mb-5">
				    		<span class="input-group-text">
                                <span class="svg-icon svg-icon-muted svg-icon-1hx">
				    					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				    						<path opacity="0.3" d="M16.163 17.55C17.0515 16.6633 17.6785 15.5488 17.975 14.329C18.2389 13.1884 18.8119 12.1425 19.631 11.306L12.694 4.36902C11.8574 5.18796 10.8115 5.76088 9.67099 6.02502C8.15617 6.3947 6.81277 7.27001 5.86261 8.50635C4.91245 9.74268 4.41238 11.266 4.44501 12.825C4.46196 13.6211 4.31769 14.4125 4.0209 15.1515C3.72412 15.8905 3.28092 16.5617 2.71799 17.125L2.28699 17.556C2.10306 17.7402 1.99976 17.9897 1.99976 18.25C1.99976 18.5103 2.10306 18.7598 2.28699 18.944L5.06201 21.719C5.24614 21.9029 5.49575 22.0062 5.75601 22.0062C6.01627 22.0062 6.26588 21.9029 6.45001 21.719L6.88101 21.288C7.44427 20.725 8.11556 20.2819 8.85452 19.9851C9.59349 19.6883 10.3848 19.5441 11.181 19.561C12.1042 19.58 13.0217 19.4114 13.878 19.0658C14.7343 18.7201 15.5116 18.2046 16.163 17.55Z" fill="black"/>
				    						<path d="M19.631 11.306L12.694 4.36902L14.775 2.28699C14.9591 2.10306 15.2087 1.99976 15.469 1.99976C15.7293 1.99976 15.9789 2.10306 16.163 2.28699L21.713 7.83704C21.8969 8.02117 22.0002 8.27075 22.0002 8.53101C22.0002 8.79126 21.8969 9.04085 21.713 9.22498L19.631 11.306ZM13.041 10.959C12.6427 10.5604 12.1194 10.3112 11.5589 10.2532C10.9985 10.1952 10.4352 10.332 9.96375 10.6405C9.4923 10.949 9.14148 11.4105 8.97034 11.9473C8.79919 12.4841 8.81813 13.0635 9.02399 13.588L2.98099 19.631L4.36899 21.019L10.412 14.975C10.9364 15.1816 11.5161 15.2011 12.0533 15.0303C12.5904 14.8594 13.0523 14.5086 13.361 14.037C13.6697 13.5654 13.8065 13.0018 13.7482 12.4412C13.6899 11.8805 13.4401 11.357 13.041 10.959Z" fill="black"/>
				    					</svg>
				    			</span>
				    		</span>
				    		<input type="text" class="form-control" required name="title">
				    	</div>
				    </div>
                    <div class="fv-row mb-10">
				    	<label class="form-label fs-6 fw-bolder text-dark">Déscription</label>
				    	<div class="input-group mb-5">
				    		<span class="input-group-text">
				    			<span class="svg-icon svg-icon-muted svg-icon-1hx">
				    				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				    					<path opacity="0.3" d="M13.625 22H9.625V3C9.625 2.4 10.025 2 10.625 2H12.625C13.225 2 13.625 2.4 13.625 3V22Z" fill="black"/>
				    					<path d="M19.625 10H12.625V4H19.625L21.025 6.09998C21.325 6.59998 21.325 7.30005 21.025 7.80005L19.625 10Z" fill="black"/>
				    					<path d="M3.62499 16H10.625V10H3.62499L2.225 12.1001C1.925 12.6001 1.925 13.3 2.225 13.8L3.62499 16Z" fill="black"/>
				    				</svg>
				    			</span>
				    		</span>
				    		<textarea class="form-control" name="description" required style="height: 100px"></textarea>
				    	</div>
				    </div>
                    <div class="fv-row mb-10">
				    	<label class="form-label fs-6 fw-bolder text-dark">Image (Facultatif)</label>
				    	<div class="input-group mb-5">
				    		<input type="file" class="form-control" name="image">
				    	</div>
				    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="addActivity" class="btn btn-primary">Ajouter</button>
            </div></form>
        </div>
    </div>
</div>
<?php
require_once("../footer.php");
?>