<?php include "includes/header.php" ?>

<?php
    
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    
    
    $admin = getAdminUsername(); 
    
    
    if(empty($title)){
        setError("All fields must be filled in!");
        send("categories.php");
    }elseif(strlen($title)<=2){
        setError("Category title must be more than 2 chars!");
        send("categories.php");
        
    }elseif(strlen($title)>50){
        setError("Category title must be less than 50 chars!");
        send("categories.php");
        
    }    elseif(!$admin){
        setError("Invalid author! Are you logged in?");
        send("categories.php");
    }else{//insert new category
        
        $admin = getAdminUsername(); 
//        $time = now();//date_format(time(), 'Y-m-d H:i:s');
        date_default_timezone_set("Europe/Lisbon");
        $time = date('Y-m-d H:i:s');
//        echo "<h1>Time: $time</h1>";
        
     $query = "INSERT INTO category(name, author, time) VALUES (:title, :author, :time )";
        $stmt = $conn->prepare($query);
        $stmt->bindValue("title",$title);
        $stmt->bindValue("author",$admin);
        $stmt->bindValue("time",$time);
        
        $result = $stmt->execute();
        $id = $conn->lastInsertId();
        
        if($result && $id > 0){
            setSuccess("Category $id->'$title' added!");
            send("categories.php");
        }else{
            setError("Error! " . mysqli_error($conn));
            send("categories.php");
            
        }
    }
}
    
    
?>

<!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
              
               <h1><i class="fas fa-edit"></i>Manage Categories</h1>
           </div>
       </div>
       
   </div>
   </header>
   

   
<!--   main-->
<section class="container py-2 mb-4">
    <div class="row" >
        <div class="offset-lg-1 col-lg-10 " style="min-height: 400px;">
            
        <?php showMessages(); ?>
            
            <form action="" method="post">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1>Add New Category</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="title">Category Title</label>
                            <input type="text" name="title" id="title" placeholder="Type Title Here" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-2"><a href="" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a></div>
                            <div class="col-lg-6 mb-2"><button class="btn btn-success btn-block" name="submit" type="submit"><i class="fas fa-check"></i>Publish</button></div>
                        </div>
                    </div>
                </div>
            </form>
            
            
             <h1>Existing Categories</h1>
<table class="table table-hover table-striped ">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Date</th>
        
        <th>Name</th>
        <th>Author</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php
            $categories = getCategories();
//            var_dump($categories);
            foreach($categories as $key=>$value){
                $cat = $value;
                
//                var_dump($cat);
                
                $id = $cat['id'];
                $name = $cat['name'];
                $time = $cat['time'];
                $author = $cat['author'];
                
                if(strlen($name)>18)
                    $name = substr($name,0,18)."..";
                
                if(strlen($time)>18)
                    $time = substr($time,0,18)."..";
                
                if(strlen($author)>18)
                    $author = substr($author,0,18)."..";
                
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$time</td>";
                echo "<td class='table-primary'>$name</td>";
                echo "<td>$author</td>";
                echo "<td><a href='DeleteCategory.php?id=$id' class='btn btn-danger btn-sm '>Delete</a></td>";

                echo "</tr>";
            }
    
    
    
        ?>
    </tbody>
</table>
            
        </div>
    </div>
    
</section>





<!--   main end-->


<?php include "includes/footer.php" ?>