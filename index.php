<?php include('header.php'); ?>
<a href="login.php?m=Logged out">Log out</a>
<a href="add.php">Add restaurants</a>
<form action="functions.php?f=search" method="post">
  Search: <input type="text" name="search" class="form-control">
  <input type="submit" value="Search" class="btn btn-primary">
</form>
<div id="restaurants">Getting restaurant list....</div>

<script>
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       var r = JSON.parse(xhttp.responseText)
       var html='';
        for(let i = 0; i < r.length; i++){
          html+='<h2>'+r[i].name+'</h2>';
          if(r[i].picture!='') html+='<img src="images/'+r[i].picture+'" class="img-fluid">';
          html+='<h3>'+r[i].location+'</h3>';
          if(r[i].price==1){
            html+='<div id="price" style="background-position: -23px -22px;"></div>';
          }
          if(r[i].price==2){
            html+='<div id="price" style="background-position: -23px -60px;"></div>';
          }
          if(r[i].price==3){
            html+='<div id="price" style="background-position: -23px -97px;"></div>';
          }
          if(r[i].price==4){
            html+='<div id="price" style="background-position: -23px -132px;"></div>';
          }
          if(r[i].price==5){
            html+='<div id="price" style="background-position: -23px -166px;"></div>';
          }
          html+='<a href="edit.php?id='+r[i].id+'">Edit</a><br><hr>';
        }
       document.getElementById("restaurants").innerHTML = html;
    }
};
xhttp.open("GET", "functions.php?f=getRestaurants<?php
  if(isset($_GET['search'])) echo '&search='.$_GET['search'];
?>
  ", true);
xhttp.send();
</script>

<?php include('footer.php'); ?>