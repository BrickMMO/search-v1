<?php

include('../../includes/connect.php');
include('../../includes/config.php');
include('../../functions/functions.php');

//github query details picked from documentation: https://docs.github.com/en/rest/search/search?apiVersion=2022-11-28#search-repositories

$Q = 'brickmmo'; //q
$per_page = 10; //per_page
$page = 1; //page
$hasresults = true; //for looping
$token = GITHUB_TOKEN;

echo '<h1>BRICKMMO Github Repo Scan</h1>';

while ($hasresults){

    //https://api.github.com/search/repositories?q=brickmmo&per_page=1
    $url = "https://api.github.com/search/repositories?q={$Q}&per_page={$per_page}&page={$page}"; 

    $headers = [
        'Accept: application/vnd.github+json',
        'X-GitHub-Api-Version: 2022-11-28',
        'User-Agent: BrickMMO',
        'Authorization: Bearer ' . $token
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $result = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($result, true);
    // echo '<pre>' . $result . '</pre>';


    //to stop the logic if the results return empty (eg. on page 10)
    if (empty($data['items'])) {
        $hasresults = false;
        echo '<h3> Github scanned for BrickMMO repos!</h3>';
        break;
    }

    //to insert the needed fields in the table
    foreach ($data['items'] as $item){

        $repo_id = $item['id'];
        $repo_name = mysqli_real_escape_string($connect, $item['name']); //got error saying that one of the repo had apostrophe and it broke code so researched how to escape that in php and found this method. Still facing issue of null case.
        $repo_url = mysqli_real_escape_string($connect, $item['html_url']);
        $description = mysqli_real_escape_string($connect, $item['description']);

        $query = "INSERT INTO github_repo(repo_id, repo_name, repo_url, description, scrapped_at, created_at)
                VALUES ($repo_id, '$repo_name', '$repo_url', '$description', NOW(), NOW())
                ON DUPLICATE KEY UPDATE
                scrapped_at = NOW()";

        mysqli_query($connect, $query);

    }

    $page++;

}



