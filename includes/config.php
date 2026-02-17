<?php

date_default_timezone_set('UTC');

define('FILE_TYPES_IMAGES', array('image/png', 'image/jpg', 'image/jpeg', 'image/gif'));
define('DIRECTIONS', array('north', 'east', 'south', 'west'));

if (!defined('GITHUB_TOKEN')) {
    define('GITHUB_TOKEN', getenv('GITHUB_TOKEN'));
}