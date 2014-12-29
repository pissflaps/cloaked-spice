<?php
// index.php
$link = mysql_connect('localhost', 'myuser', 'mypassword');
mysql_Select_db('blog_db', $link);

$result = mysql_query('SELECT id, title FROM post', $link);

$posts = array();
	while ($row = mysql_fetch_assoc($result)) {
		$posts[] = $row;
}
mysql_close($link);

// include the HTML presentation code
require 'templates/list.php';
?>
<!--	/*		*******	SEPERATE LOGIC	*******			*/	-->
<!DOCTYPE html>
<html>
	<head>
		<title> POST LIST</title>
	</head>
	<body>
		<h1>List of Posts?</h1>
		<ul>
			<?php foreach ($posts as $post): ?>
			<li>
				<a href="/read?id=<?php echo $post['id'] ?>">
					<?php echo $post['title'] ?>
				</a>
			</li>
			<?php foreach; ?>
		</ul>
	</body>
</html>
