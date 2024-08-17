<?php
require_once("../header.php");

if(!isConseilleur())
{
	echo '<script>location.replace("dashboard")</script>';
}

if(!isset($_GET['groupeID']))
{
	echo '<script>location.replace("tout-les-groupes")</script>';
}else{
	$groupeID = secureData($_GET['groupeID']);
}

if(!checkGroupeID($groupeID))
{
	echo '<script>location.replace("tout-les-groupes")</script>';
}

$QueryGetGroupesStag = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id='$groupeID'");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="tab-content">
            <div id="kt_project_users_card_pane" class="tab-pane fade show active">
                
                <div class="row g-6 g-xl-9">
                <?php
                    if(mysqli_num_rows($QueryGetGroupesStag) > 0)
                    {
                        while($stagiaire = mysqli_fetch_assoc($QueryGetGroupesStag))
                        {
                            echo '
                            <div class="col-md-6 col-xxl-4">
                                <div class="card">
                                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                        <div class="symbol symbol-65px symbol-circle mb-5">
                                            <span class="symbol-label fs-2x fw-bold text-primary bg-light-primary">'.substr($stagiaire['prenom'], 0, 1).'</span>
                                            <div class="bg-success position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                        </div>
                                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">'.$stagiaire['prenom'].' '.$stagiaire['nom'].'</a>
                                        <div class="fw-bold text-gray-400 mb-6">'.$stagiaire['matricule'].'</div>
                                        <div class="d-flex flex-center flex-wrap">
                                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                <div class="fw-bold text-gray-400">Filière</div>    
                                                <div class="fs-6 fw-bolder text-gray-700">'.$stagiaire['filiere'].'</div>
                                            </div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                <div class="fw-bold text-gray-400">Niveau</div>    
                                                <div class="fs-6 fw-bolder text-gray-700">'.$stagiaire['niveau'].'</div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>					
                        ';
                        }
                    }
                ?>		
				</div>
            </div>
        </div>
	</div>
</div>
<?php
require_once("../footer.php");
?>