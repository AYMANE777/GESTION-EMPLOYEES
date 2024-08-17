<?php
require_once("../header.php");
if(!isset($_GET['problem-id']))
{
    echo '<script>location.replace("reclamations")</script>';
}else{
    $problem_id = $_GET['problem-id'];
}

if(!checkProblemID($problem_id))
{
    echo '<script>location.replace("reclamations")</script>';
}

$QueryGetProblem = mysqli_query($connect, "SELECT *, stagiaires.nom as stagiaireNom, stagiaires.prenom as stagiairePrenom FROM problemes 
INNER JOIN stagiaires
ON problemes.stagiaire_mat = stagiaires.matricule
WHERE problem_id = $problem_id");
$problem = mysqli_fetch_assoc($QueryGetProblem);

$_SESSION['problem-id'] = $problem_id;

$QueryGetReplies = mysqli_query($connect, "SELECT * FROM problemes_replies WHERE problem_id=$problem_id ORDER BY problem_reply_id DESC");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div id="kt_content_container" class="container-fluid">
       
                        <div class="card">
		                	<div class="card-body">
		                		<div class="d-flex flex-column flex-xl-row p-7" data-select2-id="select2-data-210-xvms">
		                			<div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0" data-select2-id="select2-data-209-3ehh">
                                    <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
		                    <a href="reclamations" class="btn btn-icon btn-light-primary btn-sm ms-auto me-lg-n7">
		                    	<span class="svg-icon svg-icon-2">
		                    		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
		                    			<path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black"></path>
		                    		</svg>
		                    	</span>
		                    </a>
		                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
		                	<span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 15" fill="none">
                                <rect y="6" width="16" height="3" rx="1.5" fill="black"/>
                                <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="black"/>
                                <rect opacity="0.3" width="12" height="3" rx="1.5" fill="black"/>
                            </svg>
		                	</span>
		                	Modifier</button>
		                	<div id="kt_ecommerce_report_returns_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
		                		<div class="menu-item px-3">
		                			<a href="#" onClick="changeReclamationStatus(1)" class="menu-link px-3">Résolu</a>
		                		</div>
		                		<div class="menu-item px-3">
		                			<a href="#" onClick="changeReclamationStatus(2)" class="menu-link px-3">Annulé</a>
		                		</div>
		                	</div>
		                </div>
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
										<a href="#" class="text-muted text-hover-primary"><?php echo $problem['stagiairePrenom'] . " " . $problem['stagiaireNom']; ?></a></span>
										<span class="fw-bold text-muted">Créé: 
										<span class="fw-bolder text-gray-600 me-1"><?php echo format_time_ago($problem['date_reclamation']); ?></span> (<?php echo $problem['date_reclamation']; ?>)</span>
                                        <?php 
                                        if($problem['statut'] == "Résolu")
                                        {
                                            echo '<span class="badge badge-success">'.$problem['statut'].'</span>';
                                        }else if($problem['statut'] == "Annulé")
                                        {
                                            echo '<span class="badge badge-danger">'.$problem['statut'].'</span>';
                                        }else if($problem['statut'] == "En attente")
                                        {
                                            echo '<span class="badge badge-warning">'.$problem['statut'].'</span>';
                                        }
                                        ?>
                                        <span class="badge badge-primary"></span>
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
                                                $can_delete = '<div class="card-toolbar">
                                                <div class="m-0">
                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary me-n4" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                        <span class="svg-icon svg-icon-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black"></rect>
                                                                <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
                                                                <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
                                                                <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
                                                            </svg>
                                                        </span>
                                                    </button><div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true" style="">
                                                        <div class="menu-item px-3">
                                                            <span onclick="deleteReclamationReply('.$reply['problem_reply_id'].')" class="menu-link px-3">Supprimer</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                            }else{
                                                $senderID = $reply['sender_id'];
                                                $QueryGetFormateur = mysqli_query($connect, "SELECT * FROM stagiaires WHERE matricule='$senderID'");
                                                $formateur = mysqli_fetch_assoc($QueryGetFormateur);
                                                $sender_name = $formateur['prenom'] . " " . $formateur['nom'];
												$class_color = "danger";
                                                $can_delete = "";
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
                                                        '.$can_delete.'
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
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>