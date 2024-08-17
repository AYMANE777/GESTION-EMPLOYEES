<?php
require_once("../header.php");

if(!isDirecteur())
{
	echo '<script>location.replace("dashboard")</script>';
}

if(!isset($_GET['eng_id']))
{
	echo '<script>location.replace("gestion-engagements")</script>';
}else{
	$engid = secureData($_GET['eng_id']);
}

if(!checkEngagementID($engid))
{
	echo '<script>location.replace("gestion-engagements")</script>';
}

$QueryGetData = mysqli_query($connect, "SELECT eng_id, stagiaire_mat, date_creation, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom, stagiaires.filiere as stagiaireFiliere, stagiaires.niveau as stagiaireNiveau, formateurs.nom as formateurNom, formateurs.prenom as formateurPrenom, formateurs.matricule as formateurMatricule
FROM engagements
INNER JOIN stagiaires
ON stagiaires.matricule = engagements.stagiaire_mat
INNER JOIN formateurs
ON formateurs.groupe_id = engagements.groupe_id
WHERE eng_id='$engid'");
$eng = mysqli_fetch_assoc($QueryGetData);

echo $connect->error;
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
		<div class="card">
			<div class="card-body py-20">
				<!-- begin::Wrapper-->
				<div class="mw-lg-950px mx-auto w-100">
					<!-- begin::Header-->
					<div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
						<h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">CONTRAT</h4>
						<div class="text-sm-end">
							<a href="#" class="d-block mw-150px ms-sm-auto">
								<img alt="Logo" src="../assets/media/ofppt-logo.png" class="w-80" />
							</a>
						</div>
					</div>
					<div class="pb-12">
						<div class="d-flex flex-column gap-7 gap-md-10">
							<div class="fw-bolder fs-2">
							<br />
							<span class="text-muted fs-5">Contrat d'engagement de parrainage.</span></div>
							<div class="separator"></div>
							<div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
								<div class="flex-root d-flex flex-column">
									<span class="text-muted">Engagement</span>
									<span class="fs-5">#ENGAGEMENT-<?php echo $engid; ?></span>
								</div>
								<div class="flex-root d-flex flex-column">
									<span class="text-muted">Date de Création</span>
									<span class="fs-5"><?php echo $eng["date_creation"]; ?></span>
								</div>
							</div>
							<div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
								<div class="flex-root d-flex flex-column">
									<span class="text-muted">Formateur</span>
									<hr>
									<span class="fs-6"><i>Matricule:</i> <?php echo $eng["formateurMatricule"]; ?>
									<br /><i>Prénom et Nom:</i> <?php echo $eng["formateurPrenom"] . " " . $eng["formateurNom"]; ?></span>
								</div>
								<div class="flex-root d-flex flex-column">
								<span class="text-muted">Stagiaire</span>
								<hr>
								<span class="fs-6"><i>Matricule:</i> <?php echo $eng["stagiaire_mat"]; ?><br />
									<span class="fs-6"><i>Prénom et Nom:</i> <?php echo $eng["stagiairePrenom"] . " " . $eng["stagiaireNom"]; ?>
									<br /><i>Filiére:</i> <?php echo $eng["stagiaireFiliere"]; ?></span>
									<br />
									<i>Niveau:</i> <?php echo $eng["stagiaireNiveau"]; ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
						<!-- begin::Actions-->
						<div class="my-1 me-5">
							<!-- begin::Pint-->
							<button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Imprimer</button>
						</div>
					</div>
					<!-- end::Footer-->
				</div>
				<!-- end::Wrapper-->
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>