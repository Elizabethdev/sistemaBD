<template>
    <div class="row gtr-uniform">
        <b-form-radio-group v-model="tipoSelected" :options="options" :state="state" name="radio-validation">
            <b-form-invalid-feedback :state="state">Por favor, selecciona una opción</b-form-invalid-feedback>
            <b-form-valid-feedback :state="state">Ahora puedes filtrar los datos por:</b-form-valid-feedback>
        </b-form-radio-group>
    </div>
</template>

<script>

import { BFormRadioGroup, BFormInvalidFeedback, BFormValidFeedback } from 'bootstrap-vue'

    export default {
        name:"tipoVista",
        props:{
            titulo: '',
           
        },
        components: {
            BFormRadioGroup,
            BFormInvalidFeedback,
            BFormValidFeedback
        },
        mounted() {
            console.log('Component tipoVista mounted.')
        },
        data() {
            return {
                tipoSelected: null,
                value: null,
                options: [
                    { text: 'Municipios', value: 'municipio' },
                    { text: 'Consejos de cuencas', value: 'consejo' },
                    { text: 'Subcuencas', value: 'subcuenca' },
                    { text: 'Regiones Ecónomicas', value: 'region' }
                ]
            }
        },
        computed: {
            state() {
                return Boolean(this.tipoSelected)
            }
        },
        watch: {
            tipoSelected: function(newValue) {
                
                this.$emit('tipovistachange', newValue );
            }
        }
    }
</script>

<style >
  
</style>