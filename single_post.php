<?php 
session_start();
if(!isset($_SESSION['UserLogedIn']) && empty($_SESSION['UserLogedIn']))
{
  echo "<script>window.location.replace('login.php');</script>";
} 
  include "db.php";
  include "functions.php";
  $id = $_REQUEST['id'];
   $select_sql = "SELECT * FROM blog_article WHERE articleid = '$id'";
  $run = mysqli_query($conn, $select_sql);
  //die;
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
            <h1 class="m-0 text-dark">Single Post</h1>
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
               if(mysqli_num_rows($run) > 0){
                $row = mysqli_fetch_assoc($run)

           ?>
            <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title"><?= $row['articletitle'];?></h5><br>
                  <span class="badge bg-primary "> Posted on <?= date('F jS Y',strtotime($row['articledate']));?></span>
                  <span class="badge bg-danger"><?=getCategoryName($conn,$row['category_id'])?></span>
                  <div class="border-bottom mt-3"></div>
                  <?php 
                  //echo "<pre>";
                    $post_images = getimageName($conn,$row['articleid']);
                   //echo "</pre>";
                   ?>
                 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <?php 
                      $a=1;
                        foreach ($post_images as $image) {
                          if($a>1){
                            $re = "";
                          }else{
                            $re = "active";
                          }
                       ?>
                      <div class="carousel-item <?php echo $re; ?>">
                        <img class="d-block w-100 img-fluid" src="images/<?= $image['image']?>" alt="First slide">
                      </div>
                      <?php 
                      $a++;
                        }
                     ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                  <p class="card-text"><?= $row['articlecontant'];?>
                  </p>
                  <!-- <a href="#" class="btn btn-primary">Share this post</a> -->
                  <div class="addthis_inline_share_toolbox"></div>
                <!-- Modal -->
                  <button data-toggle="modal" data-target="#myModal" class="btn btn-primary">Comment on this</button>
                  <!-- The Modal -->
                    <div class="modal fade" id="myModal">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Add Comments</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <form action="add_comment.php" method="POST">
                              <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                              </div>
                              <div class="form-group">
                                <label for="comments">Comments:</label>
                                <textarea name="comment" class="form-control" placeholder="Please Enter Comments"></textarea>
                              </div>
                              <div class="form-group">
                                <input type="hidden" class="form-control" id="post_id" name="post_id" value="<?=$id?>">
                              </div>
                              <button type="submit" name="addcomment" class="btn btn-primary">Add Comment</button>
                            </form>
                          </div>
                          <!-- Modal footer -->
                         <!--  <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Add Comment</button>
                          </div> -->
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            <?php 
                }else{
                echo "Error".mysqli_error($conn);
               }
             ?>
              <div>
                <h4>Related Posts</h4>
                <?php 
                  $query_seclect3 = "SELECT * FROM blog_article WHERE category_id={$row['category_id']} ORDER BY articleid DESC";
                  $run2 = mysqli_query($conn, $query_seclect3);
                  if(mysqli_num_rows($run2) > 0){
                    while($row2 = mysqli_fetch_assoc($run2)){
                      if($row2['articleid'] == $id){
                        continue;
                      }

                 ?>
                  <div class="card mb-3" style="max-width: 700px;">
                      <div class="row g-0">
                        <div class="col-md-5" style="background-image: url('https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg');background-size: cover">
                          <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
                        </div>
                        <div class="col-md-7">
                          <div class="card-body">
                           <a href="single_post.php?id=<?=$row2['articleid']?>"><h5 class="card-title"><?= $row2['articletitle']?></h5></a>
                            <p class="card-text text-truncate"><?= $row2['articlecontant']?></p>
                            <p class="card-text"><small class="text-muted"><?= $row2['articledate']?></small></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php 
                       }
                    }else{
                      echo "Error" . mysqli_error($conn);
                      }
                     ?>  
                </div>
            </div>
      <div class="col-4">
        <!-- <div class="card mb-3">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div> -->
          <!-- <div class="card mb-3">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div> -->
          <?php 
          if(isset($_GET['id'])){
            
          ?>
          <div class="card mb-3">
            <h5 class="card-header">Comments</h5>
            <?php 
              $comments_function = getComments($conn, $id);
              if(count($comments_function)<1){
                  echo '<div class="card-body"><p class="card-text">No Comments....</p></div>';
                }
              foreach ($comments_function as $comments) {
             ?>
            <div class="card-body">
              <h5 class="card-title"><b><?=$comments['name']?></b> <small class="text-secondary"><i class="far fa-clock"></i> <?=date('F jS Y',strtotime($comments['created_at']))?></small></h5>
              <p class="card-text"><?=$comments['comment']?></p>
              <hr>
              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
            <?php 
              }
             ?>
          </div>
          <?php 
            }
           ?> 
    </div>
    </div>

  </div>
  <!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62174be446e7673b"></script>

</body>
</html>
