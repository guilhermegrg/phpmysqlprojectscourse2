<?php require "../functions.php"?>


<?php
    
    $pages = getPageCount("users");
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
       
            echo "<a href='?page=$i'>$i</a>";
            
        } 
       ?>
       
   </body>
   </html>