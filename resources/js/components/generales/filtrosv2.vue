<template>
    <div class="row gtr-uniform">
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="ESTADOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-checkbox-group
                    v-model="estadoSelected"
                    :options="estados"
                    name="estados"
                    class="ml-3"
                    stacked
                ></b-form-checkbox-group>
            </b-dropdown>
        </div>
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="CONSEJOS DE CUENCAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedC"
                        name="consejos"
                        @change="toggleAllConsejos"
                        >
                        {{ 'Buscar todos' }}
                    </b-form-checkbox>
                    <b-dropdown-divider></b-dropdown-divider>
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
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="MUNICIPIOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedM"
                        name="municipios"
                        aria-describedby="municipios"
                        aria-controls="municipios"
                        @change="toggleAllMun"
                        >
                        {{ 'Buscar todos' }}
                    </b-form-checkbox>
                    <b-dropdown-divider></b-dropdown-divider>
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
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="SUBCUENCAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedS"
                        name="subcuencas"
                        @change="toggleAllSubcuencas"
                        >
                        {{ 'Buscar todos' }}
                    </b-form-checkbox>
                    <b-dropdown-divider></b-dropdown-divider>
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
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="REGIONES ECONÓMICAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedR"
                        name="regiones"
                        @change="toggleAllRegiones"
                        >
                        {{ 'Buscar todos' }}
                    </b-form-checkbox>
                    <b-dropdown-divider></b-dropdown-divider>
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
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="TIPOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-checkbox-group
                    v-model="tipoSelected"
                    :options="tipos"
                    name="tipo"
                    class="ml-3"
                    stacked
                ></b-form-checkbox-group>
            </b-dropdown>
        </div>
    </div>
</template>

<script>

import { BFormCheckboxGroup, BDropdown, BFormGroup, BFormCheckbox, BDropdownDivider } from 'bootstrap-vue'

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
            BFormGroup,
            BFormCheckbox,
            BDropdownDivider
        },
        mounted() {
            console.log('Component filtros mounted.')
        },
        data() {
            return {
                allSelectedC: false,
                allSelectedM: false,
                allSelectedS: false,
                allSelectedR: false,
                indeterminate: false,
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
                    { value: 'URBANA', text: 'Urbana' },
                    { value: 'RURAL', text: 'Rural' },
                ],
            }
        },
        methods: {
            toggleAllMun(checked) {
                if(checked)
                    this.municipioSelected = []    
                this.allSelectedC = false;
                this.allSelectedS = false;
                this.allSelectedR = false;
            },
            toggleAllConsejos(checked) {
                this.consejoSelected = checked ? this.consejos.map( (ele,x) => { return ele.value}) : []
                // this.allSelectedM = false;
                // this.allSelectedS = false;
                // this.allSelectedR = false;
            },
            toggleAllSubcuencas(checked) {
                if(checked)
                    this.subcuencaSelected = []
                this.allSelectedM = false;
                this.allSelectedC = false;
                this.allSelectedR = false;
            },
            toggleAllRegiones(checked) {
                if(checked)
                    this.regionSelected = []
                this.allSelectedM = false;
                this.allSelectedC = false;
                this.allSelectedS = false;
            }
        },
        watch: {
            consejoSelected: function(newValue) {
                if(newValue != [])
                    this.allSelectedC = false;
                this.$emit('filterchange2', 'consejo', newValue );
            },
            municipioSelected: function(newValue) {
                if(newValue != [])
                    this.allSelectedM = false;
                this.$emit('filterchange', 'municipio', newValue );
            },
            subcuencaSelected: function(newValue) {
                if(newValue != [])
                    this.allSelectedS = false;
                this.$emit('filterchange', 'subcuenca', newValue );
            },
            regionSelected: function(newValue) {
                if(newValue != [])
                    this.allSelectedR = false;
                this.$emit('filterchange', 'region', newValue );
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