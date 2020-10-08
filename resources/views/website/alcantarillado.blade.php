@extends('layouts.website.app')
@section('title')
Alcantarillado
@stop

@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/page.js') }}" defer></script>
@stop

@section('menu')
    @include('layouts.website.menualc')
@stop

@section('content')

<section id="wrapper">
    <header>
        <div class="inner">
            <h2>ALCANTARILLADO</h2>
            <h3><p>Se denomina al sistema de estructuras y tuberías usadas para la evacuación de aguas residuales. Esta agua pueden ser albañales (alcantarillado sanitario).</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper" id="app">
        <div class="inner">
            <section>
                <h3 class="major">Volumen de descarga m3 Anuales</h3>
            </section>
            <section >
                <h4>Filtrar por:</h4> 
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 2rem; border-radius: 5px;">
                    <vista-component v-on:tipovistachange="vistaChange"></vista-component>
                    <filtros-component
                        :destados= "{{$estados}}"
                        :dconsejos= "{{$consejos}}"
                        :dmunicipios= "{{$municipios}}"
                        :dsubcuencas= "{{$subcuencas}}"
                        :dregiones= "{{$regionesEco}}"
                        v-on:filterchange2="filterchange2"
                    >  
                    </filtros-component>
                </div>
            </section>
            <section>										
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="newdtotales" :headers-table="headersTable" :mostrar-col="mostrarCol"></table-component>
                </div>
            </section>
            <section>										
                <ul class="actions">
                    <li><a href="#" class="button primary icon solid fa-save">Guardar</a></li>
                    <li><a href="#" class="button primary icon solid fa-print">Imprimir</a></li>
                </ul>
            </section>
        </div>
    </div>
</section>
    
@endsection