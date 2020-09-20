@extends('layouts.website.app')
@section('title')
Agua Potable
@stop

@section('menu')
    @include('layouts.website.menuap')
@stop

@section('content')
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>AGUA POTABLE</h2>
            <h3><p>Se denomina agua potable o agua apta para el consumo de los humanos al agua que puede ser consumida sin restricción para beber o preparar alimentos.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper">
        <div class="inner">
            <section>
                <h3 class="major">Demanda m3 Anuales</h3>
                
            </section>
            <section>
                <h4>Filtrar por:</h4>
                <pre><code><h5>
                <p>Estados										Consejo de Cuenca			   						Municipio										Subcuenca</p>
                <p>Región Económica					 		Localidad											    Urbana o Rural</p></h5></code></pre>
            </section>
            <section>										
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Consejo de Cuenca</th>
                                <th>Municipio</th>
                                <th>Subcuenca</th>
                                <th>Región Económica</th>
                                <th>Localidad</th>
                                <th>Tipo de Población 2020</th>
                                <th>Demanda de Agua 2010</th>
                                <th>Demanda de Agua 2015</th>
                                <th>Demanda de Agua 2020</th>
                                <th>Demanda de Agua 2030</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Chiapas</td>
                                <td>Ríos Grijalva y Usumacinta</td>
                                <td>Salto de agua</td>
                                <td>Basca</td>
                                <td>Tulijá Tseltal Chol</td>
                                <td>Ignacio Zaragoza</td>
                                <td>Urbana</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                            </tr>
                            <tr>
                                <td>Chiapas</td>
                                <td>Ríos Grijalva y Usumacinta</td>
                                <td>Salto de agua</td>
                                <td>Basca</td>
                                <td>Tulijá Tseltal Chol</td>
                                <td>Ignacio Zaragoza</td>
                                <td>Rural</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>249,345.60</td>
                                <td>249,345.60</td>
                                <td>249,345.60</td>
                                <td>249,345.60</td>
                            </tr>
                            <tr>
                                <td>Chiapas</td>
                                <td>Ríos Grijalva y Usumacinta</td>
                                <td>Salto de agua</td>
                                <td>Basca</td>
                                <td>Tulijá Tseltal Chol</td>
                                <td>Ignacio Zaragoza</td>
                                <td>Urbana</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                            </tr>
                            <tr>
                                <td>Chiapas</td>
                                <td>Ríos Grijalva y Usumacinta</td>
                                <td>Salto de agua</td>
                                <td>Basca</td>
                                <td>Tulijá Tseltal Chol</td>
                                <td>Ignacio Zaragoza</td>
                                <td>Rural</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                                <td>123,345.60</td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>249,345.60</td>
                                <td>249,345.60</td>
                                <td>249,345.60</td>
                                <td>249,345.60</td>
                            </tr>
                        </tbody>												
                    </table>
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