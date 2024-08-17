<?php
require_once("../header.php");

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">	
		<div class="card card-flush">
			<div class="card-body pt-0">
				<div class="card-title">
   					<div class="d-flex align-items-center position-relative my-1">
   						<span class="svg-icon svg-icon-1 position-absolute ms-6">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
									<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
								</svg>
						</span>
   						<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Rechercher un engagement" />
   					</div>
  				</div>
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_reclamations_table">
					<thead>
						<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
							<th class="min-w-100px">Date</th>
							<th class="min-w-100px">Stagiaire</th>
							<th class="min-w-100px">Formateur</th>
							<th class="min-w-100px">Numéro d'engagement</th>
                            <th class="text-end min-w-70px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 170.531px;">Actions</th>
						</tr>
					</thead>
					<tbody class="fw-bold text-gray-600">
                        <?php
                            $SQLGetEngagements = mysqli_query($connect, "SELECT eng_id, date_creation, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom, formateurs.nom as formateurNom, formateurs.prenom as formateurPrenom 
                            FROM engagements 
                            INNER JOIN stagiaires 
                            on stagiaires.matricule = engagements.stagiaire_mat 
                            INNER JOIN formateurs 
                            on formateurs.groupe_id = engagements.groupe_id");
                            if(mysqli_num_rows($SQLGetEngagements) > 0)
                            {
                                while($eng = mysqli_fetch_assoc($SQLGetEngagements))
                                {
                                    echo '<tr>
                                    <td>'.$eng['date_creation'].'</td>
                                    <td>'.$eng['stagiaireNom'].' '.$eng['stagiairePrenom'].'</td>
                                    <td>'.$eng['formateurNom'].' '.$eng['formateurPrenom'].'</td>
                                    <td>
                                        <div class="badge badge-primary">#ENG-'.$eng['eng_id'].'</div>
                                    </td>
                                    <td class="text-end">
								        <a href="#" class="btn btn-sm btn-light btn-active-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
								        <span class="svg-icon svg-icon-5 m-0">
								        	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								        		<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black"></path>
								        	</svg>
								        </span>
								        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true" style="">
								        	<div class="menu-item px-3">
								        		<a href="view-engagement?eng_id='.$eng['eng_id'].'" class="menu-link px-3">Examiner</a>
								        	</div>
								        	<div class="menu-item px-3">
								        		<a href="#" onclick="removeEngagement('.$eng['eng_id'].');" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Supprimer</a>
								        	</div>
								        </div>
							        </td>
                                </tr>';
                                }
                            }else{
                                echo $connect->error;
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