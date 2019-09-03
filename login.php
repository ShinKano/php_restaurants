<?php include('header.php'); ?>
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <h1>Login here</h1>
      <form action="functions.php?f=login" method="post">
        Email Address: <br><input type="text" name="email" class="form-control"><br>
        Password: <br><input type="password" name="password" class="form-control"><br>
        <input type="submit" value="Login" class="btn btn-primary">
        <a href="register.php">Register</a>
        <br><br>
        <?php
        if(isset($_GET['m'])){
          ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?php echo $_GET['m']; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
        }
        ?>
    </div>
  </div>
<?php include('footer.php'); ?>