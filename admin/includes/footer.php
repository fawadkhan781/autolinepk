<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>All rights reserved</b>
    </div>
    <strong><?php 
      $query4 = "SELECT * FROM options";  
      $res_oppt4 = mysqli_query($connection,$query4);
				if(mysqli_num_rows($res_oppt4) > 0){ 
            while ($row4 = mysqli_fetch_array($res_oppt4))
             {
                echo $row4['copyright']; 
              }
          } ?>
        </strong>
</footer>