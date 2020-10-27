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
    <!-- <header>
        <div class="inner">
            <h2>AGUA POTABLE</h2>
            <p>Se denomina agua potable o agua apta para el consumo de los humanos al agua que puede ser consumida sin restricción para beber o preparar alimentos.</p>
        </div>
    </header> -->

    <!-- Content -->
    <div class="wrapper" id="app">
        <div class="inner">
            
            <!-- <section >
                <h4>Filtrar por:</h4> 
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 2rem; border-radius: 5px;">
                    
                    <rangos-component v-on:rangochange="filterchange2"></rangos-component>
                </div>
            </section> -->
            <section id="header-fixed">		
            <b-overlay :show="show" rounded="sm" spinner-variant="primary">								
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="{{json_encode($newdtotales)}}" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
            </section>
            <!-- <section>										
                <ul class="actions">
                    <btn-component v-on:guardarexcel="guardarexcel"></btn-component>
                    <li>
                    <a href="javascript:void(0);" class="button primary icon solid fa-print" onclick="printDiv('header-fixed')" >Imprimir</a>
                    </li>
                </ul>
            </section> -->
        </div>
    </div>
</section>
    
@endsection