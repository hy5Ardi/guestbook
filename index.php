<?php

	include __DIR__.'/inc/db.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<title>HY5 │ Guestbook</title>

		<link rel="stylesheet" href="https://hy5ardi.xyz/guestbook/assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:700,400,300">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script>
		$(document).ready(function(){
    		$('[data-toggle="tooltip"]').tooltip();
		});
		</script>
	</head>
	<body>
		<div class="container">
			<form class="form-horizontal" action="/guestbook/inc/post.php" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-1" for="username">Username:</label>
					<div class="col-sm-5">
						<input type="username" name="username" class="form-control" id="username" placeholder="Enter username">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-1" for="message">Message:</label>
					<div class="col-sm-5">
						<input type="message" name="message" class="form-control" id="message" placeholder="Enter message">
					</div>				
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-5">
						<button type="submit" class="btn btn-primary">Submit »</button>
					</div>
				</div>
			</form>
			<?php

				$fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

				if (strpos($fullUrl, "post=2long") == true) {
					echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					echo '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your message was too long.';
					echo '</div>';
				} else if (strpos($fullUrl, "post=empty") == true) {
					echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					echo '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> You did not enter in all the required info.';
					echo '</div>';
				} else if (strpos($fullUrl, "post=success") == true) {
					echo '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					echo '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your post has been successfully added.';
					echo '</div>';
				}

			?>
			<hr>
		</div>
		<?php

			$sql = "SELECT * FROM guestbook ORDER BY id DESC";
			$result = $dbConn->query($sql);

			if ($result->num_rows > 0) {
				echo '<div class="container"><table class="table table-striped"><tbody>';
				while ($row = $result->fetch_assoc()) {
					echo '<tr><td><a data-toggle="tooltip" data-placement="top" title="' . $row['date'] . ' - ' . $row['time'] .'"><b>' . $row['username'] . '</b></a>: ' . $row['message'] . '</td></tr>';
				}
				echo '</tbody></table></div>';
			} else {
				echo '<div class="container"><div class="alert alert-info">';
				echo '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> No posts were found.';
				echo '</div></div>';
			}

		?>
	</body>
</html>