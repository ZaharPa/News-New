<?php
use scripts\class\Article;
use scripts\Database;

require 'vendor/autoload.php';


session_start();

if (isset($_GET['logOut'])){
    session_destroy();
    header("Location: index.php");
}


$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$title = $page;

if ($page != 'register' && $page != 'login') 
{
    if ($page === 'admin' || $page === 'add_news' || $page === 'edit_page')
            include 'include/header_for_admin.php';
    else include 'include/header_for_user.php';
}

switch($page) {
    case 'home':
        include 'pages/home.php';
        break;
    case 'newsOfDay':
        $curArticle = new Article;
        $link = Database::getLink();
        $article = $curArticle->news_of_day($link);
        if ($article === null)
            $article = "";
        include 'pages/article_view.php';
        break;
    case 'aboutUs':
        include 'pages/aboutUs.php';
        break;
    case 'admin':
        include 'pages/admin.php';
        break;
    case 'login':
        include 'pages/login.php';
        break;
    case 'register': 
        include 'pages/registration.php';
        break;
    case 'addNews':
        include 'pages/add_news.php';
        break;
    case 'editNews':
        include 'pages/edit_page.php';
        break;
    case 'article':
        include 'pages/article_view.php';
        break;
    default:
        include 'pages/home.php';
        break;
}

if ($page != 'register' && $page != 'login')
    include 'include/footer.php';