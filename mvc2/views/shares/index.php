<div>
    <?php 
    if(isset($_SESSION['LOGGED_IN'])):
    ?>
    <a href="<?php echo ROOT_PATH?>shares/add" class="btn btn-sucess btn-share">Share Something!</a>
    <?php endif;?>
    
    <?php foreach($viewmodel as $item):    ?>
    
    <div class="well">
    <h3><?php echo $item['title']; ?></h3>
    <small><?php echo $item['create_date']; ?></small>
    <hr>
    <p><?php echo $item['body']; ?></p>
    <br>
    <a class="btn btn-default" href="<?php echo $item['link']; ?>" target="_blank">Go to Website</a>
    </div>
    
    <?php endforeach;  ?>
</div>