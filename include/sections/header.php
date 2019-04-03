<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GetSmart - <?php echo $page_data['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <!-- <script src="main.js"></script> -->
</head>

<body>

    <header>
        <a href="?home">
            <h1>Get Smart</h1>
        </a>
        <?php
        if (!empty($site_user)) {
            echo '<div>logged in as ' . $site_user['username'] . '</div>';
        }
        ?>
    </header> 