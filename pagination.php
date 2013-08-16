<?php


	
//===========================	 Pagination	==============================================
if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
} else {
   $pageno = 1;
}

$query = "SELECT count(*) FROM student_names";
$result = mysql_query($query);
$query_data = mysql_fetch_row($result);
$numrows = $query_data[0];



$rows_per_page = 10;


$lastpage      = ceil($numrows/$rows_per_page);

$pageno = (int)$pageno;
if ($pageno > $lastpage) {
   $pageno = $lastpage;
}
if ($pageno < 1) {
   $pageno = 1;
}

$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
//================================================================================	

//select all the records from student_names displaying latest record first
$dispQry = "SELECT id, name FROM student_names  $limit";
$result = mysql_query($dispQry);

//test if there are any records to display
if($numrows == 0)
{
 echo "<br><center><h3>There are no student records</h3></center>";
}
else
{
			//Determine the starting row number and ending row number of the page
	  		$from_rowno = (int)(($rows_per_page * ($pageno - 1))+1);
		  	
            if ($pageno == $lastpage)
		  	{
		  		$to_rowno = $numrows;
		  	}
		  	else
		  	{
		  		$to_rowno = (int)($rows_per_page * $pageno);
		  	}
		  	
		
		
		// display
			echo "
		  <table>
		  		<b><center>Student details</b>
		  		<br>Displaying $from_rowno - $to_rowno out of $numrows records</center>
		  		<tr>
		  			<th>Id</th>
		  			<th>Name</th>
		  			
		  		</tr>";
			
			while($row = mysql_fetch_array($result))
			{
			 	
			 	
			 	echo "
			 	<tr>
					
					<td>$row[id]</td>
					<td>$row[name]</td>
					<td>
		  		
		  			</td>	
		  				 	
			 	</tr>";			  
			}
		echo "</table>";
		//====================================	Pagination	==================================================
		if ($pageno == 1) {
		   echo "<center>FIRST PREV ";
		} else {
		   echo "<center> <a href='{$_SERVER['PHP_SELF']}?pageno=1'>FIRST</a> ";
		   $prevpage = $pageno-1;
		   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage'>PREV</a> ";
		} // if
		
		echo " ( Page $pageno of $lastpage ) ";
		
		if ($pageno == $lastpage) {
		   echo " NEXT LAST </center>";
		} else {
		   $nextpage = $pageno+1;
		   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage'>NEXT</a>";
		   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage'>LAST</a> </center>";
		} // if
		//==========================================================================================
	
}	


?>
