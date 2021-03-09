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
                    <td>{{value.COB_AP_10}}</td>
                    <td>{{value.COB_AP_15}}</td>
                    <td>{{value.COB_AP_20}}</td>
                    <td>{{value.COB_AP_30}}</td>
                    <td>{{value.R_COB_AP_15}}</td>
                    <td>{{value.R_COB_AP_20}}</td>
                    <td>{{value.R_COB_AP_30}}</td>
                    <td>{{value.R_POB_15}}</td>
                    <td>{{value.R_POB_20}}</td>
                    <td>{{value.R_POB_30}}</td>
                    <td>{{value.RANGO_PI}}</td>
                </tr>
                <tr v-if="value.TIPO_20 == 'TOTAL'" :key="value.cve_u+index">
                    <td :colspan="colspan">TOTAL </td>
                    <td>{{value.COB_AP_10}}</td>
                    <td>{{value.COB_AP_15}}</td>
                    <td>{{value.COB_AP_20}}</td>
                    <td>{{value.COB_AP_30}}</td>
                    <td colspan="7"> </td>
                </tr>
            </template>
        </tbody>												
    </table>
</template>

<script>

import { BFormCheckboxGroup, BDropdown, BFormGroup  } from 'bootstrap-vue'

    export default {
        name:"tbcoberturaAP",
        props:{
            dtotales: {
                type: Array,
                default: function () {
                    return []
                }
            },
            newdtotales: {
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
