<?php
	include('administration.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Unicef Xmas 2015</title>

		<!-- Bootstrap -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/style.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container-fluid">
			<div class="jumbotron">
				<h1>Unicef Xmas 2015</h1>
				<p>administration</p>
			</div>

			<?php foreach ($admin->getAlert() as $alert): ?>
				<div class="alert <?= $alert['class']; ?>" role="alert"><?= $alert['message']; ?></div>
			<?php endforeach; ?>
			
			<div class="row">
				<?php if (!$admin->isLogged()): ?>
					<div class="col-md-6 col-md-offset-3">
						<form action="/admin" method="post" class="form-inline">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control" id="email" placehodler="Email" />
							</div>

							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control" id="password" placehodler="" />
							</div>

							<button type="submit" class="btn btn-primary" name="login">Login</button>
						</form>
					</div>
				<?php else: ?>
					<div class="col-md-12" data-ljs-s="admin">
						<ul class="nav nav-pills pull-right">
							<li><a href="/admin/logout" class="">Logout</a></li>
							
						</ul>
						<div class="clearfix"></div>
						<table class="table table-hover table-responsive">
							<thead>
								<tr>
									<th>Message</th>
									<th>Sent</th>
									<th>Assign to</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($messages as $msg): ?>
									<tr>
										<td><?= $msg['text']; ?></td>
										<td><?= $msg['time']; ?></td>
										<td>
											<input type="hidden" name="vote_id" value="<?= $msg['id']; ?>" class="vote-id" />
											<select name="assign_to" class="form-control assign-to">
												<option value="0">- select -</option>
												<?php foreach ($subgroups as $id => $sg): ?>
													<option value="<?= $id; ?>"><?= $sg; ?></option>
												<?php endforeach; ?>
											</select>
											<button class="btn btn-default save">Save</button>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
					<script type="text/javascript" src="/js/admin.js"></script>
				<?php endif; ?>
			</div>
		</div>
	</body>
</html>