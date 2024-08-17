<?php
require_once("../header.php");
if(!isDirecteur())
{
	echo '<script>location.replace("../404.php")</script>';
}
$QueryGetProblemes = mysqli_query($connect, "SELECT problem_id, titre, date_reclamation, statut, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom
FROM problemes
INNER JOIN stagiaires
ON problemes.stagiaire_mat = stagiaires.matricule");
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
						<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Rechercher une inscription" />
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
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_reclamations_table">
					<thead>
						<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
							<th class="min-w-125px">Réclamation ID</th>
							<th class="min-w-125px">Stagiaire</th>
							<th class="min-w-125px">Titre</th>
							<th class="min-w-125px">Statut</th>
							<th class="min-w-125px">Date de réclamation</th>
                            <th class="text-end min-w-70px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 170.531px;">Actions</th>
						</tr>
					</thead>
					<tbody class="fw-bold text-gray-600">
						<?php
							if(mysqli_num_rows($QueryGetProblemes) > 0)
							{
								while($problem = mysqli_fetch_assoc($QueryGetProblemes))
								{
									$badge_class = "";
										if($problem['statut'] == "En attente")
										{
											$badge_class = "warning";
										}else if($problem['statut'] == "Résolu")
										{
											$badge_class = "success";
										}else if($problem['statut'] == "Annulé")
										{
											$badge_class = "danger";
										}
									echo '<tr>
									<td>
										#RECLAMATION-'.$problem['problem_id'].'
									</td>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
												<a href="#">
													<div class="symbol-label fs-3 bg-light-danger text-danger">'.substr($problem['stagiairePrenom'], 0, 1).'</div>
												</a>
											</div>
											<div class="ms-5">
												<a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder">'.$problem['stagiairePrenom'].' '.$problem['stagiaireNom'].'</a>
											</div>
										</div>
									</td>
									<td>'.$problem['titre'].'</td>
									<td><span class="badge badge-'.$badge_class.' fs-7 fw-bolder">'.$problem['statut'].'</span></td>
									<td>'.$problem['date_reclamation'].'</td>
									<td class="text-end">
								        <a href="#" class="btn btn-sm btn-light btn-active-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
								        <span class="svg-icon svg-icon-5 m-0">
								        	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								        		<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black"></path>
								        	</svg>
								        </span>
								        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true" style="">
											<div class="menu-item px-3">
												<a href="#" onClick="resoluReclamation('.$problem['problem_id'].')" class="menu-link px-3">Résolu</a>
											</div>
											<div class="menu-item px-3">
												<a href="#" onClick="annuleReclamation('.$problem['problem_id'].')" class="menu-link px-3">Annulé</a>
											</div>
								        </div>
							        </td>
									
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