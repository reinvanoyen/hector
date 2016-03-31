<!DOCTYPE html>

<html lang="nl">

<head>

	<base href="http://<?=\App\HOST?><?=\App\ROOT?>" />

	<title><?=$blogpost->slug?></title>

	<meta charset="UTF-8" />
	<meta name="author" content="Rein Van Oyen" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<link rel="stylesheet" href="style/style.css" />

</head>

<body>

	<div id="wrapper">

		<?php include 'App/ExampleApp/View/elements/header.php'; ?>

		<main>

			<?php include 'App/ExampleApp/View/elements/nav.php'; ?>

			<div>
				<h1><?=$blogpost->title?></h1>
				<p>
					<?=$blogpost->body?>
				</p>
			</div>

		</main>

		<?php include 'App/ExampleApp/View/elements/footer.php'; ?>

	</div>

</body>

</html>