<?php
require_once("../header.php");
if(!isDirecteur())
{
	echo '<script>location.replace("../404.php")</script>';
}


$QueryGetEntretiens = mysqli_query($connect, "SELECT *, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom,
formateurs.nom as formateurNom, formateurs.prenom as formateurPrenom FROM entretiens 
INNER JOIN stagiaires
ON stagiaires.matricule = entretiens.stagiaire_mat
INNER JOIN formateurs
ON formateurs.matricule = entretiens.formateur_mat");


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
						<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Rechercher un entretien" />
					</div>
				</div>
			</div>
			<div class="card-body pt-0">
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_reclamations_table">
					<thead>
						<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
							<th class="min-w-125px">Entretien ID</th>
							<th class="min-w-125px">Stagiaire</th>
							<th class="min-w-125px">Formateur</th>
							<th class="min-w-125px">Type</th>
							<th class="min-w-125px">Outil</th>
                            <th class="min-w-125px">Date d'entretien</th>
						</tr>
					</thead>
					<tbody class="fw-bold text-gray-600">
						<?php
							if(mysqli_num_rows($QueryGetEntretiens) > 0)
							{
								while($entertien = mysqli_fetch_assoc($QueryGetEntretiens))
								{
									echo '<tr>
									<td>
										#ENTRETIEN'.$entertien['entretien_id'].'
									</td>
									<td>'.$entertien['stagiairePrenom'].' '.$entertien['stagiaireNom'].'</td>
                                    <td>'.$entertien['formateurPrenom'].' '.$entertien['formateurNom'].'</td>
									<td>'.$entertien['type'].'</td>
									<td>'.$entertien['outil'].' '.$entertien['formateurNom'].'</td>
									<td>'.$entertien['date_entretien'].'</td>									
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