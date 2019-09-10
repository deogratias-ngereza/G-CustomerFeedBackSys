<!DOCTYPE html>
<html>
	<title>OS-USERS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.min.css">
	<script type="text/javascript" src="./dist/js/jquery.min.js"></script>
	<script type="text/javascript" src="./dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./dist/css/style.css">

	<body id="app">
	<div class="container" v-if="current_user.role == 'ADMIN' || current_user.role == 'DEVELOPER'">	
		<div class="row" style="margin-top:30px;">
			<div class="panel panel-default">
				<div class="panel-header" style="padding: 20px;">
					
				    <table width="100%">
				    	<tr>
				    		<td>
				    			<span class="glyphicon glyphicon-user"></span>
							  &nbsp;
						    Account [ {{"{{"}} current_user.acc_no {{"}}"}} - <span style="color: gray;">{{"{{"}} current_user.nickname {{"}}"}}</span> 
						    -
						    <span>{{"{{"}} current_user.role {{"}}"}}</span>
						    ]
					    
				    		</td>
				    		<td align="right">
				    			<div style="">
				    				<table>
				    					<tr>
				    						
				    						<td>
				    							<div v-show="isLoading" style="width: 20px;height: 20px;" class="loader"></div>
				    						</td>
				    						<td>&nbsp;&nbsp;&nbsp;
				    							<button v-on="click: loadUsers()" class="btn btn-default btn-xs">Refresh</button>
				    						</td>
				    						<td>&nbsp;&nbsp;&nbsp;
				    							<button v-on="click: openNewAccModal()" class="btn btn-primary btn-xs">New</button>
				    						</td>
				    					</tr>
				    				</table>
				    				
				    				
				    			</div>
				    		</td>
				    	</tr>
				    </table>
				    <hr>
				</div>


				<div class="panel-body">
				    <div class="xcontainer">
				    	<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-stripped">
										<thead style="background-color: gray;color:white;">
											<tr>
												<td>ID</td>
												<td>ACCOUNT-NO</td>
												<td>NAME</td>
												<td>PASSWORD</td>
												<td>ROLE</td>
												<td>ACTIVE</td>
												<td>ACTION</td>
											</tr>
										</thead>
										<tbody>
											<tr v-repeat="acc in users_list">
												<td>{{"{{"}} acc.id {{"}}"}}</td>
												<td>
													<button class="btn btn-xs btn-danger">
				                        				<span v-on="click: deleteAcc($index,acc)" class="glyphicon glyphicon-trash" style="font-size:10px;"></span>
				                        			</button>

													<input v-model='acc.acc_no' type="text" name="">
												</td>
												<td>
													<input v-model='acc.nickname' type="text" name="">
												</td>
												<td>
													<input v-model='acc.password' type="password" name="">
												</td>
												<td>
													<input v-model='acc.role' type="text" name="" placeholder="ADMIN/USER">
												</td>
												<td>
													<input v-model='acc.active' type="text" name="">
												</td>
												<td>
													<button v-on="click: updateAccount($index,acc)" class="btn btn-xs btn-success">save</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					

				    </div>
					
				</div>

			  <div class="panel-footer">
			  	<button class="btn btn-default btn-xs">
			  		<a href="/logout">Logout
			  		</a>
			  	</button>
			  	&nbsp;&nbsp;
			  	<button class="btn btn-default btn-xs">
			  		<a href="/">Home
			  		</a>
			  	</button>
			  </div>
			</div>
		</div>
	</div>


	 <!-- new account modal -->
    <div class="modal fade" id="newAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

          <div class="modal-body">

                <!-- loading indicator-->
                
                <div v-if="isLoading">
                	<div style="width: 20px;height: 20px;" class="loader"></div>
                </div>

                <div class="row main">
                    <div class="col-md-12" style="padding:30px;">
                        <h4 class="g-tpl-title">Account Details</h4><br>
                        
                        <table>
                        	<tr>
                        		<td>
                        			account-no:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			
                        			<input v-model="newObj.acc_no" class="form-control input-normal" type="text" placeholder="account no" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			nick-name:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="newObj.nickname" class="form-control input-normal" type="text" placeholder="nickname" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			password:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="newObj.password" class="form-control input-normal" type="password" placeholder="password" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			role:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="newObj.role" class="form-control input-normal" type="text" placeholder="ADMIN/USER" name="">
                        		</td>
                        	</tr>


                        </table>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button ng-if="1" type="button" class="btn btn-warning g-tpl-warning" v-on="click: addNewAccount()">Add Account</button>
            <button type="button" class="btn btn-default g-tpl-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /new account modal -->




	</body>




	
	<script type="text/javascript" src="./dist/js/vue.min.js"></script>
	<script type="text/javascript" src="./dist/js/axios.min.js"></script>
	<script type="text/javascript">

		(function() {
		   // your page initialization code here
		   // the DOM will be available here
		   //alert(window.location.href)
		   //alert(JSON.stringify(window.location));
		})();

		
		var APP = new Vue({
			el : '#app',
			delimiters: ['${', '}'],
			data : {
				current_user : {{ USER | raw }},
				users_list : {{ ACCOUNTS_LIST |raw }},
				isLoading : false,
				newObj : {active:1,role:'USER',password:'password',acc_no:'',nickname:'Anonymus'}
			},
			methods : {
				openNewAccModal : function(){
					jQuery("#newAccountModal").modal();
				},
				loadUsers : function(){
					
					this.isLoading = true;
					axios({
						method: 'get',
					    url: window.location.origin + "/api/get_accounts/" + this.current_user.customer_code,
					    data: {},
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.users_list = response.data.list;
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				    })
				},
				deleteAcc : function($index,account){
					
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('account_id',account.id);

					axios({
						method: 'post',
					    url: window.location.origin + "/api/delete_account",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.users_list.splice($index,1); 
				    		this.loadUsers();//reload from server
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				},
				addNewAccount : function(){
					//alert(JSON.stringify(this.newObj));
					//this.users_list.push(this.newObj);
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('customer_code', this.current_user.customer_code);
					bodyFormData.set('acc_no', this.newObj.acc_no);
					bodyFormData.set('nickname', this.newObj.nickname);
					bodyFormData.set('password', this.newObj.password);
					bodyFormData.set('role', this.newObj.role);
					bodyFormData.set('active', 1);

					axios({
						method: 'post',
					    url: window.location.origin + "/api/add_account",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.users_list.push(response.data.account);
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				},
				updateAccount : function($index,account){
					
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('account_id', account.id);
					bodyFormData.set('updates',JSON.stringify(account)); 

					axios({
						method: 'post',
					    url: window.location.origin + "/api/update_account",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				}
			}
			
		});

	</script>





</html>


