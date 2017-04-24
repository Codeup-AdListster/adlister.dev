<!--Page for user account home-->
<?php

require_once __DIR__ . '/../../utils/Auth.php';
require_once __DIR__ . '/../../models/User.php';

if(Auth::check() !== true) {
	header("Location: http://adlister.dev/login");
	die();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Account Details</title>
</head>
<body>
	<h1 class="text-center">Account Info</h1>
<div class="container">

	

			<div class="row">
				<div class="col-md-6 col-md-offset-3">

	 <form method="POST" action="/account/edit" data-validation data-required-message="This field is required">

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= $user->name; ?>" data-required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $user->email; ?>" data-required>
                    </div>
                    <div class="form-group">
                        <?= $user->username; ?>
                    </div>
					<button type="submit" class="btn btn-primary">Edit Account</button>

				</form>
			</div>
		</div>
		
</div>
</body>
</html>