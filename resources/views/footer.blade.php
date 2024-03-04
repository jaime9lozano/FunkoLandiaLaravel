<footer class="mt-4 text-center">
    <hr>
    <p>CRUD de Funkos - Jaime Lozano Carbonell - 2º DAW IES
        Luis Vives</p>
    @auth
        <p>Recargas de página: {{ session('page_reload_count') }}</p>
    @endauth
</footer>
