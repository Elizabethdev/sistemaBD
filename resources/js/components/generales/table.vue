<template>
    <table class="alt">
        <thead>
            <tr>
                <th v-for="(header, key) in headers" :key="key">{{header}}</th>
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
                default: function () {
                    return {}
                }
            },
            newdtotales: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            headersTable: {
                type: Array,
                default: function () {
                    return []
                }
            },
        },
        components: {
           
        },
        mounted() {
            console.log('Component tabla mounted.')
        },
        data() {
            return {
                headers: this.headersTable,
                datosTotales: this.dtotales
                
            }
        },
        watch: {
            newdtotales: function(newValue) {
                this.datosTotales = newValue
            }
        }
    }
</script>


<style >
    
</style>