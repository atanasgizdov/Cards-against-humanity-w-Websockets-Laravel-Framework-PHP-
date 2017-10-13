<?php
// database configuration parameters
$conn = array(
    'dbname' => 'scrum_online',
    'user' => 'root',
    'password' => 'passwd',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);
// This is used to create the join link
$host = "scrumonline.local";
// Google analytics id
$ga = 'GOOGLE-ANALYTICS';

$cardSets = [
    // Standard fibonaci like series of values
    ['1', '2', '3', '5', '8', '13', '20', '40', '100'],
    // Special card set with '?' for unclear stories
    ['1', '2', '3', '5', '8', '13', '20', '40', '?'],
    // Powers of two used by other teams
    ['0' ,'1', '2', '4', '8', '16', '32', '64'],
    // Card set used to estimate hours as different fractions and multiples of a working day
    ['1', '2', '4', '8', '12', '16', '24', '32', '40'],
    // Demonstration of the coffee cup card
    ['&#9749;', '1', '2', '3', '5', '8', '13', '20', '?'],
    //Tshirt Size
    ['XS', 'S', 'M', 'L', 'XL', 'XXL', '?'],
    //Fibonacci number
    ['1', '2', '3', '5', '8', '13', '21', '34', '55', '89', '144', '&#9749;', '?'],
];
// Src tree for documentation linking from page
$src = "https://github.com/Toxantron/scrumonline/tree/master";
// Active ticketing plugins of the page
$plugins = [
    // Plugin to load issues from github
    'GitHub',
    // Plugin to load issues from JIRA
    'JIRA'
];
// Configuration for the server side JIRA controller
$jiraConfiguration = [
    'base_url' => '',
    'username' => '',
    'password' => '',
    'project' => '',
    'jql' => '',
];
