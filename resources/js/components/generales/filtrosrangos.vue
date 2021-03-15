<template>
<div> 
    <h4>Elegir previamente el año.</h4> 
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <BDropdown text="AÑO DE COBERTURA O POBLACIÓN " class="pb-3 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-checkbox-group
                    v-model="añoSelected"
                    :options="años"
                    name="años"
                    class="ml-3"
                    stacked
                ></b-form-checkbox-group>
            </BDropdown>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <BDropdown text="RANGO DE COBERTURA " class="pb-3 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-checkbox-group
                    v-model="rangoCobSelected"
                    :options="rangosCob"
                    name="tipo"
                    class="ml-3"
                    stacked
                ></b-form-checkbox-group>
            </BDropdown>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <BDropdown text="RANGO DE POBLACIÓN " class="pb-3 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-checkbox-group
                    v-model="rangoPobSelected"
                    :options="rangosPob"
                    name="tipo"
                    class="ml-3"
                    stacked
                ></b-form-checkbox-group>
            </BDropdown>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <BDropdown text="RANGO DE POBLACIÓN INDÍGENA " class="pb-3 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-checkbox-group
                    v-model="rangoPISelected"
                    :options="rangosPI"
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
            añosf: {
                type: Array,
                default: function(){
                    return [
                        { value: '2015', text: '2015' },
                        { value: '2020', text: '2020' },
                        { value: '2030', text: '2030' },
                    ]
                }
            },
            rangocobf: {
                type: Array,
                default: function(){
                    return [
                        { value: '0-20', text: '>= 0 < 20' },
                        { value: '20-40', text: '>= 20 < 40' },
                        { value: '40-60', text: '>= 40 < 60' },
                        { value: '60-80', text: '>= 60 < 80' },
                        { value: '80-100', text: '>= 80 < 100' },
                    ]
                }
            },
            rangopobf: {
                type: Array,
                default: function(){
                    return [
                        { value: '< 100', text: '>= 0 < 100' },
                        { value: '100 - 500', text: '>= 100 < 500' },
                        { value: '500 - 1000', text: '>= 500 < 1,000' },
                        { value: '1000 - 2000', text: '>= 1,000 < 2,000' },
                        { value: '2000 - 2500', text: '>= 2,000 < 2,500' },
                        { value: '2500 - 20000', text: '>= 2,500 < 20,000' },
                        { value: '20000 - 50000', text: '>= 20,000 < 50,000' },
                        { value: '> 50000', text: '>= 50,000' },
                    ]
                }
            },
            rangopif: {
                type: Array,
                default: function(){
                    return [
                        { value: '< 40%', text: '< 40%' },
                        { value: '> o = 40%', text: '>=  40%' },
                    ]
                }
            },
        },
        components: {
            BFormCheckboxGroup,
            BDropdown,
            BFormGroup,
            BFormCheckbox,
            BDropdownDivider
        },
        data() {
            return {
                añoSelected:[],
                rangoCobSelected: [],
                rangoPobSelected: [],
                rangoPISelected: [],
                años: this.añosf,
                rangosCob: this. rangocobf,
                rangosPob: this.rangopobf,
                rangosPI: this.rangopif
            }
        },
        watch: {
            rangoCobSelected: function(newValue){
                this.$emit('rangochange', 'cobertura', newValue);
            },
            rangoPobSelected: function(newValue){
                this.$emit('rangochange', 'poblacion', newValue);
            },
            rangoPISelected: function(newValue){
                this.$emit('rangochange', 'PI', newValue);
            },
            añoSelected: function(newValue){
                this.$emit('rangochange', 'año', newValue);
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
