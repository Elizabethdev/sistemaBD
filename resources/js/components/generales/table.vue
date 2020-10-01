<template>
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
            <template v-for="data in datosTotales">
                <template v-for="(value, index) in data">
                    <tr v-if="value.TIPO_20 == 'URBANA' || value.TIPO_20 == 'RURAL'" :key="value.cve_mun+index">
                        <td>{{value.estado}}</td>
                        <td>{{value.consejo_cuenca}}</td>
                        <td>{{value.municipio}}</td>
                        <td>{{value.subcuenca}}</td>
                        <td>{{value.reg_economica}}</td>
                        <td>{{value.localidad}}</td>
                        <td>{{value.TIPO_20}}</td>
                        <td>{{value.totaldemap_10}}</td>
                        <td>{{value.totaldemap_15}}</td>
                        <td>{{value.totaldemap_20}}</td>
                        <td>{{value.totaldemap_30}}</td>
                    </tr>
                </template>
                <template v-for="(value, index) in data">
                    <tr v-if="value.TIPO_20 == 'TOTAL'" :key="value.cve_mun+index">
                        <td colspan="7">TOTAL {{value.municipio}}</td>
                        <td>{{value.totaldemap_10}}</td>
                        <td>{{value.totaldemap_15}}</td>
                        <td>{{value.totaldemap_20}}</td>
                        <td>{{value.totaldemap_30}}</td>
                    </tr>
                </template>
            </template>
        </tbody>												
    </table>
</template>

<script>

import { BFormCheckboxGroup, BDropdown, BFormGroup  } from 'bootstrap-vue'

    export default {
        name:"tbdemandas",
        props:{
            dtotales: {
                type: Object,
                default: {}
            },
            
        },
        components: {
           
        },
        created(){

        },
        mounted() {
            console.log('Component tabla mounted.')
        },
        data() {
            return {
                headers: [],
                datosTotales: this.dtotales
                
            }
        },
}
</script>


<style >
    
</style>