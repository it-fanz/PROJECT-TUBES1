<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- Custom styles for this template -->
<link href="bootstrap/css/offcanvas.css" rel="stylesheet">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/jquery.min.js"></script>

<?php
	$fh = fopen("poskerja.txt", "r");
	
	while(!feof($fh)){
		$current = trim(fgets($fh));
		$iArray[] = explode("*", $current);
	}
	$count = count($iArray);
	for($x=0; $x<$count; $x++){
		$newArray[$x]["title"] = $iArray[$x][0];
		$newArray[$x]["link"] = $iArray[$x][1];
		$newArray[$x]["ContinueText"] = $iArray[$x][2];
		$newArray[$x]["ContinueLink"] = $iArray[$x][3];
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pos Kerja</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">	
		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-xs-12 col-sm-9">
				<div class="jumbotron">
					<h1>POS KERJA</h1>
					<p class="lead blog-description">Single Page Parsing Data Using PHP with Bootstrap Implementation</p>
				</div>
				
				<?php
					$i=1;
					$limit=2;
					echo '<div class="row">';
					foreach($newArray as $new){
						$string = '';
						$string_limit = '';
						echo '<div class="col-6 col-sm-6 col-lg-4">';
						$string = $new['title'];
						$string_limit = implode(" ", array_slice(explode(" ", $string),0,$limit));
						echo '<h3>' .$string_limit. '</h3>';
						echo '<p>' .$new['title']. '</p>';
						echo '<p><a class="btn btn-default" role="button"
								 target="_blank" href="' .$new['ContinueLink'].$new['ContinueText'].'">View Details</a></p>';
						echo '</div>';
						$i+=1;
					}
					echo '</div>';
				?>
			</div>
			
			<div id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
				<div class="list-group">
					<?php
						$i=1;
						foreach($newArray as $new){
							if($i<7){
								echo '<a class="list-group-item" target="_blank" href="' .$new['link']. '"><h4>' .$new['title']. '</h4></a>';
							}
							$i+=1;
						}
					?>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
