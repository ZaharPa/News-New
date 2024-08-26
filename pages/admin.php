<?php 
use scripts\Database;
use scripts\class\Article;

if(isset($_SESSION) && ($_SESSION['role'] === 'admin')) {
    $link = Database::getLink();
    $curNews = new Article();
    $articles = $curNews->views_news($link);
    
    if ($_GET['action'] === 'delete_page'){
        $curNews->delete_news($link, $_GET['id']);
        header('Location: index.php?page=admin');
    }
    
    $itemPerPage = 3;
    $totalItems = count($articles);
    $totalPages = ceil($totalItems / $itemPerPage);
    
    $number = isset($_GET['number']) ? (int)$_GET['number'] : 1;    
    
    $startIndex = ($number - 1) * $itemPerPage;
    $endIndex = min($startIndex + $itemPerPage, $totalItems);
?>


<div class="listOfNews">
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
					<span><a href="index.php?page=editNews&id=<?=htmlspecialchars($articles[$i]['id'])?>">Edit</a></span>
					<span><a href="index.php?page=admin&&action=delete_page&id=<?=htmlspecialchars($articles[$i]['id'])?>">Delete</a></span>
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
    	   echo "<a href='?page=admin&number=$i'>$i</a> ";
    	}
    	?>
	</div>
</div>

<?php }?>