<?php
require_once("../header.php");
if(!isConseilleur())
{
	echo '<script>location.replace("../404.php")</script>';
}

if(isset($_POST['doUpload']))
{
    $target_dir = "../includes/";
    $target_file = $target_dir . basename($_FILES["importfile"]["name"]);
 
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 
    $uploadOk = 1;
    if($imageFileType != "csv" ) {
      $uploadOk = 0;
    }
 
    if ($uploadOk != 0) {
       if (move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_dir.'stagiaires.csv')) {
 
         $target_file = $target_dir . 'stagiaires.csv';
         if (file_exists($target_file)) {
            $file = fopen($target_file,"r");
            $i = 0;
            $importData_arr = array();
                        
             while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
                 $data = array_map("utf8_encode", $data);
                 $num = count($data);
              
                 for ($c=0; $c < $num; $c++) {
                     $importData_arr[$i][] = mysqli_real_escape_string($conn, $data[$c]);
                 }
                 $i++;
            }
            fclose($file);
 
            $skip = 0;
            // insert import data
            foreach($importData_arr as $data){
               if($skip != 0){
                  $Dept = $data[0];
                  $Code_EFP = $data[1];
                  $EFP = $data[2];
                  $Niveau = $data[3];
                  $Code_Filiere = $data[4];
                  $Filiere = $data[5];
                  $Type_Formation = $data[6];
                  $Groupe = $data[7];
                  $Annee_etude = $data[8];
                  $Numero_stagiaire = $data[9];
                  $Nom = $data[10];
                  $Prénom = $data[11];
                   $sql = "SELECT count(*) as allcount from stagiaires WHERE matricule='".$Numero_stagiaire."'";
                  $retrieve_data = $conn->query($sql);
                  $row = mysqli_fetch_array($retrieve_data);
                  $count = $row['allcount'];
                 
                  if($count == 0){
 
                  }
                  
               }
               $skip ++;
            }
            $newtargetfile = $target_file;
            if (file_exists($newtargetfile)) {
               unlink($newtargetfile);
            }
          }
 
       }
    }
}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div id="kt_content_container" class="container-fluid">
        <div class="card">
			<div class="card-header border-0 pt-6">
				<div class="card-title">
                    Importer un fichier CSV des stagiaires
				</div>
            </div>
            <div class="card-body pt-0">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-10">
				    	<label class="form-label">Fichier CSV:</label>
				    	<input type="file" name="importfile" class="form-control form-control-flush">
				    </div>
                    <div class="mb-10">
                        <input type="submit" name="doUpload" class="btn btn-primary" value="Importer"/>
                    </div>
                </form>
                
            </div>   
         </div>
	</div>
</div>
<?php
require_once("../footer.php");
?>