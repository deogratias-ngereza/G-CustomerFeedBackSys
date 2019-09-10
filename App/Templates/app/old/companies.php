<!DOCTYPE html>
<html>
	<title>OS-COMPANIES</title>
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
				    							<button v-on="click: loadCompanies()" class="btn btn-default btn-xs">Refresh</button>
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
												<td>ACTION</td>
												<td>NAME</td>
												<td>APP-ID</td>
												<td>REST-API-ID</td>
												<td>USER-AUTH-KEY</td>
												<td>ACTIVE</td>
												<td>URL</td>
											</tr>
										</thead>
										<tbody>
											<tr v-repeat="acc in companies_list">
												
												<td>{{"{{"}} acc.id {{"}}"}}</td>
												<td>
													
													<table>
														<tr>
															<td>
																<button v-on="click: deleteAcc($index,acc)" class="btn btn-xs btn-danger">
							                        				<span  class="glyphicon glyphicon-trash" style="font-size:10px;"></span>
							                        			</button>
															</td>
															<td>
																&nbsp;
															<button v-on="click: updateAccount($index,acc)" class="btn btn-xs btn-success">save</button>
															</td>
														</tr>
													</table>
												</td>
												</td>
												<td>
													<input v-model='acc.name' type="text" name="">
												</td>
												<td>
													<input v-model='acc.app_id' type="text" name="">
												</td>
												<td>
													<input v-model='acc.rest_api_key' type="text" name="">
												</td>
												<td>
													<input v-model='acc.user_auth_key' type="text" name="" placeholder="">
												</td>
												<td>
													<input v-model='acc.active' type="text" name="">
												</td>
												<td>
													<input v-model='acc.url' type="text" name="">
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
                        			name:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			
                        			<input v-model="newObj.name" class="form-control input-normal" type="text" placeholder="name" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			app_id:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="newObj.app_id" class="form-control input-normal" type="text" placeholder="app_id" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			rest_api_key:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="newObj.rest_api_key" class="form-control input-normal" type="rest_api_key" placeholder="rest_api_key" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			user_auth_key:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="newObj.user_auth_key" class="form-control input-normal" type="text" placeholder="user_auth_key" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			url:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="newObj.url" class="form-control input-normal" type="text" placeholder="url" name="">
                        		</td>
                        	</tr>


                        </table>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button ng-if="1" type="button" class="btn btn-warning g-tpl-warning" v-on="click: addNewAccount()">Add Company</button>
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
				companies_list : {{ COMPANIES_LIST |raw }},
				isLoading : false,
				newObj : {name:"GMTECH","app_id":"","rest_api_key":"","user_auth_key":"",active:1,"url":"https://google.com"}
			},
			methods : {
				openNewAccModal : function(){
					jQuery("#newAccountModal").modal();
				},
				loadCompanies : function(){
					
					this.isLoading = true;
					axios({
						method: 'get',
					    url: window.location.origin + "/api/get_companies",
					    data: {},
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.companies_list = response.data.list;
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				    })
				},
				deleteAcc : function($index,account){
					
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('company_id',account.id);

					axios({
						method: 'post',
					    url: window.location.origin + "/api/delete_company",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.companies_list.splice($index,1); 
				    		this.loadCompanies();//reload from server
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
					//this.companies_list.push(this.newObj);

					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('name', this.newObj.name);
					bodyFormData.set('app_id', this.newObj.app_id);
					bodyFormData.set('rest_api_key', this.newObj.rest_api_key);
					bodyFormData.set('user_auth_key', this.newObj.user_auth_key);
					bodyFormData.set('url', this.newObj.url);
					bodyFormData.set('active', 1);

					axios({
						method: 'post',
					    url: window.location.origin + "/api/add_company",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.companies_list.push(response.data.company);
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
					bodyFormData.set('company_id', account.id);
					bodyFormData.set('updates',JSON.stringify(account)); 

					axios({
						method: 'post',
					    url: window.location.origin + "/api/update_company",
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


