<template>
    <table class="alt tabla" id="header-fixed">
        <thead>
            <tr>
                <template v-for="(header, key) in headers">
                    <th v-if="header.visible" :key="key">{{header.name}}</th>
                </template>
            </tr>
        </thead>
        <tbody>
            <template v-for="(value, index) in datosTotales">
                <tr v-if="value.TIPO_20 == 'URBANA' || value.TIPO_20 == 'RURAL'" :key="value.cve_u">
                    <td>{{value.estado}}</td>
                    <td v-if="visible.consejo">{{value.consejo_cuenca}}</td>
                    <td v-if="visible.subcuenca">{{value.subcuenca}}</td>
                    <td v-if="visible.region">{{value.reg_economica}}</td>
                    <td v-if="visible.municipio">{{value.municipio}}</td>
                    <td>{{value.localidad}}</td>
                    <td>{{value.TIPO_20}}</td>
                    <td>{{formatNumber(value.DEM_AP_10)}}</td>
                    <td>{{formatNumber(value.DEM_AP_15)}}</td>
                    <td>{{formatNumber(value.DEM_AP_20)}}</td>
                    <td>{{formatNumber(value.DEM_AP_30)}}</td>
                </tr>
                <tr v-if="value.TIPO_30 == 'TOTAL'" :key="value.cve_u+index">
                    <td :colspan="colspan">TOTAL </td>
                    <td>{{formatNumber(value.DEM_AP_10)}}</td>
                    <td>{{formatNumber(value.DEM_AP_15)}}</td>
                    <td>{{formatNumber(value.DEM_AP_20)}}</td>
                    <td>{{formatNumber(value.DEM_AP_30)}}</td>
                </tr>
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
        },
        computed: {
            colspan: function () {
                const obj = Object.values(this.visible)
                const result = obj.filter( (ele) => { 
                        return ele == true
                    })
                return result.length + 3
            },
        }
    }
</script>

<style >
    table th {
        position: -webkit-sticky!important; 
        position: sticky!important;
        top: 0!important;
        z-index: 5!important;
        background: #4c5c96!important;
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