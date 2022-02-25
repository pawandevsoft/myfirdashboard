<?php 
session_start();
if(!isset($_SESSION['UserLogedIn']) && empty($_SESSION['UserLogedIn']))
{
  echo "<script>window.location.replace('login.php');</script>";
}  
include "db.php";
  include "functions.php";
  if(isset($_GET['page'])){
    $pagination = $_GET['page'];
  }else{
    $pagination = 1;
  }
  $post_pre_page = 5;
  $result1 = ($pagination-1)*$post_pre_page;
 ?>
<?php include 'header.php'; ?>

<?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- /.content -->
    <div class="container m-auto mt-3 row">
      <div class="col-8">
        <?php 
        if(isset($_GET['search'])){
          $search = $_GET['search'];
            $sql_seclect = "SELECT * FROM blog_article WHERE articletitle LIKE '%".$search."%' ORDER BY articleid DESC LIMIT $result1, $post_pre_page";
        }else{
           $sql_seclect = "SELECT * FROM blog_article ORDER BY articleid DESC LIMIT $result1, $post_pre_page";
        }
           
            $result = mysqli_query($conn, $sql_seclect);
            if(mysqli_num_rows($result)> 0){
              while ($row = mysqli_fetch_assoc($result)) {
                
         ?>
          <div class="card mb-3" style="max-width: 800px;">
            <div class="row g-0">
              <div class="col-md-5" style="background-image: url('https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg');background-size: cover">
                <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <a href="single_post.php?id=<?=$row['articleid'];?>"><h2 class="card-title"><b><?=$row['articleid'];?> <?= $row['articletitle'];?></b></h2></a>
                  <p class="card-text text-truncate"><?= $row['articlecontant'];?></p>
                  <p class="card-text"><i class="far fa-clock"></i><small class="text-muted"> <?= date("F, j Y h:i:s A",strtotime($row['articledate']));?></small></p>
                </div>
              </div>
            </div>
          </div> 
          <?php 
             }
              //echo "select successfully";
            }else{
              echo "error";
            }

           ?>
    </div>
    <div class="col-4">
        <div class="card mb-3">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          <div class="card mb-3">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          <div class="card mb-3">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          
    </div>
    </div>
<!-- Pagination -->
<?php 
if(isset($_GET['search'])){
  $search = $_GET['search'];
  $seclect2 = "SELECT * FROM blog_article WHERE articletitle LIKE '%$search%'";
}else{
  $seclect2 = "SELECT * FROM blog_article";
}
$run_query = mysqli_query($conn, $seclect2);
$total_rows = mysqli_num_rows($run_query);
$total_pages = ceil($total_rows/$post_pre_page);
 ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php 
            if($pagination>1){
              $switchs = "";
            }else{
              $switchs = "disabled";
            }
            if($pagination<$total_pages){
              $nextswitchs = "";
            }else{
              $nextswitchs = "disabled";
            }
           ?>
          <li class="page-item <?= $switchs?>">
            <a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$search&";} ?>page=<?=$pagination-1?>" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <?php 
            for($pagination1=1;$pagination1<=$total_pages;$pagination1++){
           ?>
          <li class="page-item"><a class="page-link" href=" ?<?php if(isset($_GET['search'])){echo "search=$search&";} ?>page=<?= $pagination1?>"><?= $pagination1?></a></li>
          <?php 
            }
           ?>
          <li class="page-item <?= $nextswitchs?>">
            <a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$search&";} ?>page=<?=$pagination+1?>">Next</a>
          </li>
        </ul>
      </nav>
<!--End Pagination -->
  </div>
  <!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
</body>
</html>
