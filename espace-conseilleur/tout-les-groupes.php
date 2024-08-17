<?php
require_once("../header.php");
if(!isConseilleur())
{
	echo '<script>location.replace("../404.php")</script>';
}
$QueryGetGroupes = mysqli_query($connect, "SELECT groupe_id, groupe_nom FROM groupes");
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div id="kt_content_container" class="container-fluid">
		<div class="card">
			<div class="card-header border-0 pt-6">
				<div class="card-title">

				</div>
				<div class="card-toolbar">
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
						<div class="fw-bolder me-5">
						<span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
					</div>
				</div>
			</div>
			<div class="card-body pt-0">
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_reclamations_table">
					<thead>
						<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
							<th class="min-w-125px">Groupe ID</th>
							<th class="min-w-125px">Groupe Nom</th>
						</tr>
					</thead>
					<tbody class="fw-bold text-gray-600">
						<?php
							if(mysqli_num_rows($QueryGetGroupes) > 0)
							{
								while($groupe = mysqli_fetch_assoc($QueryGetGroupes))
								{
									echo '<tr>
									<td>
										<a href="view-groupe?groupeID='.$groupe['groupe_id'].'">#GROUPE-'.$groupe['groupe_id'].'</a>
									</td>
									<td>'.$groupe['groupe_nom'].'</td>
								';
								}
							}
						?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
require_once("../footer.php");
?>