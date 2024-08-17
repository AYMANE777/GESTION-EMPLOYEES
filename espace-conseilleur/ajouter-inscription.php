<?php
require_once("../header.php");
$QueryGetStagiaires = mysqli_query($connect, "SELECT * FROM stagiaires");
$QueryGetGroupes = mysqli_query($connect, "SELECT * FROM groupes");
$message = "";
if(isset($_POST['addInscription']))
{
    if(!empty($_POST['stagiaire']) && !empty($_POST['groupe']))
    {
        $stagiaire_matricule = secureData($_POST['stagiaire']);
        $groupe_id = secureData($_POST['groupe']);
        $today = date("Y-m-d");
        $QueryInsert = mysqli_query($connect, "INSERT INTO inscriptions(stagiaire_mat, groupe_id, date_creation)
        VALUES ('$stagiaire_matricule', '$groupe_id', '$today')");
        if($QueryInsert)
        {
            $QueryUpdate = mysqli_query($connect, "UPDATE stagiaires SET groupe_id='$groupe_id' WHERE matricule='$stagiaire_matricule'");
            if($QueryUpdate)
            {
				$QueryCreateEngagement = mysqli_query($connect, "INSERT INTO engagements(stagiaire_mat, groupe_id, date_creation) VALUES ('$stagiaire_matricule', '$groupe_id', '$today')");
				if($QueryCreateEngagement)
				{
					$message = '<div class="alert alert-success">L\'inscription a été créée avec succès</div>';
				}
                
            }
            
        }else{
            $message = '<div class="alert alert-danger">'.$connect->error.'</div>';
        }
    }
}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
            <?php
                if(!empty($message)) echo $message;
            ?>
        <div class="col-md-5 card card-flush h-xl-100">
    	    <div class="card-header pt-7">
    	        <h3 class="card-title align-items-start flex-column">
    	            <span class="card-label fw-bolder text-dark">Ajouter une inscription</span>
    	        </h3>
    	        <div class="card-toolbar">
    	            <a href="inscriptions" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-custom-class="tooltip-white" title="" data-bs-original-title="Pour afficher tout les inscriptions">Les inscriptions</a>
    	        </div>
    	    </div>
    	    <div class="card-body">
                <form method="POST">
                    <div class="fv-row mb-7">
						<label class="required fs-6 fw-bold mb-2">Stagiaire:</label>
                        <div class="input-group mb-5">
							<select class="form-select" name="stagiaire" required data-control="select2" data-placeholder="Rechercher votre stagiaire ">
    							<option></option>
								<?php
									if(mysqli_num_rows($QueryGetStagiaires) > 0)
									{
										while($stagiaire = mysqli_fetch_assoc($QueryGetStagiaires))
										{
											echo '<option value="'.$stagiaire['matricule'].'">'.$stagiaire['prenom'].' '.$stagiaire['nom'].'</option>';
										}
									}
								?>
							</select>
						</div>
                    </div>	
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Groupe:</label>
                        <div class="input-group mb-5">
							<select class="form-select" name="groupe" required data-control="select2" data-placeholder="Rechercher un groupe ">
    							<option></option>
								<?php
									if(mysqli_num_rows($QueryGetGroupes) > 0)
									{
										while($groupe = mysqli_fetch_assoc($QueryGetGroupes))
										{
											echo '<option value="'.$groupe['groupe_id'].'">'.$groupe['groupe_nom'].'</option>';
										}
									}
								?>
							</select>
						</div>
                    </div>
                    <div class="fv-row mb-7">
                        <button type="submit" class="btn btn-primary" name="addInscription">Ajouter</button>
                    </div>
                </form>
    	    </div>
    	</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>