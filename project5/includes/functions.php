<?php


if(!defined("__FUNCTIONS__")){
    
    define("__FUNCTIONS__",1);
    
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conn = mysqli_connect(getenv('DB_SERVER'),getenv('DB_USER'),getenv('DB_PASS'),getenv('DB_DATABASE'));
if(mysqli_connect_errno())
    die("Error connecting to database.");


function clean($data){
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}


function query($query){
    global $conn;
    
    $result = mysqli_query($conn, $query);
    
    if(!$result)
        die("Error performin query $query - " . mysqli_error($conn));
    
    return $result;
}

function getPageParams($table,$page,$rowsPerPage){
    global $conn;
    

    $correctedPage = ($page-1)*$rowsPerPage;
//    echo $correctedPage;
    $query = "SELECT * FROM $table LIMIT $correctedPage, $rowsPerPage";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    return $results;
    
}

define("__ROWS_PER_PAGE__",3);

function getPage($table,$page){
    return getPageParams($table,$page,__ROWS_PER_PAGE__);
}

function execute($stmt) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $count = mysqli_stmt_num_rows($stmt);
        return $count;
}

    function getCount($table){
    global $conn;
    $query = "SELECT * FROM $table";
    $stmt = mysqli_prepare($conn, $query);
    return execute($stmt);
}

    function getPageCountPrimal($count, $rowsPerPage) {
        $result = $count / $rowsPerPage;
//            echo "Result: $result<rb>";
        $pages = ceil($result);
        return $pages;
    }

    function getPageCountCustom($table,$rowsPerPage){
    $count = getCount($table);
    return getPageCountPrimal($count,$rowsPerPage);
}

function getPageCount($table){
    return getPageCountCustom($table,__ROWS_PER_PAGE__);
}
    
function searchUsers($search){
    global $conn;
    clean($search);
    $search = "%".$search."%";
//    echo "$search<br>";
    $query = "SELECT * FROM users WHERE name LIKE ? OR department LIKE ? OR ssn LIKE  ? OR home_address LIKE ?";
    $stmt = mysqli_prepare($conn, $query)  or die(mysqli_error($conn));
    mysqli_stmt_bind_param($stmt,"ssss",$search,$search,$search,$search);
    if(mysqli_stmt_execute($stmt)){

    $results = mysqli_stmt_get_result($stmt);
    return $results;
    }else{
       die(mysqli_error($conn));
    }
}    
    
    
function getSearchUserCount($search){
    global $conn;
    clean($search);
    $search = "%".$search."%";
//    echo "$search<br>";
    $query = "SELECT * FROM users WHERE name LIKE ? OR department LIKE ? OR ssn LIKE  ? OR home_address LIKE ?";
    $stmt = mysqli_prepare($conn, $query)  or die(mysqli_error($conn));
    mysqli_stmt_bind_param($stmt,"ssss",$search,$search,$search,$search);
    if(mysqli_stmt_execute($stmt)){
//    $results = mysqli_stmt_get_result($stmt);
        mysqli_stmt_store_result($stmt);
        $count = mysqli_stmt_num_rows($stmt);
        return $count;
    }else{
       die(mysqli_error($conn));
    }
}    
    
    function searchUsersPerPage($search, $page){
    global $conn;
    clean($search);
    $search = "%".$search."%";
//        echo "Page: $page<br>";
    $rowsPerPage = __ROWS_PER_PAGE__;
    $index = ($page-1)*$rowsPerPage;
//        echo "Index: $index<br>";
    $query = "SELECT * FROM users WHERE name LIKE ? OR department LIKE ? OR ssn LIKE  ? OR home_address LIKE ? LIMIT $index, $rowsPerPage";
    $stmt = mysqli_prepare($conn, $query)  or die(mysqli_error($conn));
    mysqli_stmt_bind_param($stmt,"ssss",$search,$search,$search,$search);
    if(mysqli_stmt_execute($stmt)){

    $results = mysqli_stmt_get_result($stmt);
    return $results;
    }else{
       die(mysqli_error($conn));
    }
} 
    
    function getSearchUserPageCount($search){
//        echo "Search: $search<br>";
        $count = getSearchUserCount($search);
//        echo "Count: $count<br>";
        return getPageCountPrimal($count,__ROWS_PER_PAGE__);
    }
    
    
}
?>