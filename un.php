<!doctype html>
<META HTTPEQUIV="CACHECONTROL" CONTENT="NOCACHE">
<meta httpequiv="expires" content="0" />
<html lang="en">
<head>
  <title> </title>
  <link rel="stylesheet" href="un.css">
</head>
<body>

	<form method="post" action="un.php"> 
	   Population Search:  <br> Upper Bound <input type="text" size="5" name="ub" value=<? print $_POST['ub']; ?>> 
	   Lower Bound <input type="text" size="5" name="lb" value=<? print $_POST['lb']; ?>> 
	   <input type="submit" value="submit">
	</form>
	<br/>
<table>
	<tr>
		<th><a href="un.php?sort=name"> Name </a></th>
		<th><a href="un.php?sort=cont">Continent</a></th>
		<th><a href="un.php?sort=pop">Population </a></th>
		<th><a href="un.php?sort=area">Area</a></th>
    </tr>
<?
    //
    $ub = $_POST['ub'];
    $lb = $_POST['lb'];
	// open connection to database
	$dbc=mysqli_connect("localhost","student","password","un") or die(mysqli_connect_error($dbc));

	// Query the database
	$query="SELECT *
            FROM countries";
            
    if (is_numeric($ub)){
        $query = "SELECT *
                FROM countries
                WHERE pop < $ub";
    }  
     if (is_numeric($lb)){
        $query = "SELECT *
                FROM countries
                WHERE pop > $lb";
    }
    if (is_numeric($lb) and is_numeric($ub)){
        $query = "SELECT *
                FROM countries
                WHERE pop < $ub and pop > $lb";
    } 
    
    $result= mysqli_query($dbc, $query);
    
    if (!$result){ //checks and prints errors in SQL
        print mysqli_error($dbc);
    }
	// loop through all the rows one at a time and print them out
	while ($row= mysqli_fetch_array($result, MYSQLI_ASSOC)){
	    print "<tr>
	    <td>$row[name] </td>
	    <td>$row[continent]</td>
	    <td>$row[pop]</td>
	    <td>$row[area]</td>
	    </tr>";
        	
	    
	}
?>
</table>
</body>
</html>