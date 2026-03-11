<!doctype html>
<html lang="es" class="h-full dark">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Turizteca — Iniciar sesión</title>
  <meta name="description" content="Acceso al panel de administración de Turizteca" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { brand: { 50:'#eef6ff',100:'#d9ebff',200:'#b7d9ff',300:'#8fc2ff',400:'#63a7ff',500:'#3b8aff',600:'#2563eb',700:'#1d4ed8',800:'#153f8c',900:'#122b61' } } } } };
  </script>
  <link rel="stylesheet" href="{{ asset('turizteca/css/turizteca-login.css') }}"> 
</head>
<body class="min-h-screen">
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-6">
        <div class="mx-auto h-12 w-12 rounded-xl bg-brand-600 flex items-center justify-center text-white font-bold">TZ</div>
        <h1 class="mt-3 text-2xl font-semibold">Turizteca</h1>
        <p class="mt-1 text-sm text-slate-400">Accede al panel de administración</p>
      </div>
      <div class="card p-6">
        <form method="POST" action="#" class="space-y-4">
          @csrf
          <div>
            <label for="email" class="text-sm text-slate-300">Correo electrónico</label>
            <input id="email" name="email" type="email" class="input mt-1" placeholder="tu@correo.com" required />
          </div>
          <div>
            <label for="password" class="text-sm text-slate-300">Contraseña</label>
            <div class="relative mt-1">
              <input id="password" name="password" type="password" class="input pr-10" placeholder="••••••••" required />
            </div>
          </div>
          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-slate-300">
              <input type="checkbox" class="h-4 w-4 rounded border-slate-600 bg-slate-800" />
              Recordarme
            </label>
            <a href="#" class="text-sm text-slate-300 hover:underline">¿Olvidaste tu contraseña?</a>
          </div>
          <button type="submit" class="btn btn-primary w-full">Iniciar sesión</button>
        </form>
      </div>
      <p class="mt-6 text-center text-xs muted">© {{ date('Y') }} Turizteca. Todos los derechos reservados.</p>
    </div>
  </div>
  @include('front.footer')
</body>
</html>
