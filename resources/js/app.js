const pistas = window.pistas ?? [];
let i = Number(localStorage.getItem('sonora_pista_idx') ?? 0);
if (i >= pistas.length) i = 0;
let t = Number(localStorage.getItem('sonora_pista_t') ?? 0);
let temporizador = null;
let aleatorio = false;

const $ = (sel) => document.querySelector(sel);
const $$ = (sel) => document.querySelectorAll(sel);
const fmt = (s) => `${String(Math.floor(s / 60)).padStart(2, '0')}:${String(s % 60).padStart(2, '0')}`;

function pintar() {
    const p = pistas[i];
    if (!p) return;

    // Actualizar textos en barra inferior y vista NowPlaying
    $$('[data-bind="titulo"]').forEach((el) => (el.textContent = p.titulo));
    $$('[data-bind="artista"]').forEach((el) => (el.textContent = p.artista));
    $$('[data-bind="album"]').forEach((el) => (el.textContent = `${p.artista} · ${p.album}`));
    $$('[data-bind="kbps"]').forEach((el) => (el.textContent = p.kbps || '320 kbps'));
    $$('[data-bind="tiempo"]').forEach((el) => (el.textContent = fmt(t)));
    $$('[data-bind="duracion"]').forEach((el) => (el.textContent = fmt(p.dur)));

    const pct = Math.min(100, Math.round((t / p.dur) * 100));
    $$('[data-bind="relleno"]').forEach((el) => (el.style.width = `${pct}%`));
    $$('[data-bind="barra"]').forEach((el) => el.setAttribute('aria-valuenow', pct));

    // Marcar fila activa en todas las listas
    $$('[data-pista]').forEach((fila) => {
        if (Number(fila.dataset.pista) === i) {
            fila.setAttribute('aria-current', 'true');
        } else {
            fila.removeAttribute('aria-current');
        }
    });

    try {
        localStorage.setItem('sonora_pista_idx', i);
        localStorage.setItem('sonora_pista_t', t);
    } catch (_) {}
}

function reproduciendo() {
    return temporizador !== null;
}

function pintarBoton() {
    const activo = reproduciendo();
    $$('[data-icono="play"]').forEach((el) => el.classList.toggle('hidden', activo));
    $$('[data-icono="pause"]').forEach((el) => el.classList.toggle('hidden', !activo));
    $$('[data-accion="alternar"]').forEach((btn) => {
        btn.setAttribute('aria-label', activo ? 'Pausar' : 'Reproducir');
    });
    $$('[data-bind="texto-play"]').forEach((el) => {
        el.textContent = activo ? 'Pausar' : 'Reproducir';
    });
}

function reproducir() {
    if (!pistas.length) return;
    clearInterval(temporizador);
    temporizador = setInterval(() => {
        t++;
        if (t >= pistas[i].dur) {
            cambiar(aleatorio ? Math.floor(Math.random() * pistas.length) : i + 1);
            return;
        }
        pintar();
    }, 1000);
    pintarBoton();
}

function pausar() {
    clearInterval(temporizador);
    temporizador = null;
    pintarBoton();
}

function cambiar(nueva) {
    if (!pistas.length) return;
    i = (nueva + pistas.length) % pistas.length;
    t = 0;
    pintar();
}

document.addEventListener('click', (e) => {
    const accionEl = e.target.closest('[data-accion]');
    const accion = accionEl?.dataset.accion;

    if (accion === 'alternar') {
        reproduciendo() ? pausar() : reproducir();
    } else if (accion === 'siguiente') {
        cambiar(aleatorio ? Math.floor(Math.random() * pistas.length) : i + 1);
    } else if (accion === 'anterior') {
        cambiar(i - 1);
    } else if (accion === 'aleatorio') {
        aleatorio = !aleatorio;
        accionEl.setAttribute('aria-pressed', aleatorio ? 'true' : 'false');
    } else if (accion === 'guardar') {
        const guardado = accionEl.getAttribute('aria-pressed') === 'true';
        accionEl.setAttribute('aria-pressed', guardado ? 'false' : 'true');
        const msg = $('#estado-biblioteca');
        if (msg) {
            msg.classList.remove('hidden');
            msg.querySelector('span').textContent = guardado
                ? 'Eliminado de tu biblioteca'
                : 'Guardado en tu biblioteca';
        }
    }

    // Selección de fila de canción
    const fila = e.target.closest('[data-pista]');
    if (fila) {
        cambiar(Number(fila.dataset.pista));
        reproducir();
    }

    // Chips de filtro interactivos
    const chip = e.target.closest('[data-chip]');
    if (chip) {
        $$('[data-chip]').forEach((c) => c.setAttribute('aria-pressed', 'false'));
        chip.setAttribute('aria-pressed', 'true');
    }

    // Clic directo sobre la barra de progreso
    const barra = e.target.closest('[data-bind="barra"]');
    if (barra && pistas[i]) {
        const rect = barra.getBoundingClientRect();
        const ratio = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
        t = Math.floor(ratio * pistas[i].dur);
        pintar();
    }
});

// Control por teclado para la barra de progreso (Accesibilidad)
document.addEventListener('keydown', (e) => {
    const barra = e.target.closest('[data-bind="barra"]');
    if (!barra || !pistas[i]) return;

    if (e.key === 'ArrowRight') {
        e.preventDefault();
        t = Math.min(pistas[i].dur, t + 5);
        pintar();
    } else if (e.key === 'ArrowLeft') {
        e.preventDefault();
        t = Math.max(0, t - 5);
        pintar();
    }
});

// Tema claro / oscuro persistente
const raiz = document.documentElement;
try {
    raiz.dataset.theme = localStorage.getItem('tema') ?? 'dark';
} catch (_) {}

$$('[data-accion="tema"]').forEach((btn) => {
    btn.addEventListener('click', () => {
        raiz.dataset.theme = raiz.dataset.theme === 'dark' ? 'light' : 'dark';
        try {
            localStorage.setItem('tema', raiz.dataset.theme);
        } catch (_) {}
    });
});

pintar();
