<html>

	<head>
		<title><?php $this->getBlock( 'title'); ?></title>
	</head>

	<body>

		<div id="wrapper">

			<header>
				<h1><?php $this->getBlock( 'title'); ?></h1>
			</header>

			<div id="main">

				<?php $this->getBlock( 'main'); ?>

			</div>

			<footer>
				&copy; Copyright
			</footer>

		</div>

	</body>

</html>