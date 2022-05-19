<?php


function rating_bar($id, $units = '', $static = '')
{

    // get the db connection info
    include('_config-rating.php');
//set some variables
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!$units) {
        $units = 10;
    }
    if (!$static) {
        $static = false;
    }

// get votes, values, ips for the current rating bar


    $query = $rating_conn->query("SELECT `total_votes`, `total_value`, `used_ips` FROM $rating_tableName WHERE `id`='$id'") or die(" Error: " . $rating_conn->errorInfo());
//$query=mysqli_query($rating_conn,"SELECT total_votes, total_value, used_ips FROM $rating_dbname.$rating_tableName WHERE id='$id' ")or die(" Error: ".mysqli_error());


// insert the id in the DB if it doesn't exist already
//if (mysqli_num_rows($query) == 0) {
    if ($query->rowCount() == 0) {

        $sql = "INSERT INTO $rating_tableName (`id`,`total_votes`, `total_value`, `used_ips`) VALUES ('$id', '0', '0', '')";
//$result = mysqli_query($rating_conn,$sql);
        $result = $rating_conn->query($sql);

    }

//$numbers=mysqli_fetch_assoc($query);
    $numbers = $query->fetch(PDO::FETCH_ASSOC);;

    if ($numbers['total_votes'] < 1) {
        $count = 0;
    } else {
        $count = $numbers['total_votes']; //how many votes total
    }
    $current_rating = $numbers['total_value']; //total number of rating added together and stored
    $tense = ($count == 1) ? "vote" : "votes"; //plural form votes/vote

// determine whether the user has voted, so we know how to draw the ul/li

//$voted=mysqli_num_rows(mysqli_query($rating_conn,"SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id."' "));
//$voted=$query->rowCount($rating_conn->query("SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id."' "));

    $voted = $rating_conn->query("SELECT `used_ips` FROM $rating_tableName WHERE `used_ips` LIKE '%" . $ip . "%' AND `id`='" . $id . "' ");
    $voted = $voted->rowCount();

// now draw the rating bar
    $rating_width = @number_format($current_rating / $count, 2) * $rating_unitwidth;
    $rating1 = @number_format($current_rating / $count, 1);
    $rating2 = @number_format($current_rating / $count, 2);

    if ($static == 'static') {

        $static_rater = array();
        $static_rater[] .= "\n" . '<div class="ratingblock">';
        $static_rater[] .= '<div id="unit_long' . $id . '">';
        $static_rater[] .= '<ul id="unit_ul' . $id . '" class="unit-rating" style="width:' . $rating_unitwidth * $units . 'px;">';
        $static_rater[] .= '<li class="current-rating" style="width:' . $rating_width . 'px;">Currently ' . $rating2 . '/' . $units . '</li>';
        $static_rater[] .= '</ul>';
        $static_rater[] .= '<p class="static">' . $id . '. Rating: <strong> ' . $rating1 . '</strong>/' . $units . ' (' . $count . ' ' . $tense . ' cast) <em>This is \'static\'.</em></p>';
        $static_rater[] .= '</div>';
        $static_rater[] .= '</div>' . "\n\n";

        return join("\n", $static_rater);


    } else {

        $rater = '';
        $rater .= '<div class="ratingblock">';

        $rater .= '<div id="unit_long' . $id . '">';
        $rater .= '  <ul id="unit_ul' . $id . '" class="unit-rating" style="width:' . $rating_unitwidth * $units . 'px;">';
        $rater .= '     <li class="current-rating" style="width:' . $rating_width . 'px;">Currently ' . $rating2 . '/' . $units . '</li>';

        for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
            if (!$voted) { // if the user hasn't yet voted, draw the voting stars
                $rater .= '<li><a href="db.php?j=' . $ncount . '&amp;q=' . $id . '&amp;t=' . $ip . '&amp;c=' . $units . '" title="' . $ncount . ' out of ' . $units . '" class="r' . $ncount . '-unit rater" rel="nofollow">' . $ncount . '</a></li>';
            }
        }

        $ncount = 0;

        $rater .= '</ul>';

        $rater .= '<p class="voted"';

        if ($voted) {
            $rater .= '';
        }

        $rater .= '>Рейтинг: <strong>' . $rating1 . '</strong>/<strong>' . $units . '</strong> &nbsp; &nbsp; ' . $tense . ': <strong>' . $count . '</strong>';

        $rater .= ' </p>';

        $rater .= '<div style="display:none;" itemprop="aggregateRating" itemscope="" itemtype="https://schema.org/AggregateRating">';

        $rater .= '<meta itemprop="bestRating" content="' . $units . '">';

        $rater .= '<meta itemprop="worstRating" content="1">';

        $rater .= '<meta itemprop="ratingValue" content="' . $rating1 . '">';

        $rater .= '<meta itemprop="ratingCount" content="' . $count . '">';

        $rater .= '</div>';

        $rater .= '</div>';

        $rater .= '</div>';

        return $rater;

    }

}

?>