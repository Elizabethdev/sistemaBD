<template>
    <nav>
        <ul class="pagination">
            <li class="page-item" v-show="newdtotales.prev_page_url">
                <a role="menuitem" href="#"  @click.prevent="getPage(1)">
                    <span class="page-link" aria-hidden="true">«</span>
                </a>
            </li>
            <li role="presentation" aria-hidden="true" class="page-item disabled" v-show="newdtotales.prev_page_url">
                <a role="menuitem" href="#"  @click.prevent="getPage(newdtotales.current_page-1)">
                    <span class="page-link" aria-hidden="true">‹</span>
                </a>
            </li>
            <li role="presentation" class="page-item active" v-show="newdtotales.data">
                <button role="menuitemradio" type="button" aria-controls="my-table" aria-label="Go to page 1" aria-checked="true" aria-posinset="1" aria-setsize="1" tabindex="0" class="page-link">{{ newdtotales.current_page }}</button>
            </li>
            <li role="presentation" aria-hidden="true" class="page-item disabled" v-show="newdtotales.next_page_url">
                <a role="menuitem" href="#"  @click.prevent="getPage(newdtotales.current_page+1)">
                    <span class="page-link" aria-hidden="true">›</span>
                </a>
            </li>
            <li class="page-item" v-show="newdtotales.next_page_url">
                <a href="#"  @click.prevent="getPage(newdtotales.last_page)">
                    <span class="page-link" aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>

</template>

<script>

export default {
    name:'paginate',
    props:{
        newdtotales: {
                default: function () {
                    return {}
                }
            },
    },
    data(){
        return {
            // newdtotales: this.newtotales
        }
    },
    methods: {
        getPage(page){
            this.$emit('getpage', page);
        }
        
    },
}
</script>
