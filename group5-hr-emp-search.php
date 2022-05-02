<!DOCTYPE html>
<html>
    <head>
    <!--Name: Jason Lee
		Filename:group5-hr-emp-search.php 
    Blackboard User Name: jslee3
    Class Section: CTI.110.0003
    -->
        <link href="group5-hr-style.css" rel="stylesheet"> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Employee Search page</title>
    </head>
<body>
<?php

$server = "localhost";
$user = "cti110";
$pw = "";
$db = "hr";

$last_name = $_POST['last_name'];
$employee_id = $_POST['employee_id'];

$connect = mysqli_connect($server, $user, $pw, $db);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}


$empQuery = "SELECT employees.*, jobs.job_title from employees, jobs where (last_name = '$last_name' or employee_id = '$employee_id') and employees.job_id = jobs.job_id";

$result = mysqli_query($connect, $empQuery);


/*(logic or syntax) then !$result would be "T" otherwise if there are results then $result would have data and be "F"*/
if (!$result) 
{
    die("Could not successfully run query ($empQuery) from $db: " .
        mysqli_error($connect));
}

//the select rqt. If 0 records than immediately tells user no results
if (mysqli_num_rows($result) == 0) 
{
    print("No records found with query $empQuery");
}
else


//print Employee Search Results
{
    echo("<h1>EMPLOYEE SEARCH RESULTS<h1>");

    echo("<table border = \"1\">");
    echo("<tr><th>Emp ID</th><th>First Name</th><th>Last Name</th><th>Job Code</th><th>Job Title</th><th>Salary</th>");

    while ($row = mysqli_fetch_assoc($result)) {
        print("<tr><td>" . $row['employee_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['job_id'] . "</td><td>" . $row['job_title'] . "</td><td>" . $row['salary'] . "</td></tr>");
    }
    echo("</table>");
}

mysqli_close($connect);

?>
<br>
<footer>
    <a href="group5-hr-emp-search.html">Return to previous page</a>
</footer>
</body>
</html>