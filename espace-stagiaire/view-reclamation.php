<?php
require_once("../header.php");
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
if(!isset($_GET['problem-id']))
{
    echo '<script>location.replace("assistance")</script>';
}else{
    $problem_id = $_GET['problem-id'];
}

if(!checkProblemID($problem_id))
{
    echo '<script>location.replace("assistance")</script>';
}

$QueryGetProblem = mysqli_query($connect, "SELECT * FROM problemes WHERE problem_id = $problem_id");
$problem = mysqli_fetch_assoc($QueryGetProblem);

$_SESSION['problem-id'] = $problem_id;

$QueryGetReplies = mysqli_query($connect, "SELECT * FROM problemes_replies WHERE problem_id=$problem_id");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
        <div class="card">
			<div class="card-body">
				<div class="d-flex flex-column flex-xl-row p-7" data-select2-id="select2-data-210-xvms">
					<div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0" data-select2-id="select2-data-209-3ehh">
						<div class="mb-0" data-select2-id="select2-data-208-4ous">
							<div class="d-flex align-items-center mb-12">
								<span class="svg-icon svg-icon-4qx svg-icon-success ms-n2 me-3">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM11.7 17.7L16 14C16.4 13.6 16.4 12.9 16 12.5C15.6 12.1 15.4 12.6 15 13L11 16L9 15C8.6 14.6 8.4 14.1 8 14.5C7.6 14.9 8.1 15.6 8.5 16L10.3 17.7C10.5 17.9 10.8 18 11 18C11.2 18 11.5 17.9 11.7 17.7Z" fill="black"></path>
										<path d="M10.4343 15.4343L9.25 14.25C8.83579 13.8358 8.16421 13.8358 7.75 14.25C7.33579 14.6642 7.33579 15.3358 7.75 15.75L10.2929 18.2929C10.6834 18.6834 11.3166 18.6834 11.7071 18.2929L16.25 13.75C16.6642 13.3358 16.6642 12.6642 16.25 12.25C15.8358 11.8358 15.1642 11.8358 14.75 12.25L11.5657 15.4343C11.2533 15.7467 10.7467 15.7467 10.4343 15.4343Z" fill="black"></path>
										<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>
									</svg>
								</span>
								<div class="d-flex flex-column">
									<h1 class="text-gray-800 fw-bold"><?php echo $problem['titre']; ?></h1>
									<div class="">
										<span class="fw-bold text-muted me-6">Par:
										<a href="#" class="text-muted text-hover-primary"><?php echo $user->getPrenom() . " " . $user->getNom(); ?></a></span>
										<span class="fw-bold text-muted">Créé:
										<span class="fw-bolder text-gray-600 me-1"><?php echo format_time_ago($problem['date_reclamation']); ?></span> (<?php echo $problem['date_reclamation']; ?>)</span>
										<span class="badge badge-dark"><?php echo $problem['type']; ?></span>
									</div>
								</div>
							</div>
							<div class="mb-15" data-select2-id="select2-data-207-jama">
								<div class="mb-15 fs-5 fw-normal text-gray-800">
									<div class="mb-10"><?php echo $problem['content']; ?></div>
								</div>
								<hr>
								<div class="mb-0">
									<textarea id="problem-reply" class="form-control form-control-solid placeholder-gray-600 fw-bolder fs-4 ps-9 pt-7" rows="6" name="message" placeholder="Ajouter un commentaire" style="height: 165px;"></textarea>
									<button type="button" id="sendProblemReply" class="btn btn-primary mt-n20 mb-20 position-relative float-end me-7">Envoyer
                                    <span id="spinner-problem-reply" style="display: none;" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </button>
								</div>
							</div>
							<div class="mb-15">
                                <?php
                                    if(mysqli_num_rows($QueryGetReplies) > 0)
                                    {
                                        while($reply = mysqli_fetch_assoc($QueryGetReplies))
                                        {
                                            if($reply['sender_id'] == $user->getMatricule())
                                            {
                                                $sender_name = $user->getPrenom() . " " . $user->getNom();
												$class_color = "success";
                                            }else{
                                                $senderID = $reply['sender_id'];
                                                $QueryGetFormateur = mysqli_query($connect, "SELECT * FROM formateurs WHERE matricule='$senderID'");
                                                $formateur = mysqli_fetch_assoc($QueryGetFormateur);
                                                $sender_name = $formateur['prenom'] . " " . $formateur['nom'];
												$class_color = "danger";
                                            }

                                            echo '<div class="mb-9">
                                            <div class="card card-bordered w-100">
                                                <div class="card-body">
                                                    <div class="w-100 d-flex flex-stack mb-8">
                                                        <div class="d-flex align-items-center f">
                                                            <div class="symbol symbol-50px me-5">
                                                                <div class="symbol-label fs-1 fw-bolder bg-light-'.$class_color.' text-'.$class_color.'">'.substr($sender_name, 0, 1).'</div>
                                                            </div>
                                                            <div class="d-flex flex-column fw-bold fs-5 text-gray-600 text-dark">
                                                                <div class="d-flex align-items-center">
                                                                    <a href="#" class="text-gray-800 fw-bolder text-hover-primary fs-5 me-3">'.$sender_name.'</a>
                                                                    <span class="m-0"></span>
                                                                </div>
                                                                <span class="text-muted fw-bold fs-6">'.format_time_ago($reply['reply_date']).'</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fw-normal fs-5 text-gray-700 m-0">'.$reply['problem_reply'].'</p>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                ?>


							</div>
						</div>
					</div>
					<div class="flex-column flex-lg-row-auto w-100 mw-lg-300px mw-xxl-350px">
						<div class="position-relative mb-15">
							<button type="button" id="deleteProblem" class="btn btn-sm btn-primary my-1"><i class="fonticon-trash-bin"></i> Supprimer</button>
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
