<nav>
<ul class="pagination pagination-md">
<?php 

if($searching)
    $total = getPostSearchCount($query);
elseif($searchingByCategory)
    $total = getPostCountByCategory($search_category_id);
else
    $total = getCount("posts");


//   echo "Total: " . $total . "<br>";

    $totalPages = ceil($total/$items_per_page);


//    echo $totalPages . "<br>";
//TODO add the category id and search query if it exists...
    if($page>1)
    {   
        $previousPage = $page-1;
        echo "<li class='page-item'><a href='blog.php?page=$previousPage' class='page-link'><<</a></li>";
    }
    
    for($i=1;$i<=$totalPages;++$i){
        $selected = $page==$i?"active":"";
        echo "<li class='page-item $selected'><a href='blog.php?page=$i' class='page-link'>$i</a></li>";
    }

    if($page<$totalPages)
    {
        $nextPage = $page+1;
        echo "<li class='page-item'><a href='blog.php?page=$nextPage' class='page-link'>>></a></li>";
    }

    


?>
</ul>
</nav>