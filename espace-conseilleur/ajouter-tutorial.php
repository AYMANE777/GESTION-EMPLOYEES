<?php
require_once("../header.php");
if(!isConseilleur())
{
	echo '<script>location.replace("../404.php")</script>';
}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
		<div class="col-md-6 card">
			<div class="card-body">
                <div class="d-flex flex-column mb-8 fv-row">
					<label class="d-flex align-items-center fs-6 fw-bold mb-2">
						<span class="required">Titre de support:</span>
					</label>
					<input type="text" id="tuto-title" class="form-control form-control-solid" placeholder="Saisie votre titre" />
				</div>
                <div class="d-flex flex-column mb-8 fv-row">
					<label class="d-flex align-items-center fs-6 fw-bold mb-2">
						<span class="required">Lien de vidéo (Youtube):</span>
					</label>
					<input type="text" id="tuto-link" class="form-control form-control-solid" placeholder="Saisie votre lien" />
				</div>
                <div class="d-flex flex-column mb-8 fv-row">
					<label class="d-flex align-items-center fs-6 fw-bold mb-2">
						<span class="required">Déscription de support:</span>
					</label>
					<textarea id="tuto-description" cols="30" rows="10" class="form-control form-control-solid"></textarea>
				</div>
                <div class="text-center">
					<button type="button" id="addTuto" class="btn btn-primary">
						<span id="label-ajotuer" class="indicator-label">Ajouter</span>
						<span id="progress-tuto" class="indicator-progress">En cours de traitement... 
						<span id="spinner-tuto" class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>