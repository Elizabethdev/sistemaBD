<template>
    <table class="alt tabla" id="header-fixed">
        <thead>
            <tr>
                <template v-for="(header, key) in headers">
                    <th v-if="header.visible" :key="key" :class="header.class">{{header.name}}</th>
                </template>
            </tr>
        </thead>
        <tbody>
            <template v-for="(value, index) in datosTotales">
                <tr :key="value.cve_u+index">
                    <td>{{value.estado}}</td>
                    <td v-if="visible.consejo">{{value.consejo_cuenca}}</td>
                    <td v-if="visible.subcuenca">{{value.subcuenca}}</td>
                    <td v-if="visible.region">{{value.reg_economica}}</td>
                    <td v-if="visible.municipio">{{value.municipio}}</td>
                    <td>{{value.localidad}}</td>
                    <td>{{value.ESTATUS}}</td>
                    <td>{{value.CVE_INEGI}}</td>
                    <td>{{value.CAP_INSTALADA}}</td>
                    <td>{{value.CAUDAL_TRATADO}}</td>
                    <td>{{value.POBTOT_20}}</td>
                    <td>{{value.ORG_OPERADOR}}</td>
                    <td>{{value.PROC_TRATAMIENTO}}</td>
                    <td>{{value.DESC_PROC_TRATAMIENTO}}</td>
                    <td>{{value.Observaciones}}</td>
                    <td>{{value.Inversion_Construccion}}</td>
                    <td>{{value.Programa_Construyo}}</td>
                    <td>{{value.Cuerpo_Receptor}}</td>
                    <td>{{value.Diagnostico }}</td>
                </tr>
                <!-- <tr v-if="value.TIPO_20 == 'TOTAL'" :key="value.cve_u+index">
                    <td :colspan="colspan">TOTAL </td>
                    <td>{{value.COB_AP_10}}</td>
                    <td>{{value.COB_AP_15}}</td>
                    <td>{{value.COB_AP_20}}</td>
                    <td>{{value.COB_AP_30}}</td>
                </tr> -->
            </template>
        </tbody>												
    </table>
</template>

<script>

import { BFormCheckboxGroup, BDropdown, BFormGroup  } from 'bootstrap-vue'

    export default {
        name:"tbsaneamiento",
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
    
    .thWidth{
        min-width: 500px;
    }
    
</style>