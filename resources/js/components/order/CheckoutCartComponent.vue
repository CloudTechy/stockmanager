<template>

  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Checkout</h5>
            <button type="button" @click.prevent = "closeComponent" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>


          <div class="card card-primary card-outline">
                <form role="form" ref="form" @keydown="form.onKeydown($event)" @submit.prevent='add' >
                    <div class="card-body">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row"  v-if = "customerStatus == false">
                                    <div class="col-md-12" >
                                        <fieldset class="border border-warning p-2">
                                            <legend  class="w-auto small font-weight-bold border bg-warning">Customer Details</legend>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-6 col-form-label">Customer ID</label>
                                                <div class="col-sm-6">
                                                    <input id= "customer_id" ref="customer_id" name = "customer_id" list = "customers" class="form-control" type="text" v-model = "customer_id" required="" >
                                                    <datalist id="customers">
                                                        <option  v-for = "customer in customers" :value="customer.id"></option>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div v-if= "customer_details" >
                                                <h2 class="small p-2 text-center bg-warning font-weight-bold">Details</h2>
                                                <table class="table table-valign-middle">
                                                  <tbody class="text-center">
                                                        <tr>
                                                            <td class="font-weight-bold">Names</td>
                                                            <td>
<<<<<<< HEAD
                                                               {{ customer_details.name }}
=======
                                                               {{ customer_details[0].name }}
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td class="font-weight-bold">Phone Number</td>
                                                            <td>
<<<<<<< HEAD
                                                               {{ customer_details.number }}
                                                            </td>
                                                        </tr>
                                                        <tr v-if = "customer_details.address">
                                                            <td class="font-weight-bold">Address:  </td>
                                                            <td>
                                                               {{ customer_details.address }}
=======
                                                               {{ customer_details[0].number }}
                                                            </td>
                                                        </tr>
                                                        <tr v-if = "customer_details[0].address">
                                                            <td class="font-weight-bold">Address:  </td>
                                                            <td>
                                                               {{ customer_details[0].address }}
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                                                            </td>
                                                        </tr>
                                                  </tbody>
                                                </table>
                                                <div class="text-center small">
                                                    <button @click.prevent = "nextStep()" type="button" ref = "nextStep" class="btn btn-primary small">Checkout and Pay</button>
                                                </div>
                                                <h2 class="text-center m-1 p-1 text-info small">
                                                    Please note that your order would be placed at this point and your cart emptied
                                                </h2>
                                            </div>
                                            <div v-if = "customer_details == '' && customer_id != ''"> 
                                            	<li class="p-4 m-3 ">
				                                    <h4 class="text-center small text-secondary">Unknown Customer</h4>
												</li>

                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div v-if = "loading == true">
	                                <li class="p-4 m-3 border border-info">
	                                    <h4 class="text-center small text-secondary">payment module loading</h4>
	                                </li>
                                 </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer border  border-top-0 border-primary">
              <button v-if = "loading == false"  type="button"  @click = "closeComponent" ref = "closeButton" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>

</template>
<script>
    export default {
        mounted(){
            this.loadCustomers();
            if(this.$root.checkoutCart){
                this.cart = this.$root.checkoutCart;
                this.$root.checkoutCart = '';
            }
            if(this.$root.OrderCustomerID){
                this.customer_id = this.$root.OrderCustomerID;
            } 
        },
        data(){
          return{
            form : new Form({
        		order_id : '',
        		orderDetails:[],
        		customer_id : '',
            }),
            cart: [],
            builtCart:[],
            orders: '',
            customer_id:'',
            customers: [],
            customerStatus: false,
            customer_details:'',
            orderdetails : [],
            orderData:'',
            orderID:'',
            invoice_id: '',
            transaction_id: '',
            transaction: '',
            loading : false,
          }
        },
        beforeDestroy(){
            this.cart = [];
            this.builtCart = [];
            this.customers ="";
            this.customerStatus = false;
            this.orderData = "";
            this.customer_details = "";
            this.orderID = ""
            this.transaction_id = "";
            this.invoice_id = "";
            this.orders = "";
            this.transaction = "";
            this.form.reset();
            this.loading = false;
<<<<<<< HEAD
            if (this.$refs.closeButton) {
                this.$refs.closeButton.click();
            }
=======
            this.$refs.closeButton.click();

>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        },
        watch: {
            customer_id(){
                this.loadCustomerDetails();
            },
            customers(){
                if (customer_id) {
                    this.loadCustomerDetails();
                }
            }
        },
        methods:{
        	nextStep(){
                this.buildCart(this.cart)
                this.form.customer_id = this.customer_id
        		this.getOrders()
        		this.customerStatus = true
        		this.loading = true
        	},
        	loadCustomers(){
        		this.form.get('./api/customers/')
                .then(response => {
                    this.customers =  response.data.data.item
                })
<<<<<<< HEAD
                .catch(error=> {
                    if (error.response) {
                        this.$Progress.fail()
                        console.log(error.response)
                        this.$root.alert('error','error',error.response.data.data.error)
                    }else{
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(error);
                    }
                }); 
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        	},
            loadCustomerDetails(){
                var data = [];
                if(this.customer_id){
                  data =  this.customers.filter((item)=>{
                    var keys = Object.values(item)
                    var boolean = false
                    if(item == undefined){
                        return false
                    }
                    var bool = keys.forEach((key) => {
                      if(key != null && key == this.customer_id) {
                        boolean = true
                      }
                    }) 
                     return boolean
                })
                }else{
                    data = [];
                }
<<<<<<< HEAD
                this.customer_details = data[0];
=======
                this.customer_details = data;
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            },
        	getOrders(){
        		this.form.post('./api/orders')
                .then(response => {
                    this.orders =  response.data.data
                    this.orderID = this.orders.id
                    this.sendOrder()
                    this.$Progress.start()
                })
<<<<<<< HEAD
                .catch(error=> {
                    if (error.response) {
                        this.$Progress.fail()
                        console.log(error.response)
                        this.$root.alert('error','error',error.response.data.data.error)
                    }else{
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(error);
                    }
                }); 
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        	},
            closeComponent(){
            	this.cart = [];
            	this.builtCart = [];
            	this.customers ="";
            	this.customerStatus = false;
            	this.orderData = "";
            	this.customer_details = "";
            	this.orderID = ""
            	this.transaction_id = "";
            	this.invoice_id = "";
            	this.orders = "";
            	this.loading = false
            	this.form.reset();
            	this.$emit('closeViewCheckoutCart')

            },
            buildCart(cart){

            	cart.forEach((item)=>{
<<<<<<< HEAD
            		if(item){
=======
            		if(item != undefined){
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            			this.builtCart.push(item)
            		}
            	})

            	this.builtCart.forEach((item) => {
<<<<<<< HEAD
            		this.orderdetails.push({[item.id] : parseInt(item.quantity)})
=======
            		this.orderdetails.push({[item.id] : item.quantity})
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            	})
            	
            },
            sendOrder(){
            	this.form.orderDetails = this.orderdetails;
            	this.form.order_id = this.orderID;

            	this.form.post('./api/orderdetails')
                .then(response => {
<<<<<<< HEAD
                    if (response.data.status) {
                        this.orderData =  response.data.data
                        this.$emit('order_created',this.orderData)
                        this.$root.alert('success', 'success','Order has been placed')
                        this.loadPayment();
                    }else{
                        this.$Progress.fail()
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(response.data);
                    }
                })
                .catch(error=> {
                    if (error.response) {
                        this.$Progress.fail()
                        console.log(error.response)
                        this.$root.alert('error','error',error.response.data.data.error)
                    }else{
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(error);
                    }
=======
                    this.orderData =  response.data.data
                    this.$emit('order_created',this.orderData)
                    this.$root.alert('success', 'success','Order has been placed')
                    this.loadPayment();
                })
                .catch(error=> {
                    this.$Progress.fail()
                    console.log(error.response)
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                }); 
            },
            loadPayment(){
            	this.form.get('./api/orders/'+this.orderID)
                .then(response => {
                    this.invoice_id =  response.data.data.invoice_id
                    this.loadTransactionId()
                })
<<<<<<< HEAD
                .catch(error=> {
                    if (error.response) {
                        this.$Progress.fail()
                        console.log(error.response)
                        this.$root.alert('error','error',error.response.data.data.error)
                    }else{
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(error);
                    }
                }); 
=======
                // this.form.get('./api/invoices/'+this.invoice_id)
                // .then(response => {
                //     this.transaction_id =  response.data.data.transaction_id
                //     console.log(response.data.data);
                // })
                // this.form.get('./api/transactions/'+this.transaction_id)
                // .then(response => {
                //    var  transaction =  response.data.data
                //    console.log('transctiont',transaction);
                //     //this.$root.addTransactionComponent(transaction);
                // })
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            },
            loadTransactionId(){
            	this.form.get('./api/invoices/'+this.invoice_id)
                .then(response => {
                    this.transaction_id =  response.data.data.transaction_id
                    this.getTransaction();
            	})
<<<<<<< HEAD
                .catch(error=> {
                    if (error.response) {
                        this.$Progress.fail()
                        console.log(error.response)
                        this.$root.alert('error','error',error.response.data.data.error)
                    }else{
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(error);
                    }
                }); 
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            },

            getTransaction(){
                this.loading = false
            	this.form.get('./api/transactions/'+this.transaction_id)
                .then(response => {
                	this.$Progress.finish()
                    this.transaction = response.data.data;
                    this.closeComponent()
                    this.$root.addTransactionComponent(this.transaction)
            	})
<<<<<<< HEAD
                .catch(error=> {
                    if (error.response) {
                        this.$Progress.fail()
                        console.log(error.response)
                        this.$root.alert('error','error',error.response.data.data.error)
                    }else{
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(error);
                    }
                }); 
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            }
    	} 
  	}
</script>