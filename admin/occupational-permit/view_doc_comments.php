<?php
include "../includes/auth.php";

if( isset($_GET['id'], $_GET['slug']) ) {
	
	$doc = $_GET['id'];
	$slug = $_GET['slug'];

	$sql = "SELECT * FROM attachments_remarks WHERE id = '$doc'";
	$res = mysqli_query($conn, $sql);
	if(($count = mysqli_num_rows($res)) > 0) {
		while($row = mysqli_fetch_assoc($res)) {
			$doc_dir = $row['folderDirectory'];
			$file = "../../uploads/". $doc_dir ."/".$slug;
			$type = mime_content_type($file);
			$size = filesize($file);

			if($type == 'application/pdf') {
				header("Content-type: application/pdf");  
				header("Content-Length: " . filesize($file)); 
				readfile($file);
			}

			else {
				header("Content-type: ". $type);  
				header("Content-Length: " . filesize($file)); 
				readfile($file);
			}
		}
	}
	else {
	?>
	<script>
		alert('Dont have any attachment yet.');
		this.close();
	</script>
	<?php
	}
}
?>