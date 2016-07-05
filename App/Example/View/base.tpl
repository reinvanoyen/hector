<html>

	<head>
		<title>{{ @slug }}</title>
	</head>

	<body>

		{{ block "body" }}

			<div id="wrapper">

				{{ extends "header" }}

					{{ block "title" }}{{ @title }}{{ /block }}

				{{ /extends }}

				{{ block "content" }}{{ /block }}

				{{ extends "footer" }}{{ /extends }}

			</div>

		{{ /block }}

	</body>

</html>