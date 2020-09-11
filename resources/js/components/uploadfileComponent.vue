<template>
    <div class="row">
        Aqui va el dropzone
    </div>
</template>

<script>
// import MyComponent from 'my-component';

    export default {
        name:"upload",
        props:{
            titulo: ''
        },
        components: {
            // MyComponent,
        },
        mounted() {
            console.log('Component upload mounted')
        }
    }
</script>
