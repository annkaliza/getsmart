Products

<?php

if (!empty($site_user)) {
    echo "<div>Browse our products</div>";
} else {
    echo "<div>You must be logged in to browse our products</div>";

    include('include/pages/login.php');
}

?> 