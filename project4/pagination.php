<?php require "../functions.php"?>


<?php
    
//    $pages = getPageCount("users");
//    echo $pages;
    
    ?>
    
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <title>Document</title>
   </head>
   <body>
      
      
      
      
       <?php
        for($i=1;$i<=$pages;++$i){
            
            $class = "btn btn-light";
            if( $page == $i)
                $class = "btn btn-secondary";
                
            
        if(isset($_GET['search']))
            echo "<a href='?search={$_GET['search']}&page=$i' class='$class' >$i</a>";
        else
            echo "<a href='?page=$i'  class='$class' >$i</a>";
            
        } 
       ?>
       
   </body>
   </html>