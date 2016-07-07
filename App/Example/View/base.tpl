<html>

	<head>
		<title>{{ block "title" }}{{ /block }}</title>
	</head>

	<body>

		<div id="wrapper">

			<header>
				<h1>{{ block "title" }}{{ /block }}</h1>
			</header>

			<div id="main">

				{{ block "main" }}{{ /block }}

			</div>

			<footer>
				&copy; Copyright
			</footer>

		</div>

	</body>

</html>