<?php

if (isset($_GET['test']))
{
  print <<< EOT
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Test successful</title>
</head>
<body>
<h1>Test successful</h1>
<p>Congratulations.</p>
<p>Apache and PHP are working.</p>
</body>
</html>
EOT;
}

else
{
  print <<< EOT
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Test PHP</title>
</head>
<body>
<h1>Test PHP</h1>
<p>To test PHP is working correctly <a href="?test=yes">click here</a>.</p>
</body>
</html>
EOT;
}
?>