<?php

$page_content = $tools->markdown('Sample page 1.');

$page_content .= $tools->addFillerText('m', 1);

echo $page_content;
