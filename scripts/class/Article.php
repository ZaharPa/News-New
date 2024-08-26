<?php
namespace scripts\class;

use scripts\interface\News;

class Article implements News
{

    public function add_view($link, $id)
    {
        $id = (int)$id;
        
        $query = "UPDATE article SET views = views + 1 WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        
        if ($stmt === false){
            die("Error prepare query " . mysqli_error($link));
            return false;
        }
        
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $result = mysqli_stmt_execute($stmt);
        
        if($result === false){
            die("Error: " . mysqli_stmt_error($stmt));
            return false;
        }
        
        mysqli_stmt_close($stmt);
        
        return true;
    }

    public function add_news($link, $author, $title, $description, $photoName = null)
    {        
        if($photoName != null)
            $query = "INSERT INTO article(name, description, date, author, img_name) VALUES (?, ?, ?, ?, ?)";
        else
            $query = "INSERT INTO article(name, description, date, author) VALUES (?, ?, ?, ?)";
            
        $stmt = mysqli_prepare($link, $query);
                
        if ($stmt === false){
            die("Error prepare query" . mysqli_error($link));
            return false;
        }
        
        $today = date("Y-m-d");
        
        if($photoName != null)
            mysqli_stmt_bind_param($stmt, 'sssss', $title, $description, $today, $author, $photoName);
        else
            mysqli_stmt_bind_param($stmt, 'ssss', $title, $description, $today, $author);
            
        $result = mysqli_stmt_execute($stmt);
                        
        if($result === false){
             die("Error " . mysqli_stmt_error($stmt));
             return false;
        }
                        
        mysqli_stmt_close($stmt);
                        
        return true;
    }

    public function delete_news($link, $id)
    {
        $id = (int)$id;
        
        $query = "DELETE FROM article WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        
        if (!$stmt) 
            die("Error preparing statement: " . mysqli_error($link));
        
        mysqli_stmt_bind_param($stmt, 'i', $id);
        
        $executed = mysqli_stmt_execute($stmt);
        
        if(!$executed)
            die("Error executing statement: " . mysqli_stmt_error($stmt));
            
        mysqli_stmt_close($stmt);
            
        return true;
    }

    public function edit_news($link, $id, $title, $description, $photoName = null)
    {
        $id = (int)$id;
        
        if($photoName != null)
            $query = "UPDATE article SET name = ?, description = ?, img_name = ? WHERE id = ?";
        else
            $query = "UPDATE article SET name = ?, description = ? WHERE id = ?";
            
        $stmt = mysqli_prepare($link, $query);
            
        if ($stmt === false){
            die("Error prepare query" . mysqli_error($link));
            return false;
        }
        
        if($photoName != null)
            mysqli_stmt_bind_param($stmt, 'sssi', $title, $description, $photoName, $id);
        else
            mysqli_stmt_bind_param($stmt, 'ssi', $title, $description, $id);
            
        $result = mysqli_stmt_execute($stmt);
        
        if($result === false){
            die("Error " . mysqli_stmt_error($stmt));
            return false;
        }
        
        mysqli_stmt_close($stmt);
        
        return true;        
    }
    
    public function nameForImageNews($link){
        $query = "SELECT MAX(id) as max_id FROM article LIMIT 1";
        $result = mysqli_query($link, $query);
        
        if(!$result)
            die(mysql_error($link));
        
        $row = mysqli_fetch_assoc($result);
        return $row['max_id'] + 1;
    }
    
    public function views_news($link){
        $query = "SELECT * FROM article ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        
        if (!$result)
            die("Database query failed: " . mysqli_error($link));
        
        $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $news;
    } 
    
    public function views_once_article($link, $id)
    {
        $id = (int)$id;
        
        $query = "SELECT * FROM article WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($link, $query);
        
        if (!$stmt)
            die("Error preparing statement: " . mysqli_error($link));
        
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) === 0)
            return null;
        
        $article = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
        
        return $article;
    }
    
    public function news_of_day($link)
    {
        $today = date("Y-m-d");
        
        $query = "SELECT * FROM article WHERE date = ? ORDER BY views DESC LIMIT 1";
        $stmt = mysqli_prepare($link, $query);
        
        if(!$stmt)
            die("Error preparing statemt: " . mysqli_error($link));
        
        mysqli_stmt_bind_param($stmt, 's', $today);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) === 0)
            return null;
        
        $article = mysqli_fetch_assoc($result);
        
        mysqli_stmt_close($stmt);
        
        return $article;
    }

    public function views_news_views($link)
    {
        $query = "SELECT * FROM article ORDER BY views DESC";
        $result = mysqli_query($link, $query);
        
        if (!$result)
            die("Database query failed: " . mysqli_error($link));
            
        $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        return $news;
    }
}

