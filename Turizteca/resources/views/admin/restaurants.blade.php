@extends('layouts.dashboard')

@section('title', 'Turizteca — Resumen')
@section('breadcrumb', 'Resumen')

@section('content')
  <div class="grid grid-cols-1 gap-4">
    @if (session('success'))
      <div class="p-3 rounded bg-emerald-600/10 text-emerald-400 border border-emerald-700">
        {{ session('success') }}
      </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
      <div class="card p-5">
        <div class="text-sm muted">Restaurantes totales</div>
        <div class="mt-2 text-3xl font-semibold">{{ $totalRestaurants }}</div>
      </div>

      <div class="card p-5">
        <div class="text-sm muted">Patrocinios activos</div>
        <div class="mt-2 text-3xl font-semibold">{{ $activeSponsorships }}</div>
      </div>

      <div class="card p-5">
        <div class="text-sm muted">Calificación promedio</div>
        <div class="mt-2 text-3xl font-semibold">
          {{ $averageRating ? number_format((float) $averageRating, 2) : '—' }}
        </div>
      </div>

      <div class="card p-5">
        <div class="text-sm muted">Usuarios registrados</div>
        <div class="mt-2 text-3xl font-semibold">{{ $registeredUsers }}</div>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
      <div class="card col-span-1 xl:col-span-2">
        <div class="card-header"><div class="text-base font-semibold">Desempeño de patrocinios</div></div>
        <div class="card-body"><div class="text-sm text-slate-400">Conecta tu base de datos para mostrar gráficos.</div></div>
      </div>
      <div class="card">
        <div class="card-header"><div class="text-base font-semibold">Distribución por tipo de cocina</div></div>
        <div class="card-body"><div class="text-sm text-slate-400">Sin datos por ahora.</div></div>
      </div>
    </div>

    <div class="card">
      <div class="card-header"><div class="text-base font-semibold">Mapa de restaurantes</div></div>
      <div class="card-body"><div class="text-sm text-slate-400">Integra tus coordenadas para mostrar el mapa.</div></div>
    </div>
  </div>
@endsection