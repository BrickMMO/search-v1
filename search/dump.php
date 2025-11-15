<?php

security_check();

define('APP_NAME', '<i class="bm-search"></i> Search');
define('PAGE_TITLE', 'All Search Records');
define('PAGE_SELECTED_SECTION', 'search');
define('PAGE_SELECTED_SUB_PAGE', '/search/dump');

include('../templates/html_header.php');
include('../templates/nav_header.php');
include('../templates/nav_slideout.php');
include('../templates/nav_sidebar.php');
include('../templates/main_header.php');

include('../templates/message.php');

?>

<!-- CONTENT -->

<h1 class="w3-margin-top w3-margin-bottom">
    <img
        src="https://cdn.brickmmo.com/icons@1.0.0/search.png"
        height="50"
        style="vertical-align: top"
    />
    All Search Records
</h1>

<?php 

$query = 'SELECT COUNT(*) AS total FROM pages';
$result = mysqli_query($connect, $query);
$page = mysqli_fetch_assoc($result);
echo '<p>Total Pages: '.$page['total'].'</p>';

$query = 'SELECT COUNT(*) AS total FROM words';
$result = mysqli_query($connect, $query);
$page = mysqli_fetch_assoc($result);
echo '<p>Total Keywords: '.$page['total'].'</p>';

?>

<p>Here is a dump of all pages and keywords in the database:</p>

<?php 

$query = 'SELECT *,(
        SELECT GROUP_CONCAT(word SEPARATOR ", ")
        FROM words
        INNER JOIN page_word
        ON word_id = words.id
        WHERE page_word.page_id = pages.id
    ) AS words
    FROM pages
    ORDER BY scrapped_at DESC';
$result = mysqli_query($connect, $query);

while($page = mysqli_fetch_assoc($result)) 
{

    echo '<strong>'.($page['title'] ? $page['title'] : 'Missing Title').'</strong>';
    echo '<p><a href="'.$page['url'] .'" target="_blank">'.$page['url'] .'</a></p>';
    echo '<p>Scrapped at: '.$page['scrapped_at'] .'</p>';
    echo '<p>Keywords: '.$page['words'] .'</p>';
    echo '<hr>';

}

?>

<ul>
    <li><a href="/search">Search</a></li>
    <li><a href="/search/results">Results</a></li>
    <li><a href="/search/dump">Dump</a></li>
</ul>

<?php

include('../templates/main_footer.php');
include('../templates/html_footer.php');
