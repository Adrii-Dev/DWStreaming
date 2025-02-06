<!-- Formulario para cambiar de idioma entre español e ingles -->
<form action="" method="GET">
    <select name="lang" onchange="location = this.value;">
        <option value="{{ route('lang.switch', 'es') }}" {{ App::getLocale() == 'es' ? 'selected' : '' }}>Español</option>
        <option value="{{ route('lang.switch', 'en') }}" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English</option>
    </select>
</form>
