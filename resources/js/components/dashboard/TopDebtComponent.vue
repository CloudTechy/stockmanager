<template>
    <div class="card card-danger card-outline">
      <div class="card-header">
        <h5 class="card-title">Top {{year}} Debts</h5>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 120px;">
            <input  v-model="search" type="text" name="table_search" class="form-control float-md-right" placeholder="Search vendor">
          </div>        
        </div>
      </div>

      <div class="card-body table-responsive p-0">
            <table class="table table-small table-striped  table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                    <th>Vendor</th>
                    <th>Amount <br> 
                        (<span style="text-decoration: line-through">N</span>)
                    </th>
                    <th>Meter</th>
                    <th style="width: 40px">Percent Increase</th>
                  </tr>
            </thead>
           <tbody id='tbody'>
                 <tr v-for = "debt in filteredDebts.slice(0,5)">
                    <td>{{debt.name}}</td>
                    <td>{{numeral(debt.owed)}}</td>
                    <td>
                    <div class="progress progress-xs progress-striped ">
<<<<<<< HEAD
                        <div v-bind:class="{'progress-bar' : true, 'bg-danger': getPercent(debt.owed) >= 70,'bg-warning': getPercent(debt.owed) >= 30, 'bg-success': getPercent(debt.owed) >= 0} " v-bind:style="{width: getPercent(debt.owed) + '%'}"></div>
                      </div>
                    </td>
                    <td class="text-center"><span v-bind:class="{badge:true, 'bg-danger': getPercent(debt.owed) >= 70,'bg-warning': getPercent(debt.owed) >= 30, 'bg-success': getPercent(debt.owed) >= 0}">{{ getPercent(debt.owed) }}%</span>
=======
                        <div v-bind:class="{'progress-bar' : true, 'bg-danger': getPercent(debt.owed) >= 70,'bg-warning': getPercent(debt.owed) >= 30, 'bg-success': getPercent(debt.owed) > 0} " v-bind:style="{width: getPercent(debt.owed) + '%'}"></div>
                      </div>
                    </td>
                    <td class="text-center"><span v-bind:class="{badge:true, 'bg-danger': getPercent(debt.owed) >= 70,'bg-warning': getPercent(debt.owed) >= 30, 'bg-success': getPercent(debt.owed) > 0}">{{ getPercent(debt.owed) }}%</span>
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                    </td>
                </tr>
                <tr v-if = "loading == false && filteredDebts == 0">
                    <td colspan="4">
                        <h4  class="text-center m-1 p-2 border border-success small text-success">CONGRATS!!! You are not owing any vendor</h4>
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
        <div class="card-footer clearfix">
           <router-link to="/suppliers" class="btn btn-sm btn-secondary float-right">More Info</router-link>
        </div>
        <div v-if = "loading" class=" overlay">
            <div style = "position:absolute; top:50%; left:50%; "><i class="fas fa-sync-alt fa-spin"></i></div>
        </div>
    </div>

</template>

<script>
    
    export default {
        mounted() {
<<<<<<< HEAD
            if(localStorage.debtsStat){
                this.debts =  JSON.parse(localStorage.debtsStat)
                this.loading = false;
            }
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            this.loadDebt();
            },
         data() { 
            var d = new Date();
            return {
            month : d.getMonth() + 1,
            year : d.getFullYear(),
            debts : [],
            search : '',
            totalDebts: 0,
            loading : true,
            error : '',
            form: new Form()
            }
        },
        created(){
          Fire.$on('product_created', data => {
            this.loadDebt();
          })
<<<<<<< HEAD
          Echo.channel('purchase')
                .listen('UpdatePurchase', (e) => {
                this.loadDebt();
                }); 
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        },
        computed: {

            filteredDebts (){
                var data = [];
              if(this.search){
              data =  this.debts.filter((item)=>{
                return item.name.toLowerCase().includes(this.search.toLowerCase());
              })
              }else{
                data = this.debts;
              }
              return data;
            },

        },
        
        methods: {
            loadDebt(){
                this.form.get('./api/statistics/suppliers?amount&year='+this.year)
                .then(response =>  {
                    if(response.data.status == true){
                        this.$Progress.finish();
                        this.debts = response.data.data.item.length !=0 ? response.data.data.item : [];
<<<<<<< HEAD
                        localStorage.debtsStat = JSON.stringify(this.debts)
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                        this.totalDebts = response.data.data.item.length !=0 ? this.debts.sum("owed") : 0;
                        this.loading = false;
                    }
                })
                .catch(error =>  {
                    this.error = error.response.data.error;
                }); 
            },
            getPercent(owed){
                var percentDebt = this.totalDebts != 0 ? parseInt(owed / this.totalDebts * 100)  : 0;
               
                return percentDebt;
            },
            numeral(value){
                return numeral(value).format('0,0');
            },
        }
    }
 
</script>