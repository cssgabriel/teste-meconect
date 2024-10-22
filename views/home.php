<?php $this->layout('template') ?>

<main class="h-full text-center">
  <h1 class="text-zinc-100 text-4xl font-bold">Teste Meconect</h1>

  <form method="post" class="form max-w-96 w-full mx-auto p-6 rounded-lg bg-zinc-700 my-10">
    <div class="flex gap-2 flex-col">
      <label for="email" class="font-bold text-left">Email</label>
      <input type="text" name="email" id="email" required class="text-zinc-700 rounded-lg p-2 focus:outline-indigo-700 focus:outline-offset-2" />
    </div>
    <div class="mt-4 flex gap-2 flex-col">
      <label for="password" class="font-bold text-left">Senha</label>
      <input type="password" name="password" id="password" required class="text-zinc-700 rounded-lg p-2 focus:outline-indigo-700 focus:outline-offset-2" />
    </div>

    <button type="submit" class="btn mt-8 rounded-lg bg-indigo-700 text-zinc-100 p-2 w-full font-bold uppercase">Login</button>
  </form>

  <p>Não possui conta? <a href="/register" class="transition-colors border-b hover:border-blue-400 hover:text-blue-400">Realize seu cadastro</a></p>
</main>