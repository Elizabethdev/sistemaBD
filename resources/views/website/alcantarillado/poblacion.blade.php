@extends('layouts.website.app')
@section('title')
Alcantarillado
@stop

@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pagealpob.js') }}" defer></script>
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
                <h3 class="major">Población Con Y Sin Servicios Anuales</h3>
            </section>
            <section >
                <h4>Filtrar por:</h4> 
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 1rem; border-radius: 5px;">
                    <filtros-component
                        :destados= "{{$estados}}"
                        :dconsejos= "{{$consejos}}"
                        :dmunicipios= "{{$municipios}}"
                        :dsubcuencas= "{{$subcuencas}}"
                        :dregiones= "{{$regionesEco}}"
                        v-on:filterchange2="filterchange2"
                    >  
                    </filtros-component>
                    <div class="row justify-content-end pr-3">
                        <button v-if="show" class="button primary icon solid fa-search" disabled>
                            Consultar
                        </button>
                        <btn-component v-else v-on:btnclick="consultar" :disabled="show" name="Consultar" classbtn="fa-search"></btn-component>
                    </div>
                </div>
            </section>
            <section id="header-fixed">										
            <b-overlay :show="show" rounded="sm" spinner-variant="primary">								
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="newdtotales" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
            </section>
            <section>										
                <ul class="actions">
                    <li>
                        <b-overlay
                            :show="busy"
                            rounded
                            opacity="0.6"
                            spinner-small
                            spinner-variant="primary"
                            class="d-inline-block"
                        >
                            <btn-component v-on:btnclick="guardarexcel" name="Guardar" classbtn="fa-save"></btn-component>
                        </b-overlay>
                    </li>
                    <li>
                        <btn-component v-on:btnclick="print('header-fixed')" name="Imprimir" classbtn="fa-print"></btn-component>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</section>
    
@endsection