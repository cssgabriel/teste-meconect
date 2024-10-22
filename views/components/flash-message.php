<?php if (isset($flashMessage) && $flashMessage): ?>
  <div class="absolute p-2 rounded-lg top-10 right-10 bg-red-400">
    <?= $flashMessage; ?>
  </div>
<?php endif; ?>