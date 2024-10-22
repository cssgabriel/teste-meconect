<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? "Teste Meconect" ?></title>
</head>

<body>
  <div id="app" class="h-screen bg-zinc-900 text-zinc-100 relative p-6">

    <?php if (isset($flashMessage)): ?>
      <?= $this->fetch("components/flash-message", ["flashMessage" => $flashMessage]); ?>
    <?php endif ?>

    <?= $this->section("content") ?>

  </div>

  <script type="module" src="/assets/js/main.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>