<?php
use scripts\Database;
use scripts\class\Article;

if (!isset($link)){
    
    $link = Database::getLink();
    $curArticle = new Article();
    $article = $curArticle->views_once_article($link, $_GET['id']);
    if (isset($_GET['action']) && $_GET['action'] === 'add_view'){
        $curArticle->add_view($link, $_GET['id']);
    }
}
?>


<div class="once-news">
	<div class="photoNews">
		<img src="<?php echo $article['path'] . $article['img_name']?>" alt="">
	</div>
	<div class="content">
		<h1><?=$article['name']?></h1>
		<h4>Автор статті <?=$article['author']?></h4>
		<p><?=$article['description']?>
	</div>
	<div class="count-view">
		<?=$article['date']?> Views - <?=$article['views']?>
	</div>
</div>

<script>
setTimeout(function() {
	fetch("index.php?page=article&id=<?=$_GET['id']?>&action=add_view");
}, 5000);
</script>