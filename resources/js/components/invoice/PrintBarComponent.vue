<template>
	<div class="row ">
    	<div class="col-12">
	      <a  ref = 'print' @click.prevent = 'print' target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
<<<<<<< HEAD
	      <a  ref = 'Posprint' @click.prevent = 'Posprint' target="_blank" class="btn btn-default"><i class="fa fa-print"></i> POS Print</a>
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
		</div>
  	</div>
</template>
<script>
	export default {
		props : ['invoice'],
		methods:{
			payment(){
				
			},
			pdf(){ 
				
			},
			print(){
				this.$session.start()
                Fire.$emit('printing')
                var a = this.$session.set('session',this.invoice)
                this.data_invoice = this.$session.get('invoice')
                this.$root.invoice = this.invoice;
                this.$router.push('/print_invoice')
                console.log('printing');

<<<<<<< HEAD
			},
			Posprint(){
				var form = new Form();
                this.$Progress.start();
                console.log('printing');
                form.get('./api/print/'+this.invoice.id+'/'+this.user.id)
                .then(response => {
                    if(response.data.status == true){
                        Fire.$emit('invoice_printed')
                        this.$Progress.finish()
                        this.$root.alert('success','success','invoice printed')
                        console.log('printed', response.data.data);
                    }
                    else{
                        this.$Progress.fail()
                        this.$root.alert('error','error','An unexpected error occured, Try again Later')
                        console.log(response.data);
                    }
                })
                .catch( error => {
                	this.$Progress.fail()
                	if(error.response){
	                    this.$root.alert('error','error',error.response.data.message)
	                    var error = error.response.data.error;
	                    console.log(error);
                	}
                	else {
                		 console.log('could not print',error);
                		 this.$root.alert('error','error','could not print')
                	}
	                    
                }); 
                	
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
			}
		},
		
		data() {
			return {
				show : true,
				data_invoice : ''
			};
		},
<<<<<<< HEAD
		computed : {
	      user(){
	        return this.$session.get('user')
	      }
	    },
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
		watch : {
			
		}
	}
</script>