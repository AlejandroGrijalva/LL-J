import { useState, useEffect, useCallback } from 'react';
import Map, { Marker, Popup } from 'react-map-gl/mapbox';
import 'mapbox-gl/dist/mapbox-gl.css';
import { useNavigate } from 'react-router-dom';
import { getRestaurants } from '../api';
import type { Restaurant, CuisineType } from '../types';
import { CUISINE_LABELS, CUISINE_EMOJI } from '../types';

const MAPBOX_TOKEN = import.meta.env.VITE_MAPBOX_TOKEN;

const DEFAULT_CENTER = { longitude: -96.9, latitude: 19.5, zoom: 5 };

const CUISINE_FILTERS: { key: CuisineType | 'all'; label: string }[] = [
  { key: 'all', label: 'Todos' },
  { key: 'mexican', label: 'Mexicana' },
  { key: 'seafood', label: 'Mariscos' },
  { key: 'cafe', label: 'Café' },
  { key: 'italian', label: 'Italiana' },
  { key: 'vegan', label: 'Vegana' },
];

export default function Explore() {
  const navigate = useNavigate();
  const [restaurants, setRestaurants] = useState<Restaurant[]>([]);
  const [selected, setSelected] = useState<Restaurant | null>(null);
  const [filter, setFilter] = useState<CuisineType | 'all'>('all');
  const [viewState, setViewState] = useState(DEFAULT_CENTER);
  const [showFilters, setShowFilters] = useState(false);
  const [userLocation, setUserLocation] = useState<{ lng: number; lat: number } | null>(null);

  useEffect(() => {
    getRestaurants()
      .then(res => setRestaurants(Array.isArray(res.data) ? res.data : res.data.data ?? []))
      .catch(() => {});

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(pos => {
        setUserLocation({ lng: pos.coords.longitude, lat: pos.coords.latitude });
        setViewState(v => ({ ...v, longitude: pos.coords.longitude, latitude: pos.coords.latitude, zoom: 12 }));
      });
    }
  }, []);

  const mapped = restaurants.filter(r =>
    r.location_lat && r.location_lng &&
    (filter === 'all' || r.cuisine_type === filter)
  );

  const handleMarkerClick = useCallback((r: Restaurant) => {
    setSelected(r);
    if (r.location_lat && r.location_lng) {
      setViewState(v => ({ ...v, longitude: r.location_lng!, latitude: r.location_lat!, zoom: 14 }));
    }
  }, []);

  return (
    <div className="h-screen w-full relative">
      {/* Map */}
      <Map
        {...viewState}
        onMove={e => setViewState(e.viewState)}
        mapStyle="mapbox://styles/mapbox/streets-v12"
        mapboxAccessToken={MAPBOX_TOKEN}
        style={{ width: '100%', height: '100%' }}
      >
        {/* User location marker */}
        {userLocation && (
          <Marker longitude={userLocation.lng} latitude={userLocation.lat}>
            <div className="w-5 h-5 bg-tertiary rounded-full border-2 border-white shadow-md animate-pulse" />
          </Marker>
        )}

        {/* Restaurant markers */}
        {mapped.map(r => (
          <Marker
            key={r.id}
            longitude={r.location_lng!}
            latitude={r.location_lat!}
            onClick={e => { e.originalEvent.stopPropagation(); handleMarkerClick(r); }}
          >
            <div
              className={`flex flex-col items-center cursor-pointer transition-transform hover:scale-110 ${selected?.id === r.id ? 'scale-125' : ''}`}
            >
              {selected?.id === r.id ? (
                <div className="bg-primary text-on-primary px-3 py-1.5 rounded-xl shadow-xl flex items-center gap-1.5 text-xs font-bold">
                  <span className="material-symbols-outlined text-sm" style={{ fontVariationSettings: "'FILL' 1" }}>restaurant</span>
                  {r.name}
                </div>
              ) : (
                <div className="w-10 h-10 bg-surface-bright rounded-full shadow-lg flex items-center justify-center border-2 border-outline/20 text-lg">
                  {CUISINE_EMOJI[r.cuisine_type] || '🍽️'}
                </div>
              )}
              {selected?.id === r.id && (
                <div className="w-3 h-3 bg-primary rotate-45 -mt-1.5 shadow" />
              )}
            </div>
          </Marker>
        ))}

        {/* Popup */}
        {selected && selected.location_lat && selected.location_lng && (
          <Popup
            longitude={selected.location_lng}
            latitude={selected.location_lat}
            onClose={() => setSelected(null)}
            closeButton={false}
            anchor="bottom"
            offset={20}
          >
            <div
              className="bg-surface-bright rounded-2xl p-3 shadow-xl flex gap-3 cursor-pointer w-64"
              onClick={() => navigate(`/restaurant/${selected.id}`)}
            >
              <div className="w-16 h-16 rounded-xl bg-surface-container flex items-center justify-center text-3xl flex-shrink-0">
                {CUISINE_EMOJI[selected.cuisine_type] || '🍽️'}
              </div>
              <div className="flex-1 min-w-0">
                <span className="text-[10px] font-bold font-label text-tertiary uppercase tracking-tighter">
                  {CUISINE_LABELS[selected.cuisine_type]}
                </span>
                <h3 className="font-headline text-sm font-bold text-on-surface leading-tight truncate">{selected.name}</h3>
                {(selected.avg_rating ?? 0) > 0 && (
                  <div className="flex items-center gap-1 mt-1">
                    <span className="material-symbols-outlined text-xs text-secondary-fixed-dim" style={{ fontVariationSettings: "'FILL' 1" }}>star</span>
                    <span className="text-[10px] font-bold text-on-surface/60">{selected.avg_rating?.toFixed(1)}</span>
                  </div>
                )}
                <span className="text-[10px] text-primary font-bold mt-1 block">Ver detalles →</span>
              </div>
            </div>
          </Popup>
        )}
      </Map>

      {/* Top Header (over map) */}
      <div className="absolute top-0 left-0 right-0 z-10 flex justify-between items-center px-6 py-4 glass-header">
        <div className="flex items-center gap-3">
          <span className="material-symbols-outlined text-primary">menu</span>
          <h1 className="text-xl font-black tracking-tight font-headline text-primary">Turizteca</h1>
        </div>
        <button
          onClick={() => setShowFilters(f => !f)}
          className="flex items-center gap-2 px-4 py-2 bg-surface-container rounded-full text-primary font-bold text-sm shadow-sm"
        >
          <span className="material-symbols-outlined text-sm">tune</span>
          <span className="font-label uppercase tracking-widest text-[10px]">Filtros</span>
        </button>
      </div>

      {/* Filter Chips */}
      {showFilters && (
        <div className="absolute top-16 left-0 right-0 z-10 flex gap-2 overflow-x-auto hide-scrollbar px-6 py-3">
          {CUISINE_FILTERS.map(f => (
            <button
              key={f.key}
              onClick={() => setFilter(f.key)}
              className={`flex-none px-4 py-2 rounded-full text-xs font-bold transition-all shadow-sm ${
                filter === f.key
                  ? 'bg-primary text-on-primary'
                  : 'bg-surface-bright/90 text-on-surface'
              }`}
            >
              {f.label}
            </button>
          ))}
        </div>
      )}

      {/* Search this area button */}
      <div className="absolute top-24 left-1/2 -translate-x-1/2 z-10">
        <button
          onClick={() => {}}
          className="bg-secondary-container text-on-secondary-container px-5 py-2.5 rounded-full shadow-xl flex items-center gap-2 font-label font-bold text-sm uppercase tracking-wider hover:scale-105 active:scale-95 transition-all"
        >
          <span className="material-symbols-outlined text-base">refresh</span>
          Buscar aquí
        </button>
      </div>

      {/* Bottom carousel */}
      {mapped.length > 0 && (
        <div className="absolute bottom-24 left-0 w-full z-10">
          <div className="flex gap-4 overflow-x-auto px-6 hide-scrollbar snap-x">
            {mapped.map(r => (
              <div
                key={r.id}
                className={`min-w-[260px] snap-center bg-surface-bright/90 backdrop-blur-md rounded-2xl p-3 shadow-xl flex gap-3 cursor-pointer transition-all ${
                  selected?.id === r.id ? 'ring-2 ring-primary' : 'opacity-90'
                }`}
                onClick={() => handleMarkerClick(r)}
              >
                <div className="w-20 h-20 rounded-xl bg-surface-container flex items-center justify-center text-4xl flex-shrink-0">
                  {CUISINE_EMOJI[r.cuisine_type] || '🍽️'}
                </div>
                <div className="flex flex-col justify-center py-1 min-w-0">
                  <span className="bg-secondary-container text-on-secondary-container text-[9px] font-bold px-2 py-0.5 rounded-full font-label uppercase tracking-tighter w-fit mb-1">
                    {CUISINE_LABELS[r.cuisine_type]}
                  </span>
                  <h3 className="font-headline text-sm text-on-surface font-bold leading-tight truncate">{r.name}</h3>
                  <button
                    className="text-xs font-bold text-primary mt-1 text-left hover:underline"
                    onClick={e => { e.stopPropagation(); navigate(`/restaurant/${r.id}`); }}
                  >
                    Ver detalle →
                  </button>
                </div>
              </div>
            ))}
          </div>
        </div>
      )}

      {/* Zoom Controls */}
      <div className="absolute right-6 top-1/2 -translate-y-1/2 z-10 flex flex-col gap-2">
        <button
          className="w-11 h-11 bg-surface-bright/90 backdrop-blur-md rounded-full shadow-lg flex items-center justify-center text-primary active:scale-90 transition-transform"
          onClick={() => setViewState(v => ({ ...v, zoom: Math.min(v.zoom + 1, 20) }))}
        >
          <span className="material-symbols-outlined">add</span>
        </button>
        <button
          className="w-11 h-11 bg-surface-bright/90 backdrop-blur-md rounded-full shadow-lg flex items-center justify-center text-primary active:scale-90 transition-transform"
          onClick={() => setViewState(v => ({ ...v, zoom: Math.max(v.zoom - 1, 2) }))}
        >
          <span className="material-symbols-outlined">remove</span>
        </button>
        {userLocation && (
          <button
            className="w-11 h-11 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center mt-3 active:scale-90 transition-transform"
            onClick={() => setViewState(v => ({ ...v, longitude: userLocation.lng, latitude: userLocation.lat, zoom: 13 }))}
          >
            <span className="material-symbols-outlined" style={{ fontVariationSettings: "'FILL' 1" }}>near_me</span>
          </button>
        )}
      </div>

      {/* Bottom nav placeholder */}
      <nav className="fixed bottom-0 left-0 w-full glass-header flex justify-around items-center px-4 pb-6 pt-3 z-10 rounded-t-[1.5rem] shadow-[0_-10px_40px_rgba(74,37,7,0.06)]">
        {[
          { icon: 'home', label: 'Home', path: '/' },
          { icon: 'explore', label: 'Discover', active: true },
          { icon: 'favorite', label: 'Saved', path: '/saved' },
          { icon: 'person_outline', label: 'Profile', path: '/profile' },
        ].map(tab => (
          <a
            key={tab.label}
            href={tab.path ?? '#'}
            className={`flex flex-col items-center justify-center px-5 py-2 rounded-[1rem] transition-all ${
              tab.active
                ? 'bg-secondary-container text-on-surface scale-110'
                : 'text-on-surface opacity-60 hover:opacity-100'
            }`}
          >
            <span className="material-symbols-outlined" style={tab.active ? { fontVariationSettings: "'FILL' 1" } : undefined}>
              {tab.icon}
            </span>
            <span className="font-label text-[10px] font-bold uppercase tracking-widest mt-1">{tab.label}</span>
          </a>
        ))}
      </nav>
    </div>
  );
}
