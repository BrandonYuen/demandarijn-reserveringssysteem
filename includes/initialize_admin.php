<?php
require_once "settings.php";
require_once "classes/Databases/Database.php";
require_once "classes/Reserveringen/Reservering.php";
require 'libraries/carbon/carbon.php';

use Carbon\Carbon;

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    //New DB connection
    $db = new \Reserveringen\Databases\Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection = $db->getConnection();

    //Get total records/rows
    $total_rows = $connection->query('select count(*) from reserveringen')->fetchColumn();

    //Pagination
    $targetpage = "admin.php";   //your file name  (the name of this file)
    $limit = 10;
    $adjacents = 3;                                //how many items to show per page

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    if (isset($page)){
        $start = ($page - 1) * $limit;          //first item to display on this page
    }
    else{
        $start = 0;
        $page = 1;
    }

    //Setup page vars for display.
    $page_prev = $page - 1;                          	//previous page is page - 1
    $page_next = $page + 1;                          	//next page is page + 1
    $page_last = ceil($total_rows/$limit);      		//page_last is = total pages / items per page, rounded up.
	$page_last_m1 = $page_last - 1;                    	//last page minus 1

    //Get students from DB
    if ($page == "today"){
        $query = "SELECT * FROM reserveringen WHERE datum = DATE(NOW())";
    }
    else {
        $query = "SELECT * FROM reserveringen ORDER BY datum asc, tijd asc LIMIT $start, $limit";
    }
    $reserveringen = $connection->query($query)->fetchAll(PDO::FETCH_CLASS, "Reserveringen\\Reservering");

    $pagination = "";
    if($page_last > 1)
    {
        $pagination .= "";
        //previous button
        if ($page > 1)
            $pagination.= "<a href=\"$targetpage?page=$page_prev\">Previous</a>";
        else
            $pagination.= "<span class=\"disabled\">Previous</span>";

        //pages
        if ($page_last < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
        {
            for ($counter = 1; $counter <= $page_last; $counter++)
            {
                $pagination.= " | ";
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
        }
        elseif($page_last > 5 + ($adjacents * 2)) //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    $pagination.= " | ";
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$page_last\">$page_last</a>";
            }
            //in middle; hide some front and some back
            elseif($page_last - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= " | ";
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= " | ";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= " | ";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    $pagination.= " | ";
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                }
                $pagination.= " | ";
                $pagination.= "...";
                $pagination.= " | ";
                $pagination.= "<a href=\"$targetpage?page=$page_last_m1\">$page_last_m1</a>";
                $pagination.= " | ";
                $pagination.= "<a href=\"$targetpage?page=$page_last\">$page_last</a>";
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= " | ";
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= " | ";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= " | ";
                $pagination.= "...";
                for ($counter = $page_last - (2 + ($adjacents * 2)); $counter <= $page_last; $counter++)
                {
                    $pagination.= " | ";
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                }
            }
        }

        //next button
        $pagination.= " | ";
        if ($page < $page_last){

            $pagination.= "<a href='$targetpage?page=$page_next'>Next</a>";
        }
        else{
            $pagination.= "<span class=\"disabled\">Next</span>";
          }
    }

} catch (Exception $e) {
    //Set error variable for template
    $error = "Oops, try to fix your error please: " . $e->getMessage() . " on line " . $e->getLine() . " of " . $e->getFile();
}
