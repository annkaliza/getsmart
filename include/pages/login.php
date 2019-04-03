<?php

if (!empty($site_user)) {
    // echo '<div>logged in as ' . $site_user['username'].'</div>';
    echo '<a href="?p=' . $page . '&logout">Logout</a>';
} else {

    ?>


<form method="post" action="?p=<?php echo $page ?>">
    <input type="hidden" name="login">
    <div>
        Username: <input type="text" name="username" />
    </div>
    <div>
        password: <input type="password" name="pass" />
    </div>
    <input type="submit" value="login" />

</form>

<?php

}
