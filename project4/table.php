<?php ob_start(); ?>
<?php require "../functions.php"?>




<?php
    
    if(isset($_GET['search']) && isset($_GET['page'])){
        
            
        $search = $_GET['search'];
        $search = clean($search);

        
        $page = $_GET['page'];
        $page = clean($page);

        
      
        $results = searchUsersPerPage($search,$page);
        $pages = getSearchUserPageCount($search);
       // $results = getPage("users",$page);
        
    }elseif(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $query = "DELETE FROM users WHERE id=$id";
        $stmt = mysqli_prepare($conn,$query);
        mysqli_stmt_execute($stmt);
        $rows = mysqli_affected_rows($conn);
        print_r($rows);
        mysqli_stmt_close($stmt);
        header("Location: table.php");
        
        
    }
    elseif(isset($_GET['page'])){
     
        $page = $_GET['page'];
        //TODO test for validity of page number
        $results = getPage("users",$page);
        $pages = getPageCount("users");
        
    }
    elseif(isset($_GET['search'])){
        
        $search = $_GET['search'];
        $search = clean($search);
        
        echo "search: $search<br>";
     
        //TODO test for validity of page number
       // $results = searchUsers($search);
        $results = searchUsersPerPage($search, 1);
        
        $pages = getSearchUserPageCount($search);
        $page=1;
        
    }
else{
        
        
        
        $results = getPage("users",1);
        $pages = getPageCount("users");
        $page=1;
        
//        $query = "SELECT * FROM users";
//        $stmt = mysqli_prepare($conn, $query);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_bind_result($stmt,$id,$name,$ssn,$salary,$department,$home_address);
//        mysqli_stmt_store_result($stmt);
        
//        while ($row = mysqli_stmt_fetch($stmt))
//        {
//            echo "Name: $name <br>";
//        }

    }

    
    
?>


<?php include "header.php" ?>
    
    
    <form action="" method="get">
        <div class="input-group" >
            <input type="text" name="search" id="search">
            <input type="submit" name="searchSubmit" value="Search" class="btn btn-primary input-group-append">
        </div>
    </form>
    
    <?php include "pagination.php" ?>
    
    <table class="table table-bordered table-hover">
        <thead>
            <td>Id</td>
            <td>Name</td>
            <td>SSN</td>
            <td>Salary</td>
            <td>Department</td>
            <td>Home Address</td>
            <td>Edit</td>
            <td>Delete</td>
        </thead>
        <tbody>
            
            <?php
            
                        
            while ($row = mysqli_fetch_assoc($results))
        {
                $id = $row['id'];
                
            echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['ssn']}</td>";
                echo "<td>{$row['salary']}</td>";
                echo "<td>{$row['department']}</td>";
                echo "<td>{$row['home_address']}</td>";
                echo "<td><a href='edit_form.php?edit=$id' class='btn btn-secondary btn-sm'>Edit</a></td>";
                echo "<td><a href='?delete=$id' class='btn btn-danger btn-sm' >Delete</a></td>";
                
            echo "</tr>";
        }
            

            
            
//            
//            while ($row = mysqli_stmt_fetch($stmt))
//        {
//            echo "<tr>";
//                echo "<td>$id</td>";
//                echo "<td>$name</td>";
//                echo "<td>$ssn</td>";
//                echo "<td>$salary</td>";
//                echo "<td>$department</td>";
//                echo "<td>$home_address</td>";
//                echo "<td><a href='edit_form.php?edit=$id'>Edit</a></td>";
//                echo "<td><a href='?delete=$id'>Delete</a></td>";
//                
//            echo "</tr>";
//        }
//            
            ?>
            
            
        </tbody>
    </table>
    
    <?php include "pagination.php" ?>
    <?php include "footer.php" ?>

