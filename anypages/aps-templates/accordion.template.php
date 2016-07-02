<ul class="accordion <?php echo $wrapper_extra_classes; ?>" data-accordion>
  <?php foreach ($items as $item): ?>
    <li class="accordion-item" data-accordion-item>
      <a href="#" class="accordion-title">
        <?php echo $item['title']; ?>
      </a>
      <div class="accordion-content" data-tab-content>
        <?php echo $item['content'];?>
      </div>
    </li>
  <?php endforeach; ?>
</ul>

