<!DOCTYPE html>

<html lang="nl">

<head>

	<base href="http://<?=\App\HOST?><?=\App\ROOT?>" />

	<title><?=$page->slug?></title>

	<meta charset="UTF-8" />
	<meta name="author" content="Rein Van Oyen" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<link rel="stylesheet" href="style/style.css" />

</head>

<body>

	<div>
		<h1><?=$page->slug?></h1>
		<p>
			<?=$page->body?>
		</p>
	</div>

</body>

</html>