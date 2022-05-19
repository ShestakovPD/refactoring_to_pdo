<?php

header("Cache-Control: no-cache");
header("Pragma: nocache");
require('_config-rating.php'); // get the db connection info

//getting the values
$vote_sent = preg_replace("/[^0-9]/", "", $_REQUEST['j']);
$id_sent = preg_replace("/[^0-9a-zA-Z]/", "", $_REQUEST['q']);
$ip_num = preg_replace("/[^0-9\.]/", "", $_REQUEST['t']);
$units = preg_replace("/[^0-9]/", "", $_REQUEST['c']);
$ip = $_SERVER['REMOTE_ADDR'];
$referer = $_SERVER['HTTP_REFERER'];

if ($vote_sent > $units) {
    die("Sorry, vote appears to be invalid.");
} // kill the script because normal users will never see this.

//connecting to the database to get some information
//$query = mysqli_query($rating_conn,"SELECT total_votes, total_value, used_ips FROM $rating_dbname.$rating_tableName WHERE id='$id_sent' ")or die(" Error: ".mysqli_error());
$query = $rating_conn->query("SELECT `total_votes`, `total_value`, `used_ips` FROM $rating_tableName WHERE `id`='$id_sent' ") or die(" Error: " . $rating_conn->errorInfo());
//$numbers = mysqli_fetch_assoc($query);
$numbers = $query->fetch(PDO::FETCH_ASSOC);

$checkIP = unserialize($numbers['used_ips']);

$count = $numbers['total_votes']; //how many votes total
$current_rating = $numbers['total_value']; //total number of rating added together and stored
$sum = $vote_sent + $current_rating; // add together the current vote value and the total vote value
$tense = ($count == 1) ? "vote" : "votes"; //plural form votes/vote

// checking to see if the first vote has been tallied
// or increment the current number of votes
($sum == 0 ? $added = 0 : $added = $count + 1);

// if it is an array i.e. already has entries the push in another value
((is_array($checkIP)) ? array_push($checkIP, $ip_num) : $checkIP = array($ip_num));
$insertip = serialize($checkIP);

//IP check when voting

//$voted=mysqli_num_rows(mysqli_query($rating_conn,"SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id_sent."' "));
//$voted=$query->rowCount($rating_conn->query("SELECT used_ips FROM `$rating_dbname.$rating_tableName` WHERE used_ips LIKE '%".$ip."%' AND id='".$id."' "));


$voted = $rating_conn->query("SELECT `used_ips` FROM $rating_tableName WHERE `used_ips` LIKE '%" . $ip . "%' AND `id`='" . $id_sent . "' ");
$voted = $voted->rowCount();


if (!$voted) {     //if the user hasn't yet voted, then vote normally...


    if (($vote_sent >= 1 && $vote_sent <= $units) && ($ip == $ip_num)) { // keep votes within range
        $update = "UPDATE $rating_tableName SET `total_votes`='" . $added . "', `total_value`='" . $sum . "', `used_ips`='" . $insertip . "' WHERE `id`='$id_sent'";

        /*$result = mysqli_query($rating_conn,$update);*/
        $result = $rating_conn->query($update);
    }
    header("Location: $referer"); // go back to the page we came from
    exit;
} //end for the "if(!$voted)"
?>