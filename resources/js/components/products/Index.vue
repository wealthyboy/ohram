<template>
    <div  class="">
        <!--Product Filter-->
        <!--Product Items-->
        <template v-if="loading">
            <!--Content-->
            <section style="height: 100vh;" class="sec-padding">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center raised">
                            <div class="mt-4 mb-4">
                                <span  v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading....
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <div v-if="!loading && items.length" class="row">
            <items :user="user" v-for="product in items" :key="product.id" :product="product"  :category="category"></items>
        </div>
        <template v-if="!loading && !items.length">
            <section style="height: 100vh;" class="sec-padding">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center raised">
                            <div class="mt-4 mb-4">
                                No products found
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <!--End Product Items-->
        <!--Paginattion-->
        <div v-if="meta.total > meta.per_page" class="pagination-wraper">
            <div class="pagination">
                <ul class="pagination-numbers">
                    <pagination   :useUrl="true" :meta="meta" />
                </ul>
            </div>
        </div>
        <!--End Paginattion-->
    </div>
<!--End Product Items-->
<!--Paginattion-->
                   
</template>

<script>

import  SideBar from './SideBar.vue'
import  Items from './Items.vue'
import  Pagination from '../pagination/Pagination.vue'


export default {
    name: "Index",
    props:{
        category: Object,
        endpoint:Object,
        user:Object,
        products: Object
    },
    components:{
        SideBar,
        Items,
        Pagination
    },
    data(){
        return {
           meta:{},
           items: [],
           has_filters: 0,
           full_width: false,
           loading:false,
        }
    },
    computed: {
        classObject: function () {
            return {
               full_width:  this.has_filters > 0
            }
        }
    },
    watch: {
        '$route.query':{
            handler(query){
              this.getProducts(this.$route.query.page,query)
            },
            deep:true
        },
    },
    mounted(){
        this.loading = true;
           this.getProducts().then(() => {
           this.loading =false
        })
    },
    methods: {
        getProducts(page = this.$route.query.page, filters = this.$route.query) {
            let category = this.$route.params.category
            return axios.get(this.endpoint.url,{
                params: {
                    page: page,
                    ...filters
                }
            }).then((response) => {
                this.items = response.data.data
                this.meta  = response.data.meta
                this.has_filters = response.data.has_filters
            })
        }
    }
}

</script>