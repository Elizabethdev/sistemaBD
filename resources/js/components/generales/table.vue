<template>
    <table class="alt" id="header-fixed">
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
                        <td v-if="mostrarCol == 'consejo'">{{value.consejo_cuenca}}</td>
                        <td v-if="mostrarCol == 'municipio'">{{value.municipio}}</td>
                        <td v-if="mostrarCol == 'subcuenca'">{{value.subcuenca}}</td>
                        <td v-if="mostrarCol == 'region'">{{value.reg_economica}}</td>
                        <!-- <td>{{value.localidad}}</td> -->
                        <td>{{value.TIPO_20}}</td>
                        <td>{{formatNumber(value.totaldemap_10)}}</td>
                        <td>{{formatNumber(value.totaldemap_15)}}</td>
                        <td>{{formatNumber(value.totaldemap_20)}}</td>
                        <td>{{formatNumber(value.totaldemap_30)}}</td>
                    </tr>
                </template>
                <template v-for="(value, index) in data">
                    <tr v-if="value.TIPO_20 == 'TOTAL'" :key="value.cve_mun+index">
                        <td colspan="3">TOTAL </td>
                        <td>{{formatNumber(value.totaldemap_10)}}</td>
                        <td>{{formatNumber(value.totaldemap_15)}}</td>
                        <td>{{formatNumber(value.totaldemap_20)}}</td>
                        <td>{{formatNumber(value.totaldemap_30)}}</td>
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
            mostrarCol: {
                type: String,
                default: 'municipio'
            }
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
        },
        methods: {
            formatNumber(number){
                return new Intl.NumberFormat("es-MX").format(number)
            }
        }
    }
</script>

<style >
    table th {
        position: -webkit-sticky!important; 
        position: sticky!important;
        top: 0!important;
        z-index: 5!important;
        background: #2e3141!important;
    }
    table thead tr th{
        border: solid 1px rgba(255, 255, 255, 0.125)!important;
    }
    table th {
        border-left: 1px solid rgba(255, 255, 255, 0.125);
        border-right: 1px solid rgba(255, 255, 255, 0.125);
    }
    table th{ /* Added padding for better layout after collapsing */
        padding: 0.75em 0.75em;
    }
</style>