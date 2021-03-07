@extends('layouts.website.app')
@section('title')
Agua Potable
@stop

@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pageap.js') }}" defer></script>
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
                <h3 class="major">Demanda m3 Anuales</h3>
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
                   <table-component :newdtotales="newdtotales.data" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
            <nav>
                <ul class="pagination">
                    <li class="page-item" v-show="newdtotales.prev_page_url">
                        <a role="menuitem" href="#"  @click.prevent="getFirstPage">
                            <span class="page-link" aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li role="presentation" aria-hidden="true" class="page-item disabled" v-show="newdtotales.prev_page_url">
                        <a role="menuitem" href="#"  @click.prevent="getPreviousPage">
                            <span class="page-link" aria-hidden="true">‹</span>
                        </a>
                    </li>
                    <li role="presentation" class="page-item active" v-show="newdtotales.data">
                        <button role="menuitemradio" type="button" aria-controls="my-table" aria-label="Go to page 1" aria-checked="true" aria-posinset="1" aria-setsize="1" tabindex="0" class="page-link">@{{ currentPage }}</button>
                    </li>
                    <li role="presentation" aria-hidden="true" class="page-item disabled" v-show="newdtotales.next_page_url">
                        <a role="menuitem" href="#"  @click.prevent="getNextPage">
                            <span class="page-link" aria-hidden="true">›</span>
                        </a>
                    </li>
                    <li class="page-item" v-show="newdtotales.next_page_url">
                        <a href="#"  @click.prevent="getLastPage">
                            <span class="page-link" aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>

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