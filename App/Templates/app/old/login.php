<!DOCTYPE html>
<html>
	<title>OS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.min.css">


	<body>
	<div class="container">	
		<div class="row">
			<div class="col-md-4"></div>

			<div class="col-md-4">
				<form action="login" method="POST" style="margin:50px;">
				
					<h4 style="color:gray;">Auth Form</h4>
					<input type="text" placeholder="account-id" name="account_id" required><br><br>

					<input type="password" placeholder="password" name="password" required><br><br>

					<button class="btn btn-default" type="submit">Login</button>

				</form>
			</div>

			<div class="col-md-4"></div>
		</div>
	</div>
	</body>
</html>


