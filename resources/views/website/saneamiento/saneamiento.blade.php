@extends('layouts.website.app')
@section('title')
Saneamiento
@stop
@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pagesan.js') }}" defer></script>
@stop

@section('menu')
    @include('layouts.website.menusan')
@stop

@section('content')
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>SANEAMIENTO</h2>
            <h3><p>El saneamiento es imprescindible para prevenir numerosas enfermedades que sufren millones de personas, como las enfermedades diarreicas.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper" id="app">
        <div class="inner">
            <section>
                <h3 class="major">Datos</h3>
            </section>
            <section>
                <h4>Filtrar por:</h4>
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 2rem; border-radius: 5px;">
                    <filtros-component
                        :destados= "{{$estados}}"
                        :dconsejos= "{{$consejos}}"
                        :dmunicipios= "{{$municipios}}"
                        :dsubcuencas= "{{$subcuencas}}"
                        :dregiones= "{{$regionesEco}}"
                        :titulof= "titulo"
                        :tiposf= "tipos"
                        v-on:filterchange2="filterchange2"
                    >  
                    </filtros-component>
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