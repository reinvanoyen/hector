<html>

	<head>
		<title><?php $this->getBlock( 'title'); ?></title>
		<base href="<?php echo htmlspecialchars( $this->base ); ?>" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>

	<body>

		<?php $this->getBlock( 'body'); ?>

	</body>

</html>