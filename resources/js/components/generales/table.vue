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
                        <td>{{value.consejo_cuenca}}</td>
                        <td>{{value.municipio}}</td>
                        <td>{{value.subcuenca}}</td>
                        <td>{{value.reg_economica}}</td>
                        <td>{{value.localidad}}</td>
                        <td>{{value.TIPO_20}}</td>
                        <!-- <td>{{value.totaldemap_10}}</td> -->
                        <td>{{formatNumber(value.totaldemap_10)}}</td>
                        <td>{{formatNumber(value.totaldemap_15)}}</td>
                        <td>{{formatNumber(value.totaldemap_20)}}</td>
                        <td>{{formatNumber(value.totaldemap_30)}}</td>
                    </tr>
                </template>
                <template v-for="(value, index) in data">
                    <tr v-if="value.TIPO_20 == 'TOTAL'" :key="value.cve_mun+index">
                        <td colspan="7">TOTAL </td>
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
                // return Number(number).toLocaleString()
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
        border-left: 1px solid rgba(0,0,0,0.2);
        border-right: 1px solid rgba(0,0,0,0.2);
    }
    table th{ /* Added padding for better layout after collapsing */
        padding: 0.75em 0.75em;
    }
</style>