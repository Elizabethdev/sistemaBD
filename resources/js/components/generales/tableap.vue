<template>
    <table class="alt" id="header-fixed">
        <thead>
            <tr>
                <template v-for="(header, key) in headers">
                    <th v-if="header.visible" :key="key">{{header.name}}</th>
                </template>
            </tr>
        </thead>
        <tbody>
            <template v-for="value in datosTotales">
                    <tr v-if="value.TIPO_20 == 'URBANA' || value.TIPO_20 == 'RURAL'" :key="value.cve_u">
                        <td>{{value.estado}}</td>
                        <td v-if="visible.consejo">{{value.consejo_cuenca}}</td>
                        <td v-if="visible.municipio">{{value.municipio}}</td>
                        <td v-if="visible.subcuenca">{{value.subcuenca}}</td>
                        <td v-if="visible.region">{{value.reg_economica}}</td>
                        <td>{{value.localidad}}</td>
                        <td>{{value.TIPO_20}}</td>
                        <td>{{formatNumber(value.DEM_AP_10)}}</td>
                        <td>{{formatNumber(value.DEM_AP_15)}}</td>
                        <td>{{formatNumber(value.DEM_AP_20)}}</td>
                        <td>{{formatNumber(value.DEM_AP_30)}}</td>
                    </tr>
                <!-- <template v-for="(value, index) in data">
                    <tr v-if="value.TIPO_20 == 'TOTAL'" :key="value.cve_u+index">
                        <td colspan="4">TOTAL </td>
                        <td>{{formatNumber(value.totaldemap_10)}}</td>
                        <td>{{formatNumber(value.totaldemap_15)}}</td>
                        <td>{{formatNumber(value.totaldemap_20)}}</td>
                        <td>{{formatNumber(value.totaldemap_30)}}</td>
                    </tr>
                </template> -->
            </template>
        </tbody>												
    </table>
</template>

<script>

import { BFormCheckboxGroup, BDropdown, BFormGroup  } from 'bootstrap-vue'

    export default {
        name:"tbdemandasAP",
        props:{
            dtotales: {
                type: Array,
                default: function () {
                    return []
                }
            },
            newdtotales: {
                type: Array,
                default: function () {
                    return []
                }
            },
            headersTable: {
                type: Array,
                default: function () {
                    return []
                }
            },
            visible: {
                type: Object,
                default: function () {
                    return {}
                }
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