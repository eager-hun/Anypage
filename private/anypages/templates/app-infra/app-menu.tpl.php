<nav class="app-menu">
    <ul>
        <?php foreach($app_menu_items as $item): ?>
            <li class="app-menu__item">
                <a href="<?php echo $item['url']; ?>" class="app-menu__link">
                    <span class="link__text">
                        <?php echo $item['text']; ?>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
