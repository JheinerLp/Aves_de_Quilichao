<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceso Administrativo | BioAves Quilichao</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="bg-[#FFFFFF] text-[#333333] font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-[#D0D0D0] selection:text-[#333333]">

  <header class="border-b border-[#B0B0B0] bg-[#FFFFFF] py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex flex-col group">
        <span class="text-base font-black tracking-widest text-[#333333] uppercase">
          BIOAVES QUILICHAO
        </span>
        <span class="text-[10px] font-mono tracking-wider text-[#777777] uppercase -mt-0.5">
          Santander de Quilichao • Panel Privado
        </span>
      </a>
      <a href="{{ route('home') }}" class="btn-wireframe-secondary text-xs py-1.5 px-3">
        ← Volver al Sitio Público
      </a>
    </div>
  </header>

  <main class="flex-1 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-[#FFFFFF] border-2 border-[#333333] p-8 rounded-sm shadow-xl space-y-6">
      
      <div class="space-y-1 text-center">
        <div class="inline-block px-2.5 py-0.5 bg-[#D0D0D0] text-[#333333] text-[10px] font-mono font-bold tracking-wider uppercase border border-[#B0B0B0]">
          Módulo de Autenticación
        </div>
        <h1 class="text-2xl font-black text-[#333333]">
          Ingreso Administrativo
        </h1>
        <p class="text-xs text-[#777777]">
          Gestión de especies, moderación de avistamientos y auditoría.
        </p>
      </div>

      @if ($errors->any())
        <div class="p-3 bg-[#F2F2F2] border-2 border-[#333333] rounded-sm text-xs text-[#333333] space-y-1">
          <span class="font-bold block">[ERROR DE ACCESO]</span>
          <ul class="list-disc list-inside text-[11px] text-[#777777]">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf

        <div class="space-y-1">
          <label for="email" class="block text-xs font-mono font-bold uppercase text-[#333333]">
            Correo Electrónico:
          </label>
          <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email', 'admin@bioavesquilichao.co') }}"
            required
            autocomplete="email"
            autofocus
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs text-[#333333] rounded-sm focus:outline-none focus:border-[#333333]"
            placeholder="usuario@bioavesquilichao.co"
          >
        </div>

        <div class="space-y-1">
          <label for="password" class="block text-xs font-mono font-bold uppercase text-[#333333]">
            Contraseña de Seguridad:
          </label>
          <input
            id="password"
            name="password"
            type="password"
            value="AdminBioAves2026!"
            required
            autocomplete="current-password"
            class="w-full bg-[#FFFFFF] border border-[#B0B0B0] px-3 py-2 text-xs text-[#333333] rounded-sm focus:outline-none focus:border-[#333333]"
          >
        </div>

        <div class="flex items-center justify-between text-xs pt-1">
          <label class="flex items-center gap-2 cursor-pointer select-none">
            <input type="checkbox" name="remember" class="border border-[#B0B0B0] rounded-xs">
            <span class="text-[#777777] text-[11px]">Recordar sesión</span>
          </label>
          <span class="text-[11px] font-mono text-[#777777]">Ambiente Seguro</span>
        </div>

        <button type="submit" class="w-full btn-wireframe-primary py-2.5 text-center text-xs block">
          Iniciar Sesión en el Panel
        </button>
      </form>

      <!-- Credenciales de prueba demostrativas -->
      <div class="p-3 bg-[#F2F2F2] border border-[#B0B0B0] rounded-sm space-y-1 text-[11px] font-mono">
        <span class="font-bold text-[#333333] block">[CREDENCIALES DE ACCESO ADMINISTRATIVO]:</span>
        <div class="text-[#777777]">
          <span>• Administrador: <code>admin@bioavesquilichao.co</code> / <code>AdminBioAves2026!</code></span>
        </div>
      </div>

    </div>
  </main>

  <footer class="border-t border-[#B0B0B0] bg-[#FFFFFF] py-4 text-center text-[11px] font-mono text-[#777777]">
    BioAves Quilichao • Control de Acceso Monocromático • Santander de Quilichao, Cauca
  </footer>

</body>
</html>
