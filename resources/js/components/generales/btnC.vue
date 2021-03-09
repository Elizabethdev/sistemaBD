<template>
<button  class="button primary icon solid fa-search" disabled>
    {{name}}
</button>
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
            
        },
        data() {
            return {
            }
        },
        methods: {
            
        }
    }
</script>
