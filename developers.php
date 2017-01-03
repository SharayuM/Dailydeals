
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DailyDeals</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style type="text/css">
    .carousel-inner > .item > img,.carousel-inner > .item > a > img {
      width: 2000px;
      height: 500px;
      margin: auto;
      position:relative
  }
  .mop{
    margin-left: 800px;
    margin-top: -50px;
  }
  .footer{
     position: fixed;
     margin-left:-70px; 
  }

  </style>
  <script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#txtPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
   
   $(document).ready(function(){
  var fname = $('#fname').text();
  var intials = $('#fname').text().charAt(0);
  var profileImage = $('#profileImage').text(intials);
});

  </script>
</head>
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
<a class="navbar-brand" href="index.php"><img src="dd.jpeg"width="75" height="75"></a>
    </div>
    
    </div>
</nav>

<div class="container">   

    <!-- Team Members Row -->
    <div class="row">
      <div class="col-lg-12">
       <center> <h3 class="page-header">Our Team</h3></center>
      </div>

      <div class="col-lg-4 col-sm-6 text-center">
        <img src="sha.jpg" class="img-circle" alt="Cinque Terre" width="230" height="200"> 
        <h5>Sharayu Musale
                    <small>(3033)</small>
                </h5>
        <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>-->
      </div>
      <div class="col-lg-4 col-sm-6 text-center">
        <img src="awais.jpg" class="img-circle" alt="Cinque Terre" width="230" height="200"> 
        <h5>Awais Patekari
                    <small>(3039)</small>
                </h5>
        
      </div>
      <div class="col-lg-4 col-sm-6 text-center">
                <img src="arti.jpg" class="img-circle" alt="Cinque Terre" width="230" height="200"> 

        <h5>Arti Laddha
                    <small>(3022)</small>
                </h5>
       
      </div>

      <footer>
  <br>
      <div class="footer">
      <p><b>Online Shopping</b></p>
      <a href="men.php"><button type="button" class="btn btn-link">MEN</button></a><br>
       <a href="women.php"><button type="button" class="btn btn-link">WOMEN</button></a><br>
        <a href="kids.php"><button type="button" class="btn btn-link">KIDS</button></a>
        <div class="foot">
        <p><b>USEFUL LINKS</b></p>
        <a href="aboutus.php"><button type="button" class="btn btn-link">ABOUT US</button></a><br>
        <a href="developers.php"><button type="button" class="btn btn-link">DEVELOPERS</button></a><br>
       </div>
       <div class="mop">
       <p><b>METHOD OF PAYMENT</b></p>
       <img src="cod.png">
       </div>
        </div>
</footer>

</body>
</html>