<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://unpkg.com; style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com; img-src 'self' data: blob: https: http:; media-src 'self' data: blob: http: https:; connect-src 'self' https: http:; font-src 'self' data: https:;">
  <title>@yield('title', 'Panel Administrativo') | BioAves Quilichao</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="bg-[#FFFFFF] text-[#333333] font-sans antialiased min-h-screen flex flex-col selection:bg-[#D0D0D0] selection:text-[#333333]">

  <!-- Encabezado Superior Administrativo -->
  <header class="border-b-2 border-[#333333] bg-[#FFFFFF] sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      
      <div class="flex items-center gap-4">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col">
          <span class="text-base font-black tracking-widest text-[#333333] uppercase">
            BIOAVES PANEL
          </span>
          <span class="text-[10px] font-mono text-[#777777] uppercase -mt-0.5">
            Administración • Santander de Quilichao
          </span>
        </a>

        <div class="hidden md:block h-6 w-px bg-[#B0B0B0]"></div>

        <nav class="hidden md:flex items-center gap-1 text-xs font-semibold">
          <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-sm border {{ request()->routeIs('admin.dashboard') ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'text-[#333333] hover:bg-[#F2F2F2] border-transparent hover:border-[#B0B0B0]' }}">
            Dashboard
          </a>
          <a href="{{ route('admin.species.index') }}" class="px-3 py-1.5 rounded-sm border {{ request()->routeIs('admin.species.*') ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'text-[#333333] hover:bg-[#F2F2F2] border-transparent hover:border-[#B0B0B0]' }}">
            Especies
          </a>
          <a href="{{ route('admin.sightings.index') }}" class="px-3 py-1.5 rounded-sm border {{ request()->routeIs('admin.sightings.*') ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'text-[#333333] hover:bg-[#F2F2F2] border-transparent hover:border-[#B0B0B0]' }}">
            Avistamientos
          </a>
          @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.audit-logs.index') }}" class="px-3 py-1.5 rounded-sm border {{ request()->routeIs('admin.audit-logs.*') ? 'bg-[#333333] text-[#FFFFFF] border-[#333333]' : 'text-[#333333] hover:bg-[#F2F2F2] border-transparent hover:border-[#B0B0B0]' }}">
              Auditoría
            </a>
          @endif
        </nav>
      </div>

      <div class="flex items-center gap-3">
        <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex btn-wireframe-ghost text-xs py-1 px-2.5">
          Ver Sitio Público ↗
        </a>

        <div class="flex items-center gap-2 pl-2 border-l border-[#B0B0B0]">
          <div class="text-right hidden sm:block">
            <span class="text-xs font-bold block leading-tight text-[#333333]">{{ auth()->user()->name }}</span>
            <span class="text-[10px] font-mono text-[#777777]">
              {{ auth()->user()->roles->pluck('name')->join(', ') ?: 'Usuario' }}
            </span>
          </div>

          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="btn-wireframe-secondary text-xs py-1 px-2.5" title="Cerrar Sesión">
              Salir
            </button>
          </form>
        </div>

      </div>

    </div>

    <!-- Navegación móvil secundaria -->
    <div class="md:hidden flex items-center justify-between px-4 py-2 bg-[#F2F2F2] border-t border-[#B0B0B0] text-xs font-semibold overflow-x-auto">
      <a href="{{ route('admin.dashboard') }}" class="px-2 py-1 {{ request()->routeIs('admin.dashboard') ? 'font-black underline' : '' }}">Dashboard</a>
      <a href="{{ route('admin.species.index') }}" class="px-2 py-1 {{ request()->routeIs('admin.species.*') ? 'font-black underline' : '' }}">Especies</a>
      <a href="{{ route('admin.sightings.index') }}" class="px-2 py-1 {{ request()->routeIs('admin.sightings.*') ? 'font-black underline' : '' }}">Avistamientos</a>
      @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.audit-logs.index') }}" class="px-2 py-1 {{ request()->routeIs('admin.audit-logs.*') ? 'font-black underline' : '' }}">Auditoría</a>
      @endif
      <a href="{{ route('home') }}" class="px-2 py-1 underline">Sitio ↗</a>
    </div>
  </header>

  <!-- Contenido Central -->
  <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    
    <!-- Mensajes Flash -->
    @if(session('success'))
      <div class="p-4 bg-[#F2F2F2] border-2 border-[#333333] rounded-sm text-xs text-[#333333] flex items-center justify-between">
        <div class="flex items-center gap-2">
          <span class="font-mono font-bold text-sm">[ÉXITO]:</span>
          <span>{{ session('success') }}</span>
        </div>
        <span class="text-[10px] font-mono text-[#777777]">Acción confirmada</span>
      </div>
    @endif

    @if(session('error'))
      <div class="p-4 bg-[#FFFFFF] border-2 border-[#777777] rounded-sm text-xs text-[#333333] flex items-center justify-between">
        <div class="flex items-center gap-2">
          <span class="font-mono font-bold text-sm">[ERROR]:</span>
          <span>{{ session('error') }}</span>
        </div>
        <span class="text-[10px] font-mono text-[#777777]">Atención requerida</span>
      </div>
    @endif

    @yield('content')

  </main>

  <footer class="border-t border-[#B0B0B0] bg-[#F2F2F2] py-4 text-center text-[11px] font-mono text-[#777777]">
    Panel Administrativo BioAves Quilichao • Versión 1.0.0 • Escala de Grises Monocromática Estricta
  </footer>

  @yield('scripts')
</body>
</html>
