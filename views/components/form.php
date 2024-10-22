<form method="post" class="form max-w-96 w-full mx-auto p-6 rounded-lg bg-zinc-700">
  <input type="hidden" name="csfr_token" value="<?= csfr(); ?>" required />
  <input type="hidden" name="uuid" id="uuid" value="<?= uuid(); ?>" required />
  <input type="hidden" name="title" id="title" required />

  <div class="flex gap-2 flex-col">
    <label for="name" class="font-bold">Nome</label>
    <input type="text" name="name" id="name" required class="text-zinc-700 rounded-lg p-2 focus:outline-indigo-700 focus:outline-offset-2" />
  </div>
  <div class="mt-4 flex gap-2 flex-col">
    <label for="email" class="font-bold">E-mail</label>
    <input type="email" name="email" id="email" required class="text-zinc-700 rounded-lg p-2 focus:outline-indigo-700 focus:outline-offset-2" />
  </div>
  <div class="mt-4 flex gap-2 flex-col">
    <label for="password" class="font-bold">Senha</label>
    <input type="password" name="password" id="password" required class="text-zinc-700 rounded-lg p-2 focus:outline-indigo-700 focus:outline-offset-2" />
  </div>

  <?php if (isset($formErrors)): ?>
    <div class="mt-4 form-errors p-3 text-sm bg-red-400 rounded-lg ">
      <?php foreach ($formErrors as $key => $error): ?>
        <p>*<span class="font-bold"><?= $key ?>: </span><?= $error ?></p>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <button type="submit" class="btn mt-8 rounded-lg bg-indigo-700 text-zinc-100 p-2 w-full font-bold uppercase">Cadastrar</button>
</form>