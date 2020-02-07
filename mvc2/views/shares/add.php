<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Share Something!</h3>
    </div>
    <div class="panel-body" action="">
        <form action="" method="post">
           
            <div class="form-group">
                <label for="">Share Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Share Body</label>
                <textarea name="body" id="" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="">Share Link</label>
                <input type="text" name="link" class="form-control">
            </div>

            <input type="submit" name="submit" value="submit" class="btn btn-primary">
            <a href="<?php echo ROOT_PATH?>shares" class="btn btn-danger">Cancel</a>                                                 
            
        </form>
    </div>
</div>