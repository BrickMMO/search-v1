<?php

function navigation_array($selected = false)
{

    $navigation = [
        [
            'title' => 'Search',
            'sections' => [
                [
                    'title' => 'Search',
                    'id' => 'search-content',
                    'pages' => [
                        [
                            'icon' => 'search',
                            'url' => '/search/form',
                            'title' => 'Search',
                            'sub-pages' => [
                                [
                                    'title' => 'Search',
                                    'url' => '/search/form',
                                    'colour' => 'red',
                                ],[
                                    'title' => 'Results',
                                    'url' => '/search/results',
                                    'colour' => 'red',
                                ],[
                                    'br' => '---',
                                ],[
                                    'title' => 'Visit Search App',
                                    'url' => 'https://search.brickmmo.com',
                                    'colour' => 'orange',
                                    'icon' => 'fa-solid fa-arrow-up-right-from-square',
                                ],[
                                    'br' => '---',
                                ],[
                                    'title' => 'Uptime Report',
                                    'url' => '/uptime/search',
                                    'colour' => 'orange',
                                    'icons' => 'bm-uptime',
                                ],[
                                    'title' => 'Stats Report',
                                    'url' => '/stats/search',
                                    'colour' => 'orange',
                                    'icons' => 'bm-stats',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    if($selected)
    {
        
        $selected = '/'.$selected;
        $selected = str_replace('//', '/', $selected);
        $selected = str_replace('.php', '', $selected);
        $selected = str_replace('.', '/', $selected);
        $selected = substr($selected, 0, strrpos($selected, '/'));

        foreach($navigation as $levels)
        {

            foreach($levels['sections'] as $section)
            {

                foreach($section['pages'] as $page)
                {

                    if(strpos($page['url'], $selected) === 0)
                    {
                        return $page;
                    }

                }

            }

        }

    }

    return $navigation;

}