<?php
require_once("../header.php");
$QueryGetStagiaires = mysqli_query($connect, "SELECT inscription_id, inscriptions.stagiaire_mat, inscriptions.groupe_id,
inscriptions.date_creation, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom,
 stagiaires.filiere as stagiaireFiliere, formateurs.nom as formateurNom, formateurs.prenom as formateurPrenom ,eng_id
FROM inscriptions
INNER JOIN stagiaires
ON stagiaires.matricule = inscriptions.stagiaire_mat
INNER JOIN formateurs
ON formateurs.groupe_id = inscriptions.groupe_id
INNER JOIN engagements
ON engagements.stagiaire_mat = inscriptions.stagiaire_mat
");
echo $connect->error;
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
		<div class="card">
			<div class="card-header border-0 pt-6">
				<div class="card-title">
					<div class="d-flex align-items-center position-relative my-1">
						<span class="svg-icon svg-icon-1 position-absolute ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>
						<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Rechercher une inscription" />
					</div>
				</div>
				<div class="card-toolbar">
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
						<div class="fw-bolder me-5">
						<span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
					</div>
				</div>
			</div>
			<div class="card-body pt-0">
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
					<thead>
						<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
							<th class="min-w-125px">Inscription ID</th>
							<th class="min-w-125px">Matricule Stagiaire</th>
							<th class="min-w-125px">Stagiaire Nom</th>
							<th class="min-w-125px">Stagiaire Filiére</th>
							<th class="min-w-125px">Formateur</th>
							<th class="min-w-125px">Date d'inscription</th>
							<th class="min-w-125px">Engagement ID</th>
						</tr>
					</thead>
					<tbody class="fw-bold text-gray-600">
						<?php
							if(mysqli_num_rows($QueryGetStagiaires) > 0)
							{
								while($inscription = mysqli_fetch_assoc($QueryGetStagiaires))
								{
									echo '<tr>
									<td>
										#'.$inscription['inscription_id'].'
									</td>
									<td>'.$inscription['stagiaire_mat'].'</td>
									<td>'.$inscription['stagiairePrenom'].' '.$inscription['stagiaireNom'].'</td>
									<td>'.$inscription['stagiaireFiliere'].'</td>
									<td>'.$inscription['formateurPrenom'].' '.$inscription['formateurNom'].'</td>
									<td>'.$inscription['date_creation'].'</td>
									<td><a href="view-engagement?eng_id='.$inscription['eng_id'].'" class="text-gray-800 text-hover-primary mb-1">#ENGAGEMENT-'.$inscription['eng_id'].'</a></td>
									
									</tr>';
								}
							}
						?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>