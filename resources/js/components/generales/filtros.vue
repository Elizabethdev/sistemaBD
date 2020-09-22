<template>
    <div class="row gtr-uniform">

        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="Estados " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="estadoSelected"
                        :options="estados"
                        name="estados"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="Consejo de cuenca " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <!-- <b-form-group> -->
                    <b-form-checkbox-group
                        v-model="consejoSelected"
                        :options="consejos"
                        name="consejosCuenca"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                <!-- </b-form-group> -->
            </b-dropdown>
        </div>
        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="Municipio " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="municipioSelected"
                        :options="municipios"
                        name="municipios"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>

        <div class="field col-3 col-12-xsmall">
            <b-dropdown text="Subcuenca " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="municipioSelected"
                        :options="municipios"
                        name="Subcuenca"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>
        </div>
    <!-- , Región Económica, Localidad Tipo -->
        
    </div>
</template>

<script>
import { BFormCheckboxGroup, BDropdown, BFormGroup  } from 'bootstrap-vue'
// Vue.component('b-form-checkbox-group', BFormCheckboxGroup)

    export default {
        name:"filtros",
        props:{
            titulo: ''
        },
        components: {
            BFormCheckboxGroup,
            BDropdown,
            BFormGroup
        },
        mounted() {
            console.log('Component filtros mounted.')
        },
        data() {
            return {
                estadoSelected: [],
                consejoSelected: [],
                municipioSelected: [],
                estados: [
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                ],
                consejos: [
                    { value: 'a', text: 'Ríos Grijalva y Usumacinta' },
                    { value: 'b', text: 'COSTA DE CHIAPAS' },
                ],
                municipios: [
                    { value: 'a', text: 'La Trinitaria' },
                    { value: 'b', text: 'Tapachula' },
                    { value: 'c', text: 'Chamula' },
                    { value: 'd', text: 'San Cristóbal de Las Casas' },
                    { value: 'd', text: 'San Cristóbal de Las Casas' },
                    { value: 'd', text: 'San Cristóbal de Las Casas' }
                ],
                subcuencas: [
                    { value: 'a', text: 'Lagartero' },
                    { value: 'b', text: 'Puerto Madero' },
                    { value: 'c', text: 'Hondo' },
                ],
                tipos: [
                    { value: 'urbana', text: 'Urbana' },
                    { value: 'rural', text: 'Rural' },
                ],
            }
        }
    }
</script>


<style >
    .drop-overflow{
        max-height: 200px;
        min-height: 100px;
        overflow-x: auto;
    }
</style>