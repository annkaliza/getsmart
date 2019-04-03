<nav>
    <?php

    $menu = new NavMenu('main-menu');
    $menu->loadData('SELECT label, pageKey as `key`, menuOrder as `order` FROM navmenu JOIN page ON navmenu.pageId = page.pageId');
    $menu->setActive($page);
    echo $menu;

    ?>
</nav> 