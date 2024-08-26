<?php
namespace scripts\interface;

interface News
{
    public function add_news($link, $author, $title, $description, $photoName = null);
    public function edit_news($link, $id, $title, $description, $photoName = null);
    public function delete_news($link, $id);
    public function add_view($link, $id);
    public function nameForImageNews($link);
    public function views_news ($link);
    public function views_once_article($link, $id);
    public function news_of_day($link);
    public function views_news_views($link);
}

