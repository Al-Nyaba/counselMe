<?php

$num = $_POST['num'];
$pattern = "/^(233)((54)?(55))([0-9])+/";
if(preg_match($pattern, $num))
{
	echo "there is a match!";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
		<input autofocus type="text" name="num" />
		<input type="submit" name="submit" />
	</form>
</body>
</html>