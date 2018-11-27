<!DOCTYPE html>
<html>
<head>
 <title>DATE SELECT</title>
 <link rel="stylesheet" href="style.css">
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<div class="row">
  <form action="adminActivityLists.php" method="post">
    <div class="col-md-6">
      <label for="selection"><b>Post Date</b></label>
      <input type="text" name="selection" required="1" required pattern="[0-9]{4}\-[0-1][0-9]\-[0-3][0-9]" placeholder="YYYY-MM-DD">
    </div>
</div>

<div class="clearfix">
    <button type="submit" class="signupbtn">Search</button>
  </div>
</div>



</body>
