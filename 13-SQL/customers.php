<?php
/*
Cross-Site HTTP Requests
Requests for data from a different server (than the requesting page), are called cross-site HTTP requests.
Cross-site requests are common on the web. Many pages load CSS, images, and scripts from different servers.
In modern browsers, cross-site HTTP requests from scripts are restricted to same site for security reasons.
The following line, in our PHP examples, has been added to allow cross-site access.
*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");

$result = $conn->query("SELECT CompanyName, City, Country FROM Customers");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Name":"'  . $rs["CompanyName"] . '",';
    $outp .= '"City":"'   . $rs["City"]        . '",';
    $outp .= '"Country":"'. $rs["Country"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>