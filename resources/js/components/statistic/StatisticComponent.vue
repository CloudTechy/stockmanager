<template>
  <div>
    <nav-component></nav-component>
    <sidebar-component></sidebar-component>
    <div class="content-wrapper" style="min-height: 606px;">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0 text-dark">STATISTICS REPORT</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div  class="container-fluid">
          <div class="card card-success card-outline m-auto ">
            <div class="card-header">
                <h3 class="card-title text-center">Year Revenue Tracking </h3>
            </div>

              <div class="card-body">
                <div class="text-center text-secondary p-2" v-if = "statistics.length == 0">
                     No Activity 
                </div>
                  <line-chart  v-else
                    id="line" ref = "line" xkey="month" resize="true" 
                    :labels="labels"
                    :data="lineData"
                    :ykeys="series"
                    :xLabelFormat = "xLabelFormat"
                    _line-colors="lineColors"
                    :line-colors="lineColor"
                    :hover-callback="onLineHover"
                    :dateFormat = "dateFormat"
                    grid="true" grid-text-weight="bold">
                  </line-chart>
            </div>
            <div class="card-footer bg-warning">
              <div class="row">
                <div class="col-sm-4 col-4">
                  <div class="description-block border-right">
                    <h5 class="description-header">
                      <span style="text-decoration: line-through">N</span>
                      {{numeral(revenueStat.amount) }}
                    </h5>
                    <span class="description-text">REVENUE</span>
                  </div>
                </div>

                <div class="col-sm-4 col-4">
                  <div class="description-block border-right">
                    <h5 class="description-header">
                      <span style="text-decoration: line-through">N</span>
                      {{numeral(revenueStat.cost) }}
                    </h5>
                    <span class="description-text">COST</span>
                  </div>
                </div>

                <div class="col-sm-4 col-4">
                  <div class="description-block">
                    <h5 class="description-header">
                      <span style="text-decoration: line-through">N</span>
                      {{numeral(revenueStat.profit) }}
                    </h5>
                    <span class="description-text">PROFIT</span>
                  </div>
                </div>
              </div>
            </div>
    
          </div>
        </div>
      </div>
   </div> 
  </div>
  
</template>



<script>
    

    // import Vue from 'vue'
    import { LineChart } from 'vue-morris'

    const COLORS = [ '#42B8E0', '#33658A', '#F6AE2D', '#F26419', '#0E3A53' ]
    export default {
        mounted() {
          this.loadStat();
          this.$Progress.start();
        },
        components: {
            LineChart
        },
         data() { 
            var d = new Date();
            return {
            month : d.getMonth() + 1,
            year : d.getFullYear(),
            day: d.getDate(),
            statistics : [],
            loading : true,
            error : '',
            revenueStat: "",

            months : ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            lineData: [],
            series: [],
            labels: [],
            lineColors: [],
            form: new Form(),
            
            }
        },
        created(){
          Fire.$on('order_created', data => {
            this.loadStat();
          })
          Fire.$on('product_created', data => {
            this.loadStat();
          })
        },
        methods: {
            loadStat(){
                this.form.get('./api/statistics/transactions?date=month&transactionType=order&year='+this.year)
                .then( response => {
                    if(response.data.status == true){
                        this.statistics = response.data.data.item.length !=0 ? response.data.data.item : [];
                        this.renderChart();
                    } 
                    this.loadRevenueStat(); 
                })
                .catch( error => {
                    console.log(error);
                    this.error = error.response.data.error;
                }); 
            },
            loadRevenueStat(){
                this.form.get('./api/statistics/transactions?order_revenue&year='+this.year)
                .then( response => {
                    if(response.data.status == true){
                        this.revenueStat = response.data.data.item.length !=0 ? response.data.data.item[0] : "";
                    } 
                })
                .catch( error => {
                    console.log(error);
                    this.error = error.response.data.error;
                }); 
            },
             rand (limit) {
              return Math.ceil(Math.random() * limit)
            },

            onLineHover (index, options, content, row) {
              //console.log('onLineHover: ', index, options, content, row)
              return content
            },

            osColor (row, series, type) {
              //console.log(row.y, series.key)

              if (series.key === 'and') {
                if (row.y >= 30) return '#FF6384'
                if (row.y >= 15) return '#CC6384'
                return '#996384'
              }

              if (series.key === 'ios') {
                return '#36A2EB'
              }

              return '#FFCE56'
            },

            percentFormat (val) {
              return val + '%'
            },

            lineColor (row, series, type) {
              //console.log(row, series, type)

              if (type === 'point') {
                if (row.y[series] < 10) {
                  return '#F00'
                }
              }

              return this.lineColors[series]
            },
            xLabelFormat(x){
                var month = this.months[x.getMonth()];
                return month;
            },
            dateFormat(x) {
                var month = this.months[new Date(x).getMonth()];
                return month;
            },
            renderChart(){
                this.series = []
                this.labels = []

                this.series = ["transaction","income"]
                this.labels = ["Transaction", "Income"]
                this.lineColors = ['#42B8E0', '#33658A']
              
                for (var i = 0; i < this.statistics.length; i++) {
                    this.lineData.push({ month:this.year+"-"+ this.statistics[i].month, transaction:''+ this.statistics[i].transactions, income: '' + this.statistics[i].amount })
                }
            },
            numeral(value){
                return numeral(value).format('0,0');
            },
            
        }
    }

</script>