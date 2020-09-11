<template>
    <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{titulo}}</div>

                        <div class="card-body">
                        HOLA MUNDO
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import MyComponent from 'my-component';

    export default {
        name:"ejemplo",
        props:{
            titulo: ''
        },
        components: {
            // MyComponent,
        },
        mounted() {
            console.log('Component mounted 2.')
        }
    }
</script>
