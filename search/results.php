<?php

security_check();

define('APP_NAME', '<i class="bm-search"></i> Search');
define('PAGE_TITLE', 'Search Results');
define('PAGE_SELECTED_SECTION', 'search');
define('PAGE_SELECTED_SUB_PAGE', '/search/results');

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
    Search Results
</h1>

<p>This will be your search results page.</p>

<ul>
    <li><a href="/search/form">Search</a></li>
    <li><a href="/search/results">Results</a></li>
</ul>

<?php

include('../templates/main_footer.php');
include('../templates/html_footer.php');
