<template>
    <div id="example1_wrapper" class="dataTables_wrapper  container-fluid dt-bootstrap4">
        <div class="row">
            <div class="col-6 col-md-6">
                <div class="dataTables_length" id="example1_length">
                    <label>Entries:
                        <select v-model = "rowsPerPage" @change = "loadSuppliers" aria-controls="dataTables-example" class="form-control input-sm"> 
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
                    <label>Search:<input v-model="search" type="search" class="form-control form-control-sm" placeholder="search supplier" aria-controls="example1">
                    </label>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-sm-12" >
                <div class="table-responsive-sm table-responsive">
                <table  class="table table-small table-hover dataTable" >
                    <thead>
                        <tr role="row" >
                            <th>Names</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Contact Person</th>
                            <th>Owed</th>
                            <th>Created</th>
<<<<<<< HEAD
                            <th class="text-center">Action</th> 
=======
                            <th class="text-center">Action</th>
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b

                        </tr>
                    </thead>
                    <tbody id="body">
                        <tr v-for = "supplier,index in pageLoader(current_page)">
                            <td class="text-capitalize">{{  supplier.name }}</td>
                            <td class="text-capitalize">{{  supplier.phone }}</td>
                            <td class="text-capitalize">{{  supplier.email }}</td>
                            <td class="text-capitalize">{{  supplier.city }}</td>
                            <td class="text-capitalize">{{  supplier.contact_person }}</td>
                            <td class="text-center"><span v-if = "supplier.owed > 0" v-bind:class="{badge:true, 'badge-danger':supplier.owed > 0,  'badge-success' : supplier.owed ==0}"><span class="users-list-date float-right text-white small text-capitalize "> <span class="" style="text-decoration: line-through">N</span>{{ $root.numeral(supplier.owed) }}</span></span><br>
                                <span style="cursor: pointer" v-if = "supplier.owed > 0 && supplier.purchases.length > 0" class="badge float-right badge-secondary small strong">
                                    <div class="small"  @click.prevent = "$root.addTransactionComponent(supplier.purchases,'purchase')" >
                                        <button  title="make transaction" class=" btn-link badge badge-secondary btn-secondary small m-1" data-toggle="" data-target=""  >
                                              {{'pay ' + supplier.purchases.length + ' purchase(s)'}}
                                        </button>
                                    </div>
                                </span>
                            </td>
                            <td class="text-capitalize small">{{  supplier.date }}</td>
                            <td>
                                <div style="width: 200px;">
                                    <button @click="createPurchase(supplier.id,index+start)" type="button" title="make purchase" class="btn btn-outline-success"><i class="fas fa-shopping-cart"></i></button>
                                    <button  @click="loadEditSupplier(supplier,index)" type="button" title="edit this supplier" class="btn btn-outline-primary small m-1"  data-toggle="modal" data-target="#editSupplierModal" ><i class="fas fa-pen"></i></button>
                                    <button @click="loadView(supplier,index+start)" type="button" title="view more" class="  m-1 btn btn-outline-info"><i class="fas fa-street-view"></i></button>
                                    <button @click="deleteSupplier(supplier.id,index+start)" type="button" title="delete this supplier" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                    </tr>
                     <tr v-if = "loading == false && pageLoader(current_page).length == 0">
                        <td colspan="4">
                            <h4 class="text-center">Supplier Not Found</h4>
                        </td>
                    </tr>
                     
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

        <div class="modal fade" id="editSupplierModal"><edit-supplier-component></edit-supplier-component></div>

    </div>
</template>

<script>
    
    export default {
        mounted() {
<<<<<<< HEAD
            if(localStorage.suppliers){
                this.suppliers = JSON.parse(localStorage.suppliers)
            }
        },
         data() { 
=======
            
        },


        data() { 
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            var d = new Date();
            return {
                month : d.getMonth() + 1,
                year : d.getFullYear(),
                suppliers : [],
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
        },
        watch : {
        },
        created(){
            this.$Progress.start()
            this.loadSuppliers();
            Fire.$on('supplier_created', (data)=> {
                this.loadSuppliers();
=======

        },
        watch : {
            
            filteredSuppliers: function(){
                this.loading = false;
            },
           
            
        },
        created(){
            this.$Progress.start()
            Fire.$on('supplier_created', (data)=> {
                this.loadSuppliers();

>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            })
            Fire.$on('supplier_deleted', (data)=> {
                this.loadSuppliers();
            })
            Fire.$on('supplier_edited', (data)=> {
                this.loadSuppliers();
            })
<<<<<<< HEAD
            Fire.$on('transaction_created', (data)=> {
                this.loadSuppliers();
            })
            Fire.$on('product_created', (data)=> {
                this.loadSuppliers();
            })
            Echo.channel('product')
            .listen('UpdateProduct', (e) => {
                this.loadSuppliers();
            });
            Echo.channel('supplier')
            .listen('UpdateSupplier', (e) => {
                this.loadSuppliers();
            });
            Echo.channel('transaction')
            .listen('UpdateTransaction', (e) => {
                this.loadSuppliers();
            });
        },

        computed: {
=======
            this.loadSuppliers();
        },

        computed: {
            filteredSuppliers (){
                var data = [];
              if(this.search){
              data =  this.suppliers.filter((item)=>{
                return item.name.toLowerCase().includes(this.search.toLowerCase());
              })
              }else{
              data = this.suppliers;
              }
              this.length = data.length;
              this.pages =  Math.ceil(data.length / this.rowsPerPage);
              return data;
            },
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
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
            loadSuppliers(){
                this.$Progress.start();
                var form = new Form()
                form.get('./api/suppliers')
                .then( response => {
                    if(response.data.status == true){
                        this.$Progress.finish()
                        Fire.$emit('suppliers_loaded', response.data.data)
                        this.suppliers = response.data.data.item.length !=0 ? response.data.data.item : [];
<<<<<<< HEAD
                        localStorage.suppliers = JSON.stringify(this.suppliers)
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                    }
                    else{
                        this.$Progress.fail()
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
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
<<<<<<< HEAD
                this.loading = false;
                var data = this.$root.myFilter(this.suppliers,this.search)
                this.length = data.length;
                this.pages =  Math.ceil(data.length / this.rowsPerPage);
                return data.slice(this.start,this.end);
=======
               return this.filteredSuppliers.slice(this.start,this.end);
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
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
            loadEditSupplier(supplier,index){
                Fire.$emit('edit_supplier',supplier);
                window.dispatchEvent(new Event('sidebar_min'))
                return true;
            },
            loadView(data,index){
                Fire.$emit('view', data);
                window.dispatchEvent(new Event('sidebar_min'))
                return true;
            },
            createPurchase(id,index){
                this.$root.purchaseSupplierID = id;
                this.$router.push('/products')

            },
            deleteSupplier(id,index){
            this.$swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete account!'
                })
                .then((result) => {
                    if (result.value) {
                        this.$Progress.start();
                        this.form.delete('./api/suppliers/'+id)
                        .then(response => {
                            if(response.data.status == true){
                                Fire.$emit('supplier_deleted', response.data.data)
                                this.$Progress.finish()
                                this.$root.alert('success','success','supplier deleted ')
                            }
                            else{
                                this.$Progress.fail()
                                this.$root.alert('error','error','An unexpected error occured, Try again Later')
                            }
                        })
                        .catch( error => {
                            this.$Progress.fail()
                            var message = error.response.data.error.includes("No connection could be made") ? "No server connection" : error.response.data.message
                            this.$root.alert('error','error',message)
    
                            console.log(error.response.data.error)
                        })
                    }
                }) 
            },
        }
    }

</script>