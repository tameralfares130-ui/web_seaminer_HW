<?php

session_start();

require_once "includes/config.inc.php";

$page = $_GET["page"] ?? "home";

$pages = [
    "home" => [
        "title" => "Mainpage",
        "file" => "templates/pages/home.tpl.php"
    ],
    "images" => [
        "title" => "Images",
        "file" => "templates/pages/images.tpl.php"
    ],
    "contact" => [
        "title" => "Contact",
        "file" => "templates/pages/contact.tpl.php"
    ],
    "contact_result" => [
        "title" => "Contact Result",
        "file" => "templates/pages/contact_result.tpl.php"
    ],
    "table" => [
        "title" => "CRUD",
        "file" => "templates/pages/table.tpl.php"
    ],
    "mark_create" => [
        "title" => "Create Mark",
        "file" => "templates/pages/mark_create.tpl.php"
    ],
    "mark_edit" => [
        "title" => "Edit Mark",
        "file" => "templates/pages/mark_edit.tpl.php"
    ],
    "mark_delete" => [
        "title" => "Delete Mark",
        "file" => "templates/pages/mark_delete.tpl.php"
    ],
    "messages" => [
        "title" => "Messages",
        "file" => "templates/pages/messages.tpl.php"
    ],
    "login" => [
        "title" => "Login",
        "file" => "templates/pages/login.tpl.php"
    ],
    "logout" => [
        "title" => "Logout",
        "file" => "templates/pages/logout.tpl.php"
    ],
    "404" => [
        "title" => "Page not found",
        "file" => "templates/pages/404.tpl.php"
    ]
];

if (!array_key_exists($page, $pages)) {
    $page = "404";
}

if ($page === "messages" && !isset($_SESSION["user"])) {
    header("Location: index.php?page=login");
    exit;
}

$template_file = $pages[$page]["file"];
$window_title = $pages[$page]["title"];

$menu = [
    "index.php?page=home" => "Mainpage",
    "index.php?page=images" => "Images",
    "index.php?page=contact" => "Contact",
    "index.php?page=table" => "CRUD"
];

if (isset($_SESSION["user"])) {
    $menu["index.php?page=messages"] = "Messages";
    $menu["index.php?page=logout"] = "Logout";
} else {
    $menu["index.php?page=login"] = "Login";
}

include "templates/index.tpl.php";
?>