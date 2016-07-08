<html>

	<head>
		<title>{{ block "title" }}{{ /block }}</title>
		<base href="{{ @base }}" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>

	<body>

		{{ block "body" }}

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

		{{ /block }}

	</body>

</html>