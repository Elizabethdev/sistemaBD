<template>
<div>
    <div class="row">
        <div class="col-4-xlarge col-12-small">
            <BDropdown text="ESTADOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedE"
                        name="estados"
                        :indeterminate="indeterminateE"
                        @change="toggleAllEstados"
                        >
                        {{ 'Buscar todos' }}
                    </b-form-checkbox>
                    <b-dropdown-divider></b-dropdown-divider>
                    <b-form-checkbox-group
                        v-model="estadoSelected"
                        :options="estados"
                        name="estado"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </BDropdown>
        </div>
        <div class="col-4-xlarge col-12-small">
            <BDropdown text="CONSEJOS DE CUENCA " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedC"
                        name="consejos"
                        :indeterminate="indeterminate"
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
            </BDropdown>
        </div>
        <div class="col-4-xlarge col-12-small">
            <BDropdown text="SUBCUENCAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedS"
                        name="subcuencas"
                        :indeterminate="indeterminateS"
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
            </BDropdown>
        </div>
    </div>
    <div class="row">
        <div class="col-4-xlarge col-12-small">
            <BDropdown text="REGIONES ECONÓMICAS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedR"
                        name="regiones"
                        :indeterminate="indeterminateR"
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
            </BDropdown>
        </div>
        <div class="col-4-xlarge col-12-small">
            <BDropdown text="MUNICIPIOS " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox class="ml-3"
                        v-model="allSelectedM"
                        name="municipios"
                        :indeterminate="indeterminateM"
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
            </BDropdown>
        </div>
        <div class="col-4-xlarge col-12-small">
            <BDropdown :text="titulo " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-checkbox-group
                    v-model="tipoSelected"
                    :options="tipos"
                    name="tipo"
                    class="ml-3"
                    stacked
                ></b-form-checkbox-group>
            </BDropdown>
        </div>
    </div>
</div>
</template>

<script>

import { BFormCheckboxGroup, BDropdown, BFormGroup, BFormCheckbox, BDropdownDivider } from 'bootstrap-vue'

    export default {
        name:"filtros",
        props:{
            titulof: {
                type: String,
                default: 'TIPOS'
            },
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
            tiposf: {
                type: Array,
                default: function(){
                    return [
                        { value: 'URBANA', text: 'Urbana' },
                        { value: 'RURAL', text: 'Rural' },
                    ]
                }
            }
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
                allSelectedE: false,
                allSelectedC: false,
                allSelectedM: false,
                allSelectedS: false,
                allSelectedR: false,
                indeterminate: false,
                indeterminateM: false,
                indeterminateS: false,
                indeterminateR: false,
                indeterminateE: false,
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
                tipos: this.tiposf,
                titulo: this.titulof
            }
        },
        methods: {
            toggleAllMun(checked) {
                this.municipioSelected = checked ? this.municipios.map( (ele,x) => { return ele.value}) : []
            },
            toggleAllConsejos(checked) {
                this.consejoSelected = checked ? this.consejos.map( (ele,x) => { return ele.value}) : []
            },
            toggleAllSubcuencas(checked) {
                this.subcuencaSelected = checked ? this.subcuencas.map( (ele,x) => { return ele.value}) : []
            },
            toggleAllRegiones(checked) {
                this.regionSelected = checked ? this.regiones.map( (ele,x) => { return ele.value}) : []
            },
            toggleAllEstados(checked) {
                this.estadoSelected = checked ? this.estados.map( (ele,x) => { return ele.value}) : []
            }
        },
        watch: {
            consejoSelected: function(newValue) {
                if (newValue.length === 0) {
                    this.indeterminate = false
                    this.allSelectedC = false
                } else if (newValue.length === this.consejos.length) {
                    this.indeterminate = false
                    this.allSelectedC = true
                } else {
                    this.indeterminate = true
                    this.allSelectedC = false
                }
                this.$emit('filterchange2', 'consejo', newValue );
            },
            municipioSelected: function(newValue) {
                if (newValue.length === 0) {
                    this.indeterminateM = false
                    this.allSelectedM = false
                } else if (newValue.length === this.municipios.length) {
                    this.indeterminateM = false
                    this.allSelectedM = true
                } else {
                    this.indeterminateM = true
                    this.allSelectedM = false
                }
                this.$emit('filterchange2', 'municipio', newValue );
            },
            subcuencaSelected: function(newValue) {
                if (newValue.length === 0) {
                    this.indeterminateS = false
                    this.allSelectedS = false
                } else if (newValue.length === this.subcuencas.length) {
                    this.indeterminateS = false
                    this.allSelectedS = true
                } else {
                    this.indeterminateS = true
                    this.allSelectedS = false
                }
                this.$emit('filterchange2', 'subcuenca', newValue );
            },
            regionSelected: function(newValue) {
                if (newValue.length === 0) {
                    this.indeterminateR = false
                    this.allSelectedR = false
                } else if (newValue.length === this.regiones.length) {
                    this.indeterminateR = false
                    this.allSelectedR = true
                } else {
                    this.indeterminateR = true
                    this.allSelectedR = false
                }
                this.$emit('filterchange2', 'region', newValue );
            },
            estadoSelected: function(newValue) {
                if (newValue.length === 0) {
                    this.indeterminateE = false
                    this.allSelectedE = false
                } else if (newValue.length === this.estados.length) {
                    this.indeterminateE = false
                    this.allSelectedE = true
                } else {
                    this.indeterminateE = true
                    this.allSelectedE = false
                }
                this.$emit('filterchange2', 'estado', newValue );
            },
            tipoSelected: function(newValue){
                this.$emit('filterchange2', 'tipo', newValue );
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