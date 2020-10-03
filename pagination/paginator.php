<?php
require_once "dbClass.php";
 
   function pagination($table, $query, $per_page = 10,$page = 1, $url = '?'){
		$db = new dbClass();
		if ($table == "news")
			$row = $db->getNewsOrderedCount(0, 5);
		if ($table == "mods")
			$row = $db->getModsOrderedCount(0, 5);
		if ($table == "codes")
			$row = $db->getCodesOrderedCount(0, 5);
		if ($table == "trainers")
			$row = $db->getTrainersOrderedCount(0, 5);
		if ($table == "walkthroughs")
			$row = $db->getWalkthroughsOrderedCount(0, 5);
    	$total = $row;
        $adjacents = "1"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;

    	$pagination = "";
    	if($lastpage > 0)
    	{	
    		$pagination .= "<ul class='pagination bootpag'>";
					if ($prev != 0){ 
                $pagination.= "<li><a href='{$url}page=1'><span aria-hidden='true' class='fa fa-angle-double-left'></span></a></li>";
				$pagination.= "<li><a href='{$url}page=$prev'><span class='fa fa-angle-left' aria-hidden='true'></span></a></li>";
    		}else{
                $pagination.= "<li class='disabled' disabled><a class='page active'><span aria-hidden='true' class='fa fa-angle-double-left'></span></a></li>";
				$pagination.= "<li class='disabled' disabled><a class='page active'><span class='fa fa-angle-left' aria-hidden='true'></span></a></li>";
            }
    		if ($lastpage < 5 + ($adjacents * 3))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li class='page active'><a>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 2 + ($adjacents * 3))
    		{
    			if($page < 1 + ($adjacents * 3))		
    			{
    				for ($counter = 1; $counter < 3 + ($adjacents * 3); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='page active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    			elseif($lastpage - ($adjacents * 3) > $page && $page > ($adjacents * 3))
    			{
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents+2; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li  class='page active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    			else
    			{
    				for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='page active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}page=$next'><span class='fa fa-angle-right' aria-hidden='true'></span></a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'><span aria-hidden='true' class='fa fa-angle-double-right'></span></a></li>";
    		}else{
    			$pagination.= "<li class='disabled' disabled><a><span class='fa fa-angle-right' aria-hidden='true'></span></a></li>";
                $pagination.= "<li class='disabled' disabled><a><span aria-hidden='true' class='fa fa-angle-double-right'></span></a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
        return $pagination;
    } 
?>