<?php
require_once("../header.php");
$QueryGetTutos = mysqli_query($connect, "SELECT * FROM tutorials");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="card">
			<div class="card-body p-10 p-lg-15">
				<div class="mb-13">
					<div class="mb-15">
						<h4 class="fs-2x text-gray-800 w-bolder mb-6">Les Supports</h4>
					</div>
				</div>
				<?php
					if(mysqli_num_rows($QueryGetTutos) > 0)
					{
						while($tuto = mysqli_fetch_assoc($QueryGetTutos))
						{
							echo '<div class="mb-17">
							<div class="separator separator-dashed mb-9"></div>
							<div class="row g-10">						
								<div class="col-md-4">
									<div class="card-xl-stretch ms-md-6">
										<a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url(\'../assets/media/svg/tutorial.svg\')" data-fslightbox="lightbox-video-tutorials" href="'.$tuto['youtube'].'">
											<img src="../assets/media/svg/misc/video-play.svg" class="position-absolute top-50 start-50 translate-middle" alt="">
										</a>
										<div class="m-0">
											<a href="#" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">'.$tuto['title'].'</a>
											<div class="fw-bold fs-5 text-gray-600 text-dark my-4">'.$tuto['description'].'</div>
										</div>
									</div>
								</div>
							</div>
						</div>';
						}
					}else{
						echo '<div class="alert alert-warning">
						<span class="svg-icon svg-icon-2hx svg-icon-warning me-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"/>
<rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(-45 9 13.0283)" fill="black"/>
<rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(45 9.86664 7.93359)" fill="black"/>
</svg></span>		<span>Aucun support trouvé!</span>			
					</div>';
					}
				?>
				
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>