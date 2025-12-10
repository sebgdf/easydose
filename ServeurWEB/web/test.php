<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur EASYDOSE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="divimg">
	<img src="logo.png" alt="logo" class="logo" >
</div>
<div class='welcomtitle'>
	<div>
		<h1>Bienvenue sur la plateforme de test du projet EASYDOSE.</h1>
	</div>
    <form action="upload-manager.php" method="post" enctype="multipart/form-data">
        <h2>Upload des fichiers DCM</h2>
        <label for="fileSelect">Fichier DICOM:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        
    </form>
 </div>
</body>
</html>
