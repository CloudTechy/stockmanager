<template>
  <div>
    <nav-component></nav-component>
    <sidebar-component></sidebar-component>
    <div class="modal fade" id="addUser"><add-user-component></add-user-component></div>
    <div class="content-wrapper" style="min-height: 606px;">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0 text-dark">Users</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div  class="container-fluid">
            <div class="card card-success card-outline m-auto ">
			<div class="card-header">
			    <h5 class="card-title">Account Summary</h5>
			</div>
	
				<div class="card-body box-profile">
					<div class="row container  mb-2 mt-4">
						<div class="col-lg-3 col-sm-6 mb-3 text-center">
							<div class="circle mb-lg-4"><div class="inner-circle"><p class="circle-text">{{ users.length }}</p></div></div>
							<h4 class="profile-username ">Users</h4>
						</div>
						<div class="col-lg-3 col-sm-6 mb-3 text-center">
							<div class="circle mb-lg-4"><div class="inner-circle"><p class="circle-text">{{ regular.length }}</p></div></div>
							<h4 class="profile-username ">Standard</h4>
						</div>
						<div class="col-lg-3 col-sm-6 mb-3 text-center">
							<div class="circle mb-lg-4"><div class="inner-circle"><p class="circle-text">{{ admins.length }}</p></div></div>
							<h4 class="profile-username ">Admins</h4>
						</div>
						<div class="col-lg-3 col-sm-6 mb-3 text-center">
							<div class="circle mb-lg-4"><div class="inner-circle"><p class="circle-text">{{ super_admins.length }}</p></div></div>
							<h4 class="profile-username ">Super Admins</h4>
						</div>
					</div>

				</div>
			<hr>
			<div  >
				<div class="card-header mb-2">
		          <h5 class="card-title">Manage Users</h5>
		        </div>
	            <show-users-component></show-users-component>
	        </div>
	        <hr>
				<div class="row">
						<div class="card-body box-profile">
							<div class="row container  mb-3 mt-3">
								<div class="col-lg-12 col-sm-12 mb-3 ">
									<div class="card-header">
									    <h5 class="card-title">RECENTLY ADDED</h5>
									</div>
									<h2 class="card-title small"> &nbsp;</h2>
								        
								        <ul class="products-list product-list-in-card pl-2 pr-2">

<<<<<<< HEAD
								          <li v-if = "loading == false" v-for = "user in  $root.myFilter(users,search).slice(0,5)" class="item">
=======
								          <li v-if = "loading == false" v-for = "user in  filteredUsers.slice(0,5)" class="item">
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
								            <div class="product-img">
								              <img v-bind:src=" 'img/user.png'" alt="user Image" class="rounded-circle">
								            </div>
								            <div class="product-info">
								              <span class="users-list-date">
								                {{ user.date }}
								              </span>
								              <h3 href="javascript:void(0)" class="users-list-name">{{user.names }} </h3>
								              <span class="users-list-date">
								                {{ user.number }}
								              </span>
								              <span class="users-list-date">
								                {{ user.email }}
								              </span>
								             
								            </div>
								         </li>
<<<<<<< HEAD
								            <li v-if = "loading == false &&  $root.myFilter(users,search) == 0">
=======
								            <li v-if = "loading == false && filteredUsers.length == 0">
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
								                <h4 class="text-center">Users Not Found</h4>
								            </li>
								        </ul>
											
								</div>
							</div>
						</div>
						<div class="card-body box-profile">
							<div class="row container  mb-5 mt-4">
								<div class="col-lg-12 col-sm-12 mb-3 ">
									<div class="card-header">
									    <h5 class="card-title">ADMINISTRATORS</h5>
									</div>
								    <div class="card-body box-profile">
										
										<ul class="products-list product-list-in-card pl-2 pr-2">

								          <li v-if = "loading == false" v-for = "user in  admins.concat(super_admins)" class="item">
								            <div class="product-img">
								              <img v-bind:src="'img/user.png'" alt="user Image" class="rounded-circle">
								            </div>
								            
								            <div class="product-info">
								              <h3 href="javascript:void(0)" class="users-list-name">{{user.names }} </h3>
								              <span class="users-list-date">
								                {{ user.user_level }}
								              </span>
								              <span class="users-list-date">
								                {{ user.number }}
								              </span>
								              <span class="users-list-date">
								                {{ user.email }}
								              </span>
								             
								            </div>
								          </li>
<<<<<<< HEAD
								            <li v-if = "loading == false && admins.concat(super_admins).length == 0">
=======
								            <li v-if = "loading == false && filteredUsers.length == 0">
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
								                <h4 class="text-center">You have no Admin yet</h4>
								            </li>
								        </ul>
											
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
     	</div>
	</div>
          <div style="position: fixed; bottom: 25px; right: 25px">
            <button type="button" @click = "addComponent" class="btn btn-success  rounded-circle" title="Add new user" id = "add" data-toggle="modal" data-target="#addUser" ><i class="fa fa-plus"></i> </button>


        
    </div>

  </div>
	
</template>

<script>
	
    export default {
        mounted() {
<<<<<<< HEAD
        	if(localStorage.users){
            	this.users = JSON.parse(localStorage.users)
            	this.loading = false
        	}
         },
=======

            },
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
         data() { 
            var d = new Date();
            return {
            month : d.getMonth() + 1,
            year : d.getFullYear(),
            users : [],
            loading : true,
            error : '',
            search : '',
            admins: [],
            super_admins: [],
            regular: [],
            form: new Form(),
            }
        },
        created(){
<<<<<<< HEAD
        	if(!localStorage.users){
                this.loadUsers();
            }
            Fire.$on('user_created', (data)=> {
                this.loadUsers();
=======
            Fire.$on('user_created', (data)=> {
                this.loadUsers();

>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
            })
            Fire.$on('user_deleted', (data)=> {
                this.loadUsers();
            })
            Fire.$on('user_edited', (data)=> {
                this.loadUsers();
            })
<<<<<<< HEAD
            Echo.channel('user')
            .listen('UpdateUser', (e) => {
                this.loadUsers();
            });
=======
            this.loadUsers();
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        },
        watch : {
            users : function () {
            	this.admins = [];
            	this.super_admins = [];
            	this.regular = [];
            	this.users.forEach(this.countAdmin);
            }
        },
<<<<<<< HEAD
=======
         computed: {

            filteredUsers (){
                var data = [];
              if(this.search){
              data =  this.users.filter((item)=>{
                return item.names.toLowerCase().includes(this.search.toLowerCase());
              })
              }else{
                data = this.users;
              }
              return data;
            },

        },
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
        methods: {
            loadUsers(){
                this.form.get('./api/users')
                .then (response =>{
                    this.loading = false;
                    this.users = response.data.data.item;
                })
                .catch (error => {
                    this.error = error.response.data.error;
                }); 
            },
            numeral(value){
                return numeral(value).format('0,0');
            },

            countAdmin(user){

            	if(user.user_level == 'administrator'){
            		this.admins.push(user);
            	}
            	else if(user.user_level == 'normal'){
            		this.regular.push(user);
            	}
            	else if(user.user_level == 'super-administrator'){
            		this.super_admins.push(user);
            	}

            },
            addComponent(event){
            	window.dispatchEvent(new Event('sidebar_min'))
            	return true;
            }
        }

    }

</script>

<style  type="text/css">
	
	.inner-circle{
	    position: relative;
	    top: 4%;
	    left: 0%;
	    width: 120px;
	    height: 120px;
	    border: 3px solid green;
		display: inline-block;
		border-radius: 50%;
	}
	.circle{
		display: inline-block;
		width: 140px;
	    height: 140px;
	    border: 5px dashed gray;
	    position: relative;
	    text-align: center;
	    box-sizing: border-box;
	    border-radius: 50%;
	}
	.circle-text{
		position: relative;
	    top: 43%;
	    margin: 0px;
	}

   
</style>