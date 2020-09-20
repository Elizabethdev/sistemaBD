@extends('layouts.website.app')
@section('title')
Inicio
@stop

@section('menu')
    @include('layouts.website.navmenu')
@stop

@section('content')
    <!-- Banner -->
    <section id="banner">
        <div class="inner">
            <div class="logo"><a href="#" class="image"><img src="{{ asset('assets/images/logo.jpg') }}" alt="" /></a></span></div>
            <h2>Nombre del Sistema</h2>
            <p>Alguna descripcion del Sistema</a></p>
        </div>
    </section>
    <!-- Wrapper -->
    <section id="wrapper">
        <!-- One -->
        <section id="one" class="wrapper spotlight style1">
            <div class="inner">
                <a href="#" class="image"><img src="{{ asset('assets/images/agua_potable.jpg') }}" alt="" /></a>
                <div class="content">
                    <h2 class="major">Agua Potable</h2>
                    <p>Se denomina agua potable o agua apta para el consumo de los humanos al agua que puede ser consumida sin restricción para beber o preparar alimentos</p>
                    <a href="#" class="special">Leer más</a>
                </div>
            </div>
        </section>

        <!-- Two -->
        <section id="two" class="wrapper alt spotlight style2">
            <div class="inner">
                <a href="#" class="image"><img src="{{ asset('assets/images/alcantarillado.jpg') }}" alt="" /></a>
                <div class="content">
                    <h2 class="major">Alcantarillado</h2>
                    <p>Se denomina al sistema de estructuras y tuberías usadas para la evacuación de aguas residuales. Esta agua pueden ser albañales (alcantarillado sanitario).
                    </p>
                    <a href="#" class="special">Leer más</a>
                </div>
            </div>
        </section>

        <!-- Three -->
        <section id="three" class="wrapper spotlight style3">
            <div class="inner">
                <a href="#" class="image"><img src="{{ asset('assets/images/saneamiento.jpg') }}" alt="Prueba" /></a>
                <div class="content">
                    <h2 class="major">Saneamiento</h2>
                    <p>El saneamiento es imprescindible para prevenir numerosas enfermedades que sufren millones de personas, como las enfermedades diarreicas.
                    </p>
                    <a href="#" class="special">Leer más</a>
                </div>
            </div>
        </section>

        <!-- Cuatro -->
        <section id="two" class="wrapper alt spotlight style4">
            <div class="inner">
                <a href="#" class="image"><img src="{{ asset('assets/images/calidad_agua.jpg') }}" alt="" /></a>
                <div class="content">
                    <h2 class="major">Calidad del Agua</h2>
                    <p>Es una medida de la condición del agua en relación con los requisitos de una o más especies bióticas o a cualquier necesidad humana o propósito.</p>
                    <a href="#" class="special">Leer más</a>
                </div>
            </div>
        </section>
    </section>
    
@endsection