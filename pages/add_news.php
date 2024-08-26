<?php 
use scripts\Database;
use scripts\class\Article;

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
    if (!empty($_POST)) {
        $curNews = new Article();
        $link = Database::getLink();
        $author = $_SESSION['name'];
        $title = htmlspecialchars($_POST['titleArticle'], ENT_QUOTES, 'UTF-8');
        
        if ($_FILES && $_FILES["imageArticle"]["error"] == UPLOAD_ERR_OK) {
            $fileMime = mime_content_type($_FILES["imageArticle"]["tmp_name"]);
            $allowedMime = ['image/jpeg', 'image/png'];
                
            if (in_array($fileMime, $allowedMime)) {
                $fileExtension = ($fileMime === 'image/jpeg') ? 'jpg' : 'png';
                $newFileName = "photoNews_" . $curNews->nameForImageNews($link) . "." . $fileExtension;
                $upload_image = $newFileName;
                    
                if ($curNews->add_news($link, $author, $title, $_POST['descripArticle'], $upload_image) === true) {
                    move_uploaded_file($_FILES["imageArticle"]["tmp_name"], "images/" . $newFileName);
                    header('Location: index.php?page=admin');
                    exit();
                } else {
                    $error = "Невірні дані";
                }
            } else {
                $error = "Невірний формат файлу (PNG, JPG)";
            }
        } else if ($curNews->add_news($link, $author, $title, $_POST['descripArticle']) === true) {
            header('Location: index.php?page=admin');
            exit();
        } else {
            $error = "Невірні дані";
        }
    }
    
?>


<div class="add-article">
	
	<?php if(isset($error)): ?>
    	<span style = "color: red">
       	<script> alert('<?php echo $error?>')</script>
    	</span>
    <?php endif; ?>
    
	<h1> Add new article</h1>
	<form id="form_add_news" method="post" enctype="multipart/form-data" action="index.php?page=addNews">
		<br>
		<label>Title</label>
		<input type="text" name="titleArticle" required>
		<br>
		<div class="form-group">
		<label for="decripArticle">Description</label>
		<textarea class="area" name="descripArticle" rows="5" required></textarea>
		<br>
		</div>
		<label>Upload image</label>
		<input type="file" name="imageArticle" id="imageArticle">
		<br>
		<input type="submit" value="submit">
	</form>
</div>

<script>
	document.getElementById('form_add_news').addEventListener('submit', function(event) {
		const fileInput = document.getElementById('imageArticle');
		const file = fileInput.files[0];
		const maxSize = 40 * 1024 * 1024; // 40 MB
		
		if (file && file.size > maxSize) {
			alert('File size is too large. Please choose a file smaller than 40 MB.');
			event.preventDefault();
		}
	});
</script>
<?php }?>