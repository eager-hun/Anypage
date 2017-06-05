
<nav class="app-menu">
    <ul>
        <?php foreach($app_menu_items as $item): ?>
            <?php if ($item['item_type'] == 'topic-title'): ?>
                <li class="app-menu__item app-menu__topic-title">
                    <span class="item__text">
                        <?php echo $item['text']; ?>
                    </span>
                </li>
            <?php elseif ($item['item_type'] == 'link'): ?>
                <li class="app-menu__item">
                    <a href="<?php echo $item['url']; ?>" class="app-menu__link">
                        <span class="link__text">
                            <?php echo $item['text']; ?>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</nav>
