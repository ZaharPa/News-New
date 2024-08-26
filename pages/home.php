<?php 
    use scripts\Database;
    use scripts\class\Article;
    
    $link = Database::getLink();
    $curNews = new Article();
    
    if(isset($_GET['filter']) && $_GET['filter'] === 'views')
        $articles = $curNews->views_news_views($link);
    else
        $articles = $curNews->views_news($link);
    
    $itemPerPage = 3;
    $totalItems = count($articles);
    $totalPages = ceil($totalItems / $itemPerPage);
    
    $number = isset($_GET['number']) ? (int)$_GET['number'] : 1;
    
    $startIndex = ($number - 1) * $itemPerPage;
    $endIndex = min($startIndex + $itemPerPage, $totalItems);
?>


<div class="listOfNews">
	<div class="filter">
		<h4>Filter: </h4>
        <a href="index.php?page=home">Date</a>
        <a href="index.php?page=home&filter=views">Views</a>
    </div>
    
	<?php for ($i = $startIndex; $i < $endIndex; $i++) { ?>	
		<div class="article">
			<div class="photoNews">
				<img src="<?=$articles[$i]['path']?><?=$articles[$i]['img_name']?>" alt=''>
			</div>
			<div class="content">
				<h2><?=$articles[$i]['name']?></h2>
				<p><?php echo substr($articles[$i]['description'], 0, 500) . '...'?></p>
				<div class="actions">
					<span><a href="index.php?page=article&id=<?=htmlspecialchars($articles[$i]['id'])?>">Read more</a></span>
				</div>
			</div>
			<div class="count-view">
				<?=$articles[$i]['date']?> Views - <?=$articles[$i]['views']?>
			</div>
		</div>
	<?php }?>
	
	<div class="pagination">
    	<?php
    	for ($i = 1; $i <= $totalPages; $i++){
    	   echo "<a href='?page=home&number=$i'>$i</a> ";
    	}
    	?>
	</div>
</div>