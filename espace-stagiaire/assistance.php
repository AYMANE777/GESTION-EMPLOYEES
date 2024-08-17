<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
$matricule = $user->getMatricule();
$QueryGetProblems = mysqli_query($connect, "SELECT * FROM problemes WHERE stagiaire_mat='$matricule'");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="card mb-5 mb-xxl-10" data-select2-id="select2-data-212-27q4">
			<div class="card-header">
				<div class="card-title">
					<h3>Mes Réclamations</h3>
				</div>
				<div class="card-toolbar">
					<a href="#" class="btn btn-sm btn-primary my-1" data-bs-toggle="modal" data-bs-target="#modal_add_problem">Nouveau Réclamation</a>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
						<thead class="border-gray-200 fs-5 fw-bold bg-lighten">
							<tr>
								<th class="min-w-150px">Numéro de réclamation</th>
								<th class="min-w-250px">Titre</th>
								<th class="min-w-100px">Statut</th>
								<th class="min-w-100px">Type</th>
								<th class="min-w-150px">Date de réclamation</th>
							</tr>
						</thead>
						<tbody class="fw-6 fw-bold text-gray-600">
							<?php
								if(mysqli_num_rows($QueryGetProblems) > 0)
								{
									while($problem = mysqli_fetch_assoc($QueryGetProblems))
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
											<a href="view-reclamation?problem-id='.$problem['problem_id'].'" class="text-hover-primary text-gray-600">#RECLAMATION-'.$problem['problem_id'].'</a>
										</td>
										<td>'.$problem['titre'].'</td>
										<td>
											<span class="badge badge-'.$badge_class.' fs-7 fw-bolder">'.$problem['statut'].'</span>
										</td>
										<td>
											<span class="badge badge-dark">'.$problem['type'].'</span>
										</td>
										<td>'.format_time_ago($problem['date_reclamation']).'</td>
									</tr>';

									}
								}else{?>
								<div style="margin-left:30px;margin-right:30px;margin-top:30px;margin-bottom:30px;" class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
										<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z" fill="black"></path>
												<path d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z" fill="black"></path>
											</svg>
										</span>
										<div class="d-flex flex-stack flex-grow-1">
											<div class="fw-bold">
												<div class="fs-6 text-gray-700">Vous n'avez aucun réclamation.</div>
											</div>
										</div>
									</div>
								<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal_add_problem" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content rounded">
					<!--begin::Modal header-->
					<div class="modal-header pb-0 border-0 justify-content-end">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--begin::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
						<!--begin:Form-->
						<form id="kt_modal_new_target_form" class="form" action="#">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<!--begin::Title-->
								<h1 class="mb-3">Nouveau Réclamation</h1>
								<!--end::Title-->
								<!--begin::Description-->
								<div class="text-muted fw-bold fs-5">Ce formulaire vous permet de déclarer votre réclamation et d'obtenir une solution 
								<span class="fw-bolder link-primary">le plus rapidement possible</span>.</div>
								<!--end::Description-->
							</div>
							<div class="d-flex flex-column mb-8 fv-row">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Titre de votre réclamation</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Ce titre permet au responsable de se faire une idée préalable de votre problème"></i>
								</label>
								<input type="text" id="claim-title" class="form-control form-control-solid" placeholder="Saisie votre titre" name="target_title" />
								<div class="fv-plugins-message-container invalid-feedback"><div id="claim-title-verification"></div></div>
							</div>
							<div class="d-flex flex-column mb-8">
								<label class="fs-6 fw-bold mb-2">Détails du réclamation
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Ce sera formidable si vous décrivez votre problème avec des détails pour faciliter l'obtention de votre solution"></i>
								</label>
								<textarea id="claim-content" class="form-control form-control-solid" rows="3" name="target_details" placeholder="Saisie votre détails de probléme"></textarea>
								<div class="fv-plugins-message-container invalid-feedback"><div id="claim-content-verification"></div></div>
							</div>
							<div class="d-flex flex-column mb-8 fv-row">
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Type de réclamation</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Ce titre permet au responsable de se faire une idée préalable de votre problème"></i>
								</label>
								<select class="form-select form-select-solid" id="type" data-control="select2" data-dropdown-css-class="w-200px" data-placeholder="Choisie votre type de réclamation" data-hide-search="true">
									<option value="Technique">Technique</option>
									<option value="Pédagogique">Pédagogique</option>
									<option value="Social">Social</option>
									<option value="Administratif">Administratif</option>
									<option value="Autre">Autre</option>
								</select>
								<div class="fv-plugins-message-container invalid-feedback"><div id="claim-title-verification"></div></div>
							</div>
							
							<div class="text-center">
								<button type="button" id="sendClaim" class="btn btn-primary">
									<span id="label-claim" class="indicator-label">Reclamer</span>
									<span id="progress-claim" class="indicator-progress">En cours de traitement... 
									<span id="spinner-claim" class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
							<!--end::Actions-->
						</form>
						<!--end:Form-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
</div>
<?php
require_once("../footer.php");
?>