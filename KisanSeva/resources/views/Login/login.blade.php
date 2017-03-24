<!--

* File    : index.blade.php
* Author  : Saurabh Mehta  
* Date    : 16-Mar-2017
* Purpose : Login page of our users  -->
<html>
  <head>
    <title>Kisan Seva | Login</title> <!--Change title according to pages -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
  </head>
  <body id="myPage">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <h1>Kisan Seva</h1>
      </div>
    </div>
  </nav>
  <div class="row">
   <div class="col-sm-8">
    <div id="jumb" class="jumbotron text-center">
      <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
        <!-- Indicators -->
          <div class="carousel-indicators">
            <a data-target="#myCarousel" data-slide-to="0" class="active"></a>
            <a data-target="#myCarousel" data-slide-to="1"></a>
            <a data-target="#myCarousel" data-slide-to="2"></a>
            <a data-target="#myCarousel" data-slide-to="2"></a>
          </div>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active" >
                <img src="assets/background/1.jpg">
              </div>
              <div class="item">
                <img src="assets/user/background/2.jpg">
              </div>
              <div class="item">
                <img src="asstes/user/background/3.jpg" >
              </div>
              <div class="item">
                <img src="assets/user/background/4.jpg" >
              </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button"
             data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <form id="myForm">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <h2 class="user"><a href="/KisanSeva/KisanSeva/public/"><strong>Login</strong></a></h2>
              </div>
              <div class="col-sm-6">
                <h2><a href="/KisanSeva/KisanSeva/public/register">Register</a></h2>
              </div>
              <div class="form-group col-md-12">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" 
                 placeholder="example@gmail.com">
                </div>
                <div class="form-group col-md-12">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="******" maxlength="10">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" id="submit">Submit</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <center><h3><a href="#">Forgot Password</a></h3></center>
        </div>
      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>

    
  