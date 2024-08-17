<?php
require_once("includes/init.php");
if(LoggedIn() == 1)
{
	header("Location: espace-formateur/dashboard");
}else if(LoggedIn() == 2)
{
	header("Location: espace-stagiaire/dashboard");
}else if(LoggedIn() == 3)
{
	header("Location: espace-directeur/dashboard");
}else if(LoggedIn() == 4)
{
	header("Location: espace-conseilleur/dashboard");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo SITE_NAME; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="assets/media/favicon.ico" />
		<link rel="stylesheet" href="assets/css/fonts.css" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="auth-bg">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<a href="#" class="py-9 pt-lg-20">
								<img src="assets/media/logos/new-logo-white.png" alt="" class="h-80px">
								<hr style="background-color: white;">
								<img alt="Logo" src="assets/media/ofppt-logo.png" class="h-150px" />
							</a>
							<h1 class="fw-bolder text-white fs-2qx pb-5 pb-md-10">PARRAINAGE DES STAGIAIRES</h1>
							<p class="fw-bold fs-2 text-white">L'Office de la formation professionnelle et de promotion du travail</p>
						</div>
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-80px min-h-lg-350px" style="background-image: url(assets/media/illustrations/support.svg)"></div>
					</div>
				</div>
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<form class="form w-100">
								<div class="text-center mb-10">
									<h1 class="text-dark mb-3">Se connecter</h1>
								</div>
								<div class="fv-row mb-10">
									<label class="form-label fs-6 fw-bolder text-dark">Matricule ou CIN</label>
									<div class="input-group mb-5">
										<span class="input-group-text" id="basic-addon1">
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"></path>
													<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"></path>
												</svg>
											</span>
										</span>
										<input type="text" class="form-control" id="username" aria-describedby="basic-addon1">
									</div>
                                    <div class="fv-plugins-message-container invalid-feedback"><div id="username-verification"></div></div>
								</div>
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Mot de passe</label>
										<!--end::Label-->
										<!--begin::Link-->
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<div class="input-group mb-5">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-lock"></i>
										</span>
										<input type="password" class="form-control" id="password" aria-describedby="basic-addon1">
									</div>
                                    <div class="fv-plugins-message-container invalid-feedback"><div id="password-verification"></div></div>
									<!--end::Input-->
								</div>

                                <div class="fv-row mb-10">
									<div class="d-flex flex-stack mb-2">
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Se connecter en tant que</label>
									</div>
									<div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-2 g-1">
										<div class="col">
											<label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-3 mb-5">
												<div class="d-flex align-items-center me-2">
													<div class="form-check form-check-custom form-check-solid form-check-primary me-6">
														<input class="form-check-input" type="radio" name="type" value="2" />
													</div>
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">Stagiaire</h2>
													</div>
												</div>
											</label>
										</div>
										<div class="col">
											<label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-3 mb-5">
												<div class="d-flex align-items-center me-2">
													<div class="form-check form-check-custom form-check-solid form-check-primary me-6">
														<input class="form-check-input" type="radio" name="type" value="1" />
													</div>
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">Formateur</h2>
													</div>
												</div>
											</label>
										</div>
									</div>
									<div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-2 g-1">
										<div class="col">
											<label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-3 mb-5">
												<div class="d-flex align-items-center me-2">
													<div class="form-check form-check-custom form-check-solid form-check-primary me-6">
														<input class="form-check-input" type="radio" name="type" value="3" />
													</div>
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">Directeur</h2>
													</div>
												</div>
											</label>
										</div>
										<div class="col">
											<label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-3 mb-5">
												<div class="d-flex align-items-center me-2">
													<div class="form-check form-check-custom form-check-solid form-check-primary me-6">
														<input class="form-check-input" type="radio" name="type" value="4" />
													</div>
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">Conseiller</h2>
													</div>
												</div>
											</label>
										</div>
									</div>
                                    <div class="fv-plugins-message-container invalid-feedback"><div id="type-verification"></div></div>
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								
								<div class="text-center">
									<!--begin::Submit button-->
									<button type="button" id="doLogin" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Connexion</span>
										<span class="indicator-progress">Veuillez Patienter... 
										<span id="loader-icon" class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<!--end::Submit button-->
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						<div class="d-flex flex-center fw-bold fs-6">
							<a href="index.php" class="text-muted text-hover-primary px-2">Accueil</a>
							<a href="#" class="text-muted text-hover-primary px-2">A propos</a>
						</div>
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
			</div>
		</div>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>