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
            <b-dropdown text="CONSEJOS DE CUENCAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="consejoSelected"
                        :options="consejos"
                        name="consejosCuenca"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>
        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="MUNICIPIOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
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
            <b-dropdown text="SUBCUENCAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
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
            <b-dropdown text="REGIONES ECONÓMICAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
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
            <b-dropdown text="LOCALIDADES " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <!-- <b-form-group> -->
                    <b-form-checkbox-group
                        v-model="localidadSelected"
                        :options="localidades"
                        name="localidad"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                <!-- </b-form-group> -->
            </b-dropdown>
        </div>
        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="TIPOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <!-- <b-form-group> -->
                    <b-form-checkbox-group
                        v-model="tipoSelected"
                        :options="tipos"
                        name="tipo"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                <!-- </b-form-group> -->
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
            titulo: '',
            destados: {
                type: Array,
                default: []
            },
            dconsejos: {
                type: Array,
                default: []
            },
            dmunicipios: {
                type: Array,
                default: []
            },
            dsubcuencas: {
                type: Array,
                default: []
            },
            dregiones: {
                type: Array,
                default: []
            },
            dlocalidades: {
                type: Array,
                default: []
            },
        },
        components: {
            BFormCheckboxGroup,
            BDropdown,
            BFormGroup
        },
        created(){

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
                estados: this.destados,
                consejos: this.dconsejos,
                municipios: this.dmunicipios,
                subcuencas: this.dsubcuencas,
                regiones: this.dregiones,
                localidades: [],
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