<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="addons/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="addons/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>MVC</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MVC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <?php $currentTable = $_GET['table'] ?? 'students'; ?>
            <li class="nav-item">
                <a class="nav-link <?= $currentTable == 'students' ? 'active' : '' ?>" href="index.php?table=students&action=index">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $currentTable == 'fakultas' ? 'active' : '' ?>" href="index.php?table=fakultas&action=index">Fakultas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $currentTable == 'jurusan' ? 'active' : '' ?>" href="index.php?table=jurusan&action=index">Jurusan</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
</body>
</html>

