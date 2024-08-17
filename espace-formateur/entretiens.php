<?php
require_once("../header.php");
$matricule = $user->getMatricule();
$Query = mysqli_query($connect, "SELECT entretien_id, stagiaires.nom AS stagiaireNom, stagiaires.prenom AS stagiairePrenom, type, outil, date_entretien, heure_debut, heure_fin, subject
FROM entretiens
INNER JOIN stagiaires
ON entretiens.stagiaire_mat = stagiaires.matricule
WHERE formateur_mat ='$matricule'");

$groupeid = $_SESSION['groupe_id'];

$QueryGetStagiaires = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id = '$groupeid'");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div id="kt_content_container" class="container-fluid">
		<div class="d-flex flex-column flex-xl-row">
			<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
				<div class="card">
					<div class="card-body pt-4">
						<div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Stagiaire:</label>
								<div class="input-group mb-5">
									<select class="form-select" id="stagiaire" data-control="select2" data-placeholder="Rechercher votre stagiaire ">
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
			   				<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Sujet:</label>
								<div class="input-group mb-5">
									<span class="input-group-text">
										<span class="svg-icon svg-icon-muted svg-icon-1hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M16.163 17.55C17.0515 16.6633 17.6785 15.5488 17.975 14.329C18.2389 13.1884 18.8119 12.1425 19.631 11.306L12.694 4.36902C11.8574 5.18796 10.8115 5.76088 9.67099 6.02502C8.15617 6.3947 6.81277 7.27001 5.86261 8.50635C4.91245 9.74268 4.41238 11.266 4.44501 12.825C4.46196 13.6211 4.31769 14.4125 4.0209 15.1515C3.72412 15.8905 3.28092 16.5617 2.71799 17.125L2.28699 17.556C2.10306 17.7402 1.99976 17.9897 1.99976 18.25C1.99976 18.5103 2.10306 18.7598 2.28699 18.944L5.06201 21.719C5.24614 21.9029 5.49575 22.0062 5.75601 22.0062C6.01627 22.0062 6.26588 21.9029 6.45001 21.719L6.88101 21.288C7.44427 20.725 8.11556 20.2819 8.85452 19.9851C9.59349 19.6883 10.3848 19.5441 11.181 19.561C12.1042 19.58 13.0217 19.4114 13.878 19.0658C14.7343 18.7201 15.5116 18.2046 16.163 17.55Z" fill="black"/>
												<path d="M19.631 11.306L12.694 4.36902L14.775 2.28699C14.9591 2.10306 15.2087 1.99976 15.469 1.99976C15.7293 1.99976 15.9789 2.10306 16.163 2.28699L21.713 7.83704C21.8969 8.02117 22.0002 8.27075 22.0002 8.53101C22.0002 8.79126 21.8969 9.04085 21.713 9.22498L19.631 11.306ZM13.041 10.959C12.6427 10.5604 12.1194 10.3112 11.5589 10.2532C10.9985 10.1952 10.4352 10.332 9.96375 10.6405C9.4923 10.949 9.14148 11.4105 8.97034 11.9473C8.79919 12.4841 8.81813 13.0635 9.02399 13.588L2.98099 19.631L4.36899 21.019L10.412 14.975C10.9364 15.1816 11.5161 15.2011 12.0533 15.0303C12.5904 14.8594 13.0523 14.5086 13.361 14.037C13.6697 13.5654 13.8065 13.0018 13.7482 12.4412C13.6899 11.8805 13.4401 11.357 13.041 10.959Z" fill="black"/>
											</svg>
										</span>
									</span>
									<input type="text" class="form-control" id="subject">
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Déscription:</label>
								<div class="input-group mb-5">
									<span class="input-group-text">
										<span class="svg-icon svg-icon-muted svg-icon-1hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"/>
												<path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"/>
												<path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"/>
											</svg>
										</span>
									</span>
									<textarea class="form-control" id="description" style="height: 100px"></textarea>
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Type:</label>
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
									<select class="form-select" id="type">
										<option value="Physique">Physique</option>
										<option value="À Distance">À Distance</option>
									</select>
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Outil:</label>
								<div class="input-group mb-5">
									<span class="input-group-text">
										<span class="svg-icon svg-icon-muted svg-icon-1hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="black"/>
												<path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="black"/>
											</svg>
										</span>
									</span>
									<input type="text" class="form-control" id="tool">
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Date d'entretien:</label>
								<div class="input-group mb-5">
									<span class="input-group-text">
										<i class="fa fa-calendar"></i>
									</span>
									<input type="date" class="form-control" id="date">
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Heure de début et fin:</label>
								<div class="input-group mb-5">
									<span class="input-group-text">
										<i class="fa fa-clock"></i>
									</span>
									<input type="time" class="form-control" id="startTime">
								</div>
								<div class="input-group mb-5">
									<span class="input-group-text">
										<i class="fa fa-clock"></i>
									</span>
									<input type="time" class="form-control" id="endTime">
								</div>
							</div>
			   			</div>
					</div>
					<div class="card-footer border-0 d-flex justify-content-center pt-0">
						<button style="padding-left: 40px; padding-right: 40px;" class="btn btn-sm btn-light-primary" id="addEntretien">Ajouter</button>
					</div>
				</div>
			</div>
			<div class="flex-lg-row-fluid ms-lg-15">
				<div class="card mb-8">
				<div class="card-header border-0 pt-6">

		    </div>
					<div class="card-body pt-4">
					<div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="table-responsive">
						<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
		    			    <thead>
		    			    	<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0"><th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.25px;">
		    			    			<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
		    			    				<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1">
		    			    			</div>
		    			    		</th>
                    	            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1"  style="width: 219.109px;">Entretien ID</th>
                    	            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1" style="width: 286.188px;">Stagiaire</th>
                    	            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1"  style="width: 216.328px;">Sujet</th>
                    	            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1" colspan="1"  style="width: 216.328px;">Date Entretien</th>
                    	            <th class="text-end min-w-70px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 170.531px;">Actions</th></tr>
		    			    </thead>
		    			    <tbody class="fw-bold text-gray-600">
                    	    <?php
                    	        if(mysqli_num_rows($Query) > 0)
                    	        {
                    	           while($entretien = mysqli_fetch_assoc($Query))
                    	           {
                    	               echo '<tr>
                    	               <td>
                    	                   <div class="form-check form-check-sm form-check-custom form-check-solid">
                    	                       <input class="form-check-input" type="checkbox" value="1">
                    	                   </div>
                    	               </td>
                    	               <td>
                    	                   <a href="view-entretien?id='.$entretien['entretien_id'].'" class="text-gray-800 text-hover-primary mb-1">#ENTRETIEN-'.$entretien['entretien_id'].'</a>
                    	               </td>
                    	               <td>
                    	                   <a href="#" class="text-gray-600 text-hover-primary mb-1">'.$entretien['stagiairePrenom'].' '.$entretien['stagiaireNom'].'</a>
                    	               </td>
                    	               <td>
                    	                   '.$entretien['subject'].'
                    	               </td>
                    	               <td>
									   		'.dateToFrench($entretien['date_entretien'], "l j F Y H:i").'
                    	               </td>
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
                    	                           <a href="view-entretien?id='.$entretien['entretien_id'].'" class="menu-link px-3">Examiner</a>
                    	                       </div>
                    	                       <div class="menu-item px-3">
                    	                           <a href="#" onclick="removeEntretien('.$entretien['entretien_id'].')" class="menu-link px-3" >Supprimer</a>
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
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>