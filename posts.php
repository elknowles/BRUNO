<?php
session_start();

require_once "bruno-config.php";
?>
<!DOCTYPE html>
<html>

<head>
	<title>BRUNO</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/anonymous-pro" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<section class="hero">
		<div class="hero-inner">
			<h1>POSTS</h1>
			<?php
				$i=0;
				$NumPosts=0;
				$AllPostsSQL ="SELECT P.PostID, P.ProfileID, P.PageID, T.TContent, H.PContent, V.VContent, A.AContent FROM POST as P INNER JOIN Text as T ON P.PostID = T.TextID INNER JOIN Photo as H ON P.PostID = H.PostID INNER JOIN Video as V ON P.PostID = V.PostID INNER JOIN Audio as A ON P.PostID = A.PostID";
				$NumberPostsSQL ="SELECT COUNT(*) FROM POST";
				if($PostsCount = $BrunoCONN->prepare($NumberPostsSQL)){
					$PostsCount->execute();
					$PostsCount->store_result();
					$PostsCount->bind_result($NumPosts);
					if($PostsCount->num_rows >0){
						if($PostsCount->fetch()){
							echo "Number of posts created: ".$NumPosts ."<br>";
						}
					}
				}

				echo "I got to this point";
				$element = "<div>I have a div</div>";
				for ($i = 0; $i < $NumPosts; $i++) {
					echo $element;
					echo $i;
				}
				while($rows=mysql_fetch_array($AllPostsSQL)){ ?>
					<?php echo "inside the while loop";?>
					<div id= "<?php echo $i; ?>"> i am div with id=div <?php echo $i; ?>>
					</div>
					<?php $i++; 
				}
				if($i == 0)
				{
					echo 'No Posts in Database';
				}
				else
				{
					echo 'There is a post but this program is an asshole';
				}
			?>
		</div>
	</section>

</body>

</html>