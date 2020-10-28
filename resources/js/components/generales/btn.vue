<template>
<a href="javascript:void(0);" class="button primary icon solid" :class="classbtn" v-on:click="btnclick">{{name}}</a>
</template>

<script>
    export default {
        name:"btn",
        props:{
            name: {
                type: String,
                default: ''
            },
            classbtn: {
                type: String,
                default: ''
            },
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
            btnclick: function(){
                this.$emit('btnclick');
            },
        }
    }
</script>
