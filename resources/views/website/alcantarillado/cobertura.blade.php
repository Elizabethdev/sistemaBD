@extends('layouts.website.app')
@section('title')
Alcantarillado
@stop

@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pagealcob.js') }}" defer></script>
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
                <h3 class="major">Cobertura (%) Anuales</h3>
            </section>
            <section >
                <h4>Filtrar por:</h4> 
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 2rem; border-radius: 5px;">
                    <filtros-component
                        :destados= "{{$estados}}"
                        :dconsejos= "{{$consejos}}"
                        :dmunicipios= "{{$municipios}}"
                        :dsubcuencas= "{{$subcuencas}}"
                        :dregiones= "{{$regionesEco}}"
                        v-on:filterchange2="filterchange2"
                    >  
                    </filtros-component>
                    <rangos-component v-on:rangochange="filterchange2"></rangos-component>
                </div>
            </section>
            <section>										
            <b-overlay :show="show" rounded="sm" spinner-variant="primary">								
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="newdtotales" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
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