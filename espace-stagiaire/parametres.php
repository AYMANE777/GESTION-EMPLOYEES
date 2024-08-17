<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
    	<div class="card mb-5 mb-xl-10">
			<!--begin::Card header-->
			<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
				<!--begin::Card title-->
				<div class="card-title m-0">
					<h3 class="fw-bolder m-0">Paramètres du profil</h3>
				</div>
				<!--end::Card title-->
			</div>
			<!--begin::Card header-->
			<!--begin::Content-->
			<div id="kt_account_settings_profile_details" class="collapse show">
				<!--begin::Form-->
				<form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
					<!--begin::Card body-->
					<div class="card-body border-top p-9">
						<!--begin::Input group-->
						<div class="row mb-6">
							<!--begin::Label-->
							<label class="col-lg-4 col-form-label required fw-bold fs-6">Nom et Prénom</label>
							<!--end::Label-->
							<!--begin::Col-->
							<div class="col-lg-8">
								<!--begin::Row-->
								<div class="row">
									<!--begin::Col-->
									<div class="col-lg-6 fv-row fv-plugins-icon-container">
										<input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" style="cursor: not-allowed;" disabled placeholder="<?php echo $user->getNom(); ?>" value="<?php echo $user->getNom(); ?>">
									<div class="fv-plugins-message-container invalid-feedback"></div></div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-lg-6 fv-row fv-plugins-icon-container">
										<input type="text" name="lname" class="form-control form-control-lg form-control-solid" style="cursor: not-allowed;" disabled placeholder="<?php echo $user->getPrenom(); ?>" value="<?php echo $user->getPrenom(); ?>">
									<div class="fv-plugins-message-container invalid-feedback"></div></div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-6">
							<!--begin::Label-->
							<label class="col-lg-4 col-form-label required fw-bold fs-6">Nouveau mot de passe</label>
							<!--end::Label-->
							<!--begin::Col-->
							<div class="col-lg-8 fv-row fv-plugins-icon-container">
								<input type="password" id="newpass" required class="form-control" placeholder="">
							<div class="fv-plugins-message-container invalid-feedback"><div id="newpass-verification"></div></div></div>
							<!--end::Col-->
						</div>

						<div class="row mb-6">
							<!--begin::Label-->
							<label class="col-lg-4 col-form-label required fw-bold fs-6">Confirmer votre mot de passe</label>
							<!--end::Label-->
							<!--begin::Col-->
							<div class="col-lg-8 fv-row fv-plugins-icon-container">
								<input type="password" id="cnewpass" required class="form-control" placeholder="">
							<div class="fv-plugins-message-container invalid-feedback"><div id="cnewpass-verification"></div></div></div>
							<!--end::Col-->
						</div>
					</div>
					<!--end::Card body-->
					<!--begin::Actions-->
					<div class="card-footer d-flex justify-content-end py-6 px-9">
						<a href="profile" class="btn btn-light btn-active-light-primary me-2">Retour </a>
						<button type="button" class="btn btn-primary" id="doUpdatePassword">Sauvegarder les modifications</button>
					</div>
					<!--end::Actions-->
				<input type="hidden"><div></div></form>
				<!--end::Form-->
			</div>
			<!--end::Content-->
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>