<template>
<li><a href="javascript:void(0);" class="button primary icon solid fa-save" v-on:click="guardar">Guardar</a></li>
</template>

<script>
    export default {
        name:"btn",
        props:{
            filtros: {
                type: Object,
                default: function(){
                    return {}
                }
            },
        },
        data() {
            return {
                filtrosApply: this.filtros,
            }
        },
        methods: {
            guardar: function(){
                this.$emit('guardarexcel');
            },
        }
    }
</script>
