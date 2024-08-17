<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
		<!--begin::Inbox App - Compose -->
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Sidebar-->
			<div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 mb-lg-0">
				<!--begin::Sticky aside-->
				<?php 
                    require_once("../includes/sidebars/messages-sidebar.php");
                ?>
				<!--end::Sticky aside-->
			</div>
			<!--end::Sidebar-->
			<!--begin::Content-->
			<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
				<!--begin::Card-->
				<div class="card">
					<div class="card-header align-items-center">
						<div class="card-title">
							<h2>Composer un message</h2>
						</div>
					</div>
					<div class="card-body p-0">
						<!--begin::Form-->
						<form id="kt_inbox_compose_form">
							<!--begin::Body-->
							<div class="d-block">
								<!--begin::To-->
								<div class="d-flex align-items-center border-bottom px-8 min-h-50px">
									<!--begin::Label-->
									<div class="text-dark fw-bolder w-75px">À:</div>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" id="searchFormateur" class="form-control form-control-transparent border-0" name="compose_to" value="" data-kt-inbox-form="tagify" />
									<!--end::Input-->
								</div>
								<!--end::BCC-->
								<!--begin::Subject-->
								<div class="border-bottom">
									<input class="form-control form-control-transparent border-0 px-8 min-h-45px" id="subject" name="compose_subject" placeholder="Sujet" />
								</div>
								<!--end::Subject-->
								<!--begin::Message-->
								<div id="kt_inbox_form_editor" class="bg-transparent border-0 h-350px px-3"></div>
							</div>
							<!--end::Body-->
							<!--begin::Footer-->
							<div class="d-flex flex-stack flex-wrap gap-2 py-5 ps-8 pe-5 border-top">
								<!--begin::Actions-->
								<div class="d-flex align-items-center me-3">
									<!--begin::Send-->
									<div class="btn-group me-4">
										<!--begin::Submit-->
										<button type="button" id="sendMessage" class="btn btn-primary fs-bold px-6">
											<span id="span-send" class="indicator-label">Envoyer</span>
											<span id="span-progress" class="indicator-progress">En cours de traitement... 
											<span id="span-send-spinner" class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
										<!--end::Submit-->
									</div>
									<!--end::Send-->
								</div>
								<!--end::Actions-->
							</div>
							<!--end::Footer-->
						</form>
						<!--end::Form-->
					</div>
				</div>
				<!--end::Card-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Inbox App - Compose -->
	</div>
</div>
<input type="hidden" id="newMessage" value="stagiaire-message">
<?php
require_once("../footer.php");
?>