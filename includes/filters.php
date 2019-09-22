    <div class="col-3 col-lg-3 col-md-4 col-sm-12 mb-3">
      <div class="card bg-light mb-3">
        <div class="card-header bg-primary text-white text-uppercase">
          <i class="fa fa-list">
          </i> Platforms
        </div>
        <ul class="list-group category_block">
          <?php
$select_platforms  = "select * from platform";
$run_platforms_sql = mysqli_query($con, $select_platforms);
while ($platform_row = mysqli_fetch_array($run_platforms_sql))
  {
    $platform_id   = $platform_row['platform_id'];
    $platform_name = $platform_row['platform_name'];
    if (isset($_GET['price']) && isset($_GET['user_query']))
      {
        $price = $_GET['price'];
        echo "
<li class='list-group-item'><a href='trade.php?user_query=$user_keyword&price=$price&filter=$platform_id'>$platform_name</a></li>
";
      }
    else
      {
        echo "
<li class='list-group-item'><a href='trade.php?filter=$platform_id'>$platform_name</a></li>
";
      }
  }
?>
        </ul>
      </div>
      <div class="card bg-light mb-3">
        <div class="card-header bg-primary text-white text-uppercase">
          <i class="fa fa-list">
          </i> Price
        </div>
        <ul class="list-group category_block">
          <li class="list-group-item">
            <a href="trade.php?<?php echo "user_query=$user_keyword";?><?php if(isset($_GET['filter'])){$id = $_GET['filter']; echo "&filter=$id"; } ?>">No filter
            </a>
          </li>
          <li class="list-group-item">
            <a href="trade.php?<?php echo "user_query=$user_keyword";?>&price=20<?php if(isset($_GET['filter'])){$id = $_GET['filter']; echo "&filter=$id"; } ?>">£20
            </a>
          </li>
          <li class="list-group-item">
            <a href="trade.php?<?php echo "user_query=$user_keyword";?>&price=25<?php if(isset($_GET['filter'])){$id = $_GET['filter']; echo "&filter=$id"; } ?>">£25
            </a>
          </li>
          <li class="list-group-item">
            <a href="trade.php?<?php echo "user_query=$user_keyword";?>&price=30<?php if(isset($_GET['filter'])){$id = $_GET['filter']; echo "&filter=$id"; } ?>">£30
            </a>
          </li>
          <li class="list-group-item">
            <a href="trade.php?<?php echo "user_query=$user_keyword";?>&price=35<?php if(isset($_GET['filter'])){$id = $_GET['filter']; echo "&filter=$id"; } ?>">£35
            </a>
          </li>
          <li class="list-group-item">
            <a href="trade.php?<?php echo "user_query=$user_keyword";?>&price=40<?php if(isset($_GET['filter'])){$id = $_GET['filter']; echo "&filter=$id"; } ?>">£40
            </a>
          </li>
          <li class="list-group-item">
            <a href="trade.php?<?php echo "user_query=$user_keyword";?>&price=45<?php if(isset($_GET['filter'])){$id = $_GET['filter']; echo "&filter=$id"; } ?>">£45
            </a>
          </li>
        </ul>
      </div>
    </div>