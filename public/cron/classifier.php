<?php

include('../../includes/connect.php');
include('../../includes/config.php');
include('../../functions/functions.php');

echo '<h1>BrickMMO URL Classifier</h1>';

// Array of patterns with type labels
$patterns = [
    'Colors' => 'https://colours.brickmmo.com/details/',
    'Events' => 'https://events.brickmmo.com/details/',
    'Themes' => 'https://parts.brickmmo.com/theme.php',
    'Parts'  => 'https://parts.brickmmo.com/element.php?',
    'Set'    => 'https://parts.brickmmo.com/set.php?id'
];

foreach($patterns as $type => $identifier) {

    echo "<h2>Scanning for $type</h2>";

    $query = "SELECT * FROM pages WHERE url LIKE '%$identifier%'";

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){

            $page_id = $row['id'];
            $url = $row['url'];

            $update_sql = "UPDATE pages 
                           SET type = '$type'
                           WHERE id = $page_id
                           LIMIT 1";

            mysqli_query($connect, $update_sql);

        }
    } else {
        echo "<p>No $type URLs found</p>";
    }

    echo "<hr>";
}


?>