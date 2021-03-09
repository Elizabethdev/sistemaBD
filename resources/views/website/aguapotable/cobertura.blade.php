@extends('layouts.website.app')
@section('title')
Agua Potable
@stop

@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pageapcob.js') }}" defer></script>
@stop

@section('menu')
    @include('layouts.website.menuap')
@stop

@section('content')
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>AGUA POTABLE</h2>
            <p>Se denomina agua potable o agua apta para el consumo de los humanos al agua que puede ser consumida sin restricción para beber o preparar alimentos.</p>
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
                    <rangos-component v-on:rangochange="filterchange2"></rangos-component>
                    <div class="row justify-content-end pr-3">
                        <btn-component v-show="!show" v-on:btnclick="consultar"  name="Consultar" classbtn="fa-search"></btn-component>
                        <btn-c name="Consultar" v-show="show"></btn-c>
                    </div>
                </div>
            </section>
            <section id="header-fixed">		
            <b-overlay :show="show" rounded="sm" spinner-variant="primary">								
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="newdtotales.data" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
            <paginate-component :newdtotales="newdtotales" v-on:getpage="getpage"></paginate-component>
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
