<template>
    <div id="example1_wrapper" class="dataTables_wrapper  container-fluid dt-bootstrap4">
        <div class="row">
            <div class="col-6 col-md-6">
                <div class="dataTables_length" id="example1_length">
                    <label>Entries:
                        <select v-model = "rowsPerPage" @change = "loadProducts" aria-controls="dataTables-example" class="form-control input-sm"> 
                            <option value="5">5</option>
                            <option value="10">10</option> 
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> 
                    </label>
                </div>
            </div>
            <div class="col-6 col-md-6">
                <div id="example1_filter" class="dataTables_filter float-right">
                    <label>Search:<input v-model="search" type="search" class="form-control form-control-sm" placeholder="search product" aria-controls="example1">
                    </label>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-sm-12" >
                <div class="table-responsive-sm table-responsive">
                <table  class="table table-small table-hover dataTable" >
                    <thead>
                        <tr role="row " >
                            <th>Name</th>
                            <th>category</th>
                            <th>Brand</th>
                            <th>Size</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Added by</th>
<<<<<<< HEAD
                            <th>Updated</th>
=======
                            <th>Created</th>
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                            <th>Status</th>
                            <th class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody id="body">
                        <tr v-for = "product,index in pageLoader(current_page)">
                            <td class="text-capitalize">{{  product.name }}</td>
                            <td class="text-capitalize">{{  product.category }}</td>
                            <td class="text-capitalize">{{  product.brand }}</td>
                            <td class="text-capitalize">{{  product.size }}</td>
                            <td class="text-capitalize">
                                <span class="" style="text-decoration: line-through">N</span>
                                {{  $root.numeral(product.purchase_price) }}
                            </td>
                            <td class="text-capitalize">
                                <span class="" style="text-decoration: line-through">N</span>
                                {{  $root.numeral(product.price) }}
                            </td>
                            <td class="text-capitalize">
<<<<<<< HEAD
                                <span v-bind:class="{badge:true, 'badge-warning':product.stock < 50, 'badge-danger':product.stock <= 10,  'badge-success' : product.stock >= 50 }">{{  product.stock }}
=======
                                <span v-bind:class="{badge:true, 'badge-warning':product.stock < 50, 'badge-danger':product.stock <= 10,  'badge-success' : product.stock > 50 }">{{  product.stock }}
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                                </span>
                            </td>
                            <td class="text-capitalize">{{  product.added_by }}</td>
                            <td class="text-capitalize">{{  product.date }}</td>
                            <td class="text-center">
                                <span v-bind:class="{badge:true, 'badge-danger':product.discontinued == 1,  'badge-success' : product.discontinued == 0 }">
                                    {{ product.discontinued==0 ? 'Active' : 'Not-Active' }}
                                </span>
                            </td>
                            <td>
                                <div style="width: 200px;">
                                    <button @click="loadView(product,index+start)" type="button" title="view more" class="  m-1 btn btn-outline-info"><i class="fas fa-street-view"></i></button>
                                    <button  @click="loadEdit(product,index)" type="button" title="edit this product price" class="btn btn-outline-primary small m-1"  data-toggle="modal" data-target="#editProductModal" ><i class="fas fa-pen"></i></button>
                                    <button @click="deleteData(product.id,index+start)" type="button" title="delete this product" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                         <tr v-if = "loading == false && pageLoader(current_page).length == 0">
                            <td colspan="11">
                                <li class="p-4 m-3 border border-info" v-if="loading == false && $root.myFilter(products,search).length == 0">
                                    <h4 class="text-center small text-secondary">products Not Found</h4>
                                </li>
                            </td>
                        </tr>
<<<<<<< HEAD
                        <tr v-if = "pageLoader(current_page).length > 0">
                            <td colspan="6">
                               <span class="small font-weight-bold text-success"> {{ "Total stock for " + pageLoader(current_page).length + " product(s)" }}</span>
                            </td>
                            <td colspan="5">
                                 <span class="font-weight-bold badge badge-success">
                                    {{ pageLoader(current_page).sum('stock') }}
                                </span>
                            </td>
                        </tr>
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-md-6">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showed {{ start + 1 }} to {{ end > length ? length : end }} of {{ length }} entries
                </div>
            </div>
            <div class="col-6 col-md-6">
                <div class="dataTables_paginate paging_simple_numbers float-right" id="example1_paginate">
                    <ul class="pagination">
                        <li class="paginate_button page-item previous" ref = "prev" id="example1_previous">
                            <a href="#" @click.prevent ="pageLoaderB(-1)" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous
                            </a>
                        </li>
                        <li class="paginate_button bg-primary p-2 text-center page-item" style="display: inline; min-width: 70px"  v-if = "Math.floor(pages) > 6">
                            {{current_page + ' of ' + Math.floor(pages)}}
                        </li>
                        <li v-else v-for = "value in Math.floor(pages)" v-bind:class="classObject(value)" class="paginate_button page-item" >
                            <a  aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link" @click.prevent ="pageLoader(value)" href="#">{{ value }}</a>
                        </li>
                       
                        <li class="paginate_button page-item next" ref = "next" id="example1_next">
                            <a @click.prevent ="pageLoaderB(1)" href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editProductModal"><edit-product-component></edit-product-component></div>

    </div>
</template>

<script>
    
    export default {
        mounted() {
<<<<<<< HEAD
            window.dispatchEvent(new Event('sidebar_min'))
            if(localStorage.products){
                this.products = JSON.parse(localStorage.products)
            }
        },
=======
            Fire.$emit('sidebar_min')
        },


>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        data() { 
            var d = new Date();
            return {
                month : d.getMonth() + 1,
                year : d.getFullYear(),
                products : [],
                loading : true,
                error : '',
                search : '',
                rowsPerPage: 5,
                current_page: 1,
                length: 0,
                pages : 0,
                form: new Form()
            }
<<<<<<< HEAD
=======

        },
        watch : {
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        },
        created(){
            this.$Progress.start()
            Fire.$on('product_created', (data)=> {
                this.loadProducts();
            })
            Fire.$on('product_deleted', (data)=> {
                this.loadProducts();
            })
            Fire.$on('product_edited', (data)=> {
                this.loadProducts();
            })
            this.loadProducts();
<<<<<<< HEAD
            Echo.channel('product')
            .listen('UpdateProduct', (e) => {
                this.loadProducts();
            });
            Echo.channel('purchase')
            .listen('UpdatePurchase', (e) => {
                this.loadProducts();
            });
            Echo.channel('order')
            .listen('UpdateOrder', (e) => {
                this.loadProducts();
            });
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        },

        computed: {
            start(){
                if (this.pages > 0  && this.current_page  >=  this.pages ) {
                    this.current_page = this.pages
                }
                return parseInt(this.rowsPerPage * (this.current_page -1));
            },
            end(){
                return parseInt(this.rowsPerPage * (this.current_page - 1)) + parseInt(this.rowsPerPage);  
            }         
        },
        methods: {
            loadProducts(){
                this.$Progress.start();
                this.form.get('./api/attributeproducts')
                .then( response => {
                    if(response.data.status == true){
                        this.$Progress.finish()
                        Fire.$emit('products_loaded', response.data.data)
                        window.dispatchEvent(new Event('sidebar_min'))
                        this.products = response.data.data.item.length !=0 ? response.data.data.item : [];
<<<<<<< HEAD
                        localStorage.products = JSON.stringify(this.products)
                    }
                    else{
                        this.$Progress.fail()
                        this.$root.alert('error','error','An unexpected error occured, Try again Later') 
=======
                    }
                    else{
                        this.$Progress.fail()
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                        console.log(response.data);
                    }
                })
                .catch(error=> {
                    this.$Progress.fail()
                    var message = error.response.data.error.includes("No connection could be made") ? "No server connection" : error.response.data.message
                    this.$root.alert('error','error',message)
                    console.log(error.response.data.error)
                }); 
            },
            classObject (value) {
                if(value <= 1 && this.current_page == 1){
                    this.$refs.prev.classList.add('disabled')
                }
                else if(value <= 1 && this.current_page > 1){
                    this.$refs.prev.classList.remove('disabled')
                }
                if(this.current_page == this.pages){
                    this.$refs.next.classList.add('disabled')
                }
                else{
                  this.$refs.next.classList.remove('disabled')   
                }
                if (value == this.current_page) {
                    return "active";
                }
            },
            pageLoader(pageNumber){
                if(this.pages > 6){
                    this.$refs.prev.classList.remove('disabled')
                    this.$refs.next.classList.remove('disabled')
                }
                this.current_page = pageNumber;
                this.loading = false;
                var data = this.$root.myFilter(this.products,this.search)
                this.length = data.length;
                this.pages =  Math.ceil(data.length / this.rowsPerPage);
                return data.slice(this.start,this.end);
            },
            pageLoaderB(amount){
                if(this.current_page <= 1 && amount == -1){
                   this.current_page = 1; 
                }
                else if(this.current_page >= this.page){
                    this.current_page = this.page;
                }
                else{
                   this.current_page += amount;
                }
            },
            loadEdit(product,index){
                Fire.$emit('edit_product',product);
                window.dispatchEvent(new Event('sidebar_min'))
                return true;
            },
            loadView(data,index){
                Fire.$emit('view', data);
                return true;
            },
            deleteData(id,index){
            this.$swal({
                    title: 'Are you sure?',
                    text: "Note! You cannot delete a valid product",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete product!'
                })
                .then((result) => {
                    if (result.value) {
                        this.$Progress.start();
                        this.form.delete('./api/attributeproducts/'+id)
                        .then(response => {
                            if(response.data.status == true){
                                Fire.$emit('product_deleted', response.data.data)
                                this.$Progress.finish()
                                this.$root.alert('success','success','product deleted ')
                            }
                            else{
                                this.$Progress.fail()
                                this.$root.alert('error','error','An unexpected error occured, Try again Later')
                            }
                        })
                        .catch( error => {
                            this.$Progress.fail()
                            var message = error.response.data.message
                            if(error.response.data.error.includes("No connection could be made")){
                                message = "No server connection"
                             }
                             else if(error.response.data.error.includes("Integrity constraint")){
                                message = "product is valid"
                             }

                            this.$root.alert('error','error',message)
    
                            console.log(error.response.data.error)
                        })
                    }
                }) 
            },
        }
    }

</script>