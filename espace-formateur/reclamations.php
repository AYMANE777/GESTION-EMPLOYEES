<?php
require_once("../header.php");
$groupeID = $_SESSION['groupe_id'];
$Query = mysqli_query($connect, "SELECT problem_id, titre, type, content, date_reclamation, statut, stagiaires.nom AS stagiaireNom, stagiaires.prenom AS stagiairePrenom
FROM problemes 
INNER JOIN stagiaires
ON problemes.stagiaire_mat = stagiaires.matricule
WHERE groupe_id='$groupeID' ORDER BY problem_id DESC");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="card">
		    <div class="card-header border-0 pt-6">
		    	<div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
				        	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				        		<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
				        		<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
				        	</svg>
				        </span>
                        <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Rechercher une réclamation" />
                    </div>
                    <div id="kt_datatable_reclamations_export" class="d-none"></div>
		    	</div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <span class="svg-icon svg-icon-2">
	                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
	                    	<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black"></rect>
	                    	<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black"></path>
	                    	<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
	                    </svg>
	                </span>
                    Exporter un rapport
                    </button>
                    <div id="kt_datatable_reclamations_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                         <a href="#" class="menu-link px-3" data-kt-export="copy">
                         Copier dans le presse-papier
                         </a>
                        </div>
                        <div class="menu-item px-3">
                         <a href="#" class="menu-link px-3" data-kt-export="excel">
                         Exporter au format Excel
                         </a>
                        </div>
                        <div class="menu-item px-3">
                         <a href="#" class="menu-link px-3" data-kt-export="csv">
                         Exporter au format CSV
                         </a>
                        </div>
                        <div class="menu-item px-3">
                         <a href="#" class="menu-link px-3" data-kt-export="pdf">
                         Exporter au format PDF
                         </a>
                        </div>
                    </div>
                </div>
		    </div>
		    <div class="card-body pt-0">
		    	<div id="kt_reclamations_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_reclamations_table">
		    		    <thead>
		    		    	<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0"><th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.25px;">
		    		    			<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
		    		    				<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_reclamations_table .form-check-input" value="1">
		    		    			</div>
		    		    		</th>
                                <th class="min-w-125px sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 219.109px;">Réclamation ID</th>
                                <th class="min-w-125px sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 286.188px;">Titre</th>
                                <th class="min-w-125px sorting" tabindex="0"  rowspan="1" colspan="1"  style="width: 216.328px;">Statut</th>
                                <th class="min-w-125px sorting" tabindex="0"  rowspan="1" colspan="1"  style="width: 216.328px;">Type</th>
                                <th class="min-w-125px sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 216.328px;">Stagiaire</th>
                                <th class="min-w-125px sorting" tabindex="0"  rowspan="1" colspan="1"  style="width: 279.766px;">Date de reclamation</th>
                                <th class="text-end min-w-70px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 170.531px;">Actions</th></tr>
		    		    </thead>
		    		    <tbody class="fw-bold text-gray-600">
                        <?php
                            if(mysqli_num_rows($Query) > 0)
                            {
                               while($problem = mysqli_fetch_assoc($Query))
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
                                       <div class="form-check form-check-sm form-check-custom form-check-solid">
                                           <input class="form-check-input" type="checkbox" value="1">
                                       </div>
                                   </td>
                                   <td>
                                       <a href="view-reclamation?problem-id='.$problem['problem_id'].'" class="text-gray-800 text-hover-primary mb-1">#RECLAMATION-'.$problem['problem_id'].'</a>
                                   </td>
                                   <td>
                                       <a href="#" class="text-gray-600 text-hover-primary mb-1">'.$problem['titre'].'</a>
                                   </td>
                                   <td>
                                       <div class="badge badge-light-'.$badge_class.'">'.$problem['statut'].'</div>
                                   </td>
                                   <td>
                                        <span class="badge badge-dark">'.$problem['type'].'</span>
                                   </td>
                                   <td>'.$problem['stagiairePrenom'].' '.$problem['stagiaireNom'].'</td>
                                   <td>'.dateToFrench($problem['date_reclamation'], "l j F Y H:i").'</td>
                                   <td class="text-end">
                                       <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                       <span class="svg-icon svg-icon-5 m-0">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                               <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                           </svg>
                                       </span>
                                       </a>
                                       <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                           <div class="menu-item px-3">
                                               <a href="view-reclamation?problem-id='.$problem['problem_id'].'" class="menu-link px-3">Examiner</a>
                                           </div>
                                           <div class="menu-item px-3">
                                               <a href="#" onclick="removeProblem('.$problem['problem_id'].')" class="menu-link px-3" >Supprimer</a>
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
</div>
<?php
require_once("../footer.php");
?>