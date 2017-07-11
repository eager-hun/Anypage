
<ul>
    <?php foreach ($directory_manifest as $item): ?>
        <li>
            <a href="<?php echo $item['link_href']; ?>">
                <?php echo $item['link_text']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
