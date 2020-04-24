<?php require_once('../config.php');
if(!isset($_SESSION['id'])){
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LMS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

  </head>

  <body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"><img style="width: 150px;" src="../images/plogo_horizontal_vue_w_rgb.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <h1 class="my-4 text-center text-lg-left">Report</h1>
        <form method="post" action="app/report.php" id="myForm">
        <input type="hidden" name="action" value="report">
        <div class="row report-block">
        <div class="col-md-3 ">
          <div class="form-group">
            <label for="usr">From:</label>
            <input type="date" date-format="DD MMMM YYYY" required="" class="form-control" name="datefrom">
          </div> 
        </div>
        <div class="col-md-3 ">
          <div class="form-group">
            <label for="usr">To:</label>
            <input type="date" required="" class="form-control" name="dateto">
          </div> 
        </div>
        <div class="col-md-3">
             <div class="form-group">
            <label for="usr">Status:</label>
             <select class="myselect" id="status" name="status">
              <option value="All">All</option>
              <option selected="" value="Verified">Verified</option>
              <option value="Not Verified">Not Verified</option>
            </select>
          </div>
          </div>

       
        
          
        <div class="col-md-12 text-center">
          <div class="form-group mybutton">
            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> View Report</button>
          </div> 
        </div>



      
          
        
        </div>
        </form>
        <div class="row report-block">
        <div class="col-md-12">
          <table class="table table-bordered table-sm table-responsive table-striped">
          <tr>
             <th>S.N.</th>
             <th>Lead ID</th>
             <th>Name</th>
             <th>Mobile</th>
             <th>Email</th>
             <th>Address</th>              
             <th>Eldest Member</th>              
             <th>Source</th>       
             <th>TimeStamp</th>
             <th>Status</th>
          </tr>
          <tbody id="reportTr">

          </tbody>

          </table> 
        </div>
        </div>
       </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; LMS 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/4059fb95ad.js"></script>
<script>
  $('#myForm').submit(function(){
        var form = $(this),
            action = form.attr('action'),
            dataString = form.serialize();  
        var button = form.find('button[type=submit]');
        var buttonVal=button.html();        
        if(true){
            button.html('<i class="fa fa-spinner fa-spin"></i> Fetching... ');
            $.ajax({ 
                type: "POST",  
                url: action,        
                data: dataString,
                dataType: "json",
                cache: false,
                success: function(data){
                    if(data.response==1) {
                        button.html(buttonVal);
                        $("#reportTr").html(data.msg);
                        
                    } else if(data.response==2) {
                        button.html(buttonVal);
                        $("#reportTr").html(data.msg);
                        
                    }
                    else{
                        button.html(buttonVal);
                        $("#reportTr").html(data.msg);
                    }

               }, error: function(error, xhr){
                   button.html(buttonVal);
                   alert('Error: '+xhr);
               }
            });
    }
    return false;
}); 


  
</script>
  </body>

</html>
