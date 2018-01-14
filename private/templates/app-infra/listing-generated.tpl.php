
<?php if (!empty($directory_manifest)): ?>
    <ul>
        <?php foreach ($directory_manifest as $item): ?>
            <li>
                <a href="<?php echo $item['link_href']; ?>">
                    <?php echo $item['link_text']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>There doesn't seem to be any generated snapshots right now.</p>
<?php endif; ?>
