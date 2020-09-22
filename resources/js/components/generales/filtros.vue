<template>
    <div class="row gtr-uniform">

        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="ESTADOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="estadoSelected"
                        :options="estados"
                        name="estados"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>
        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="CONSEJO DE CUENCA " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <!-- <b-form-group> -->
                    <b-form-checkbox-group
                        v-model="consejoSelected"
                        :options="consejos"
                        name="consejosCuenca"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                <!-- </b-form-group> -->
            </b-dropdown>
        </div>
        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="MUNICIPIO " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="municipioSelected"
                        :options="municipios"
                        name="municipios"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>

        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="SUBCUENCA " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="subcuencaSelected"
                        :options="subcuencas"
                        name="subcuenca"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>
        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="REGIÓN ECONÓMICA " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="regionSelected"
                        :options="regiones"
                        name="region"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>
        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="LOCALIDAD " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="localidadSelected"
                        :options="localidades"
                        name="localidad"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>
        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="TIPO " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="tipoSelected"
                        :options="tipos"
                        name="tipo"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>

        <!-- <div class="mt-3">Seleccionado: <strong>{{ estadoSelected }}, {{consejoSelected}}, {{municipioSelected}} </strong></div>
        <div class="mt-3">Seleccionado: <strong>{{ subcuencaSelected }}, {{regionSelected}}, {{localidadSelected}}, {{tipoSelected}} </strong></div> -->
        
    </div>
</template>

<script>

import { BFormCheckboxGroup, BDropdown, BFormGroup  } from 'bootstrap-vue'

    export default {
        name:"filtros",
        props:{
            titulo: ''
        },
        components: {
            BFormCheckboxGroup,
            BDropdown,
            BFormGroup
        },
        mounted() {
            console.log('Component filtros mounted.')
        },
        data() {
            return {
                estadoSelected: [],
                consejoSelected: [],
                municipioSelected: [],
                subcuencaSelected: [],
                regionSelected: [],
                localidadSelected: [],
                tipoSelected: [],
                estados: [
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                ],
                consejos: [
                    { value: 'a', text: 'Ríos Grijalva y Usumacinta' },
                    { value: 'b', text: 'COSTA DE CHIAPAS' },
                ],
                municipios: [
                    { value: 'a', text: 'La Trinitaria' },
                    { value: 'b', text: 'Tapachula' },
                    { value: 'c', text: 'Chamula' },
                    { value: 'd', text: 'San Cristóbal de Las Casas' },
                    { value: 'd', text: 'San Cristóbal de Las Casas' },
                    { value: 'd', text: 'San Cristóbal de Las Casas' },
                    { value: 'b', text: 'Tapachula' },
                    { value: 'c', text: 'Chamula' },
                ],
                subcuencas: [
                    { value: 'a', text: 'Lagartero' },
                    { value: 'b', text: 'Puerto Madero' },
                    { value: 'c', text: 'Hondo' },
                ],
                regiones: [
                    { value: 'a', text: 'Río Grijalva' },
                    { value: 'b', text: 'Lagartero' },
                    { value: 'c', text: 'Costa de Chiapas' },
                ],
                localidades: [
                    { value: 'a', text: 'LAS DELICIAS' },
                    { value: 'b', text: 'JALISCO' },
                    { value: 'c', text: 'JOSÉ MARÍA MORELOS' },
                ],
                tipos: [
                    { value: 'urbana', text: 'Urbana' },
                    { value: 'rural', text: 'Rural' },
                ],
            }
        }
    }
</script>


<style >
    .drop-overflow{
        max-height: 200px;
        min-height: 100px;
        overflow-x: auto;
        background-color: #6c757d !important;
        color: #fff !important;
    }
</style>