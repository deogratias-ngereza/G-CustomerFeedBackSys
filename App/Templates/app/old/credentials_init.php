<link rel="stylesheet" href="./dist/css/style.css">
<div style="margin: 40px;padding:30px;border: 0px solid gray;" id="app">

	<center>
		<h3><a href="/">Companies and Accounts</a></h3>

		<div style="">
			<div v-show="isLoading" style="width: 20px;height: 20px;" class="loader"></div>
		</div>	
	</center>
	<div>
		
		<li v-repeat="company in companies">

			<table width="100%" border="1">
				<tr>
					<td>
						<span style="font-weight: bold;">{{"{{"}} company.name{{"}}"}}</span><br>
						<div style="margin-left: 20px;">
								<button style="background-color: blue;color:white;" v-on="click: addAccount(company)">+</button>
								<input v-model="company.new_acc.acc_no" type="text" name="" placeholder="account_no">
								<input v-model="company.new_acc.password" type="password" name="" placeholder="password">
								<input v-model="company.new_acc.role" type="text" name="" placeholder="ADMIN/USER">
							</div>

						<div style="margin-left: 20px;">
							<ul>
								<li v-repeat="account in company.accounts">{{"{{"}} account.acc_no{{"}}"}} - <span style="color:gray;">{{"{{"}} account.role{{"}}"}} - </span>

									<span style="color:orange;">{{"{{"}} account.password{{"}}"}}</span>
								</li>
							</ul>
							<br><br>
						</div>
					</td>
					<td>
						<div>
							<table width="100%">
								<tr style="background-color: gray;color: white;">
									<td>
										<input v-model="company.new_cat.name" type="text" name="">
									</td>
									<td>
										<button style="background-color: blue;color:white;" v-on="click:addCat($index,company.name,company.new_cat.name)">+</button>
									</td>
									<td></td> 
								</tr>
								<tr v-repeat="cat in company.categories">
									<td style="border-left:3px solid orange;padding-left: 20px;">
										<input v-model="cat.name" type="text" name="">
									</td>
									<td>
										<button style="background-color: green;color:white;" v-on="click:updateCat(cat)">u</button>
									</td>
									<td>
										<button style="background-color: red;color:white;" v-on="click:deleteCat($index,cat)">d</button>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>

			
		</li>
	</div>
	
		<br>
</div>

<script type="text/javascript" src="./dist/js/vue.min.js"></script>
<script type="text/javascript" src="./dist/js/axios.min.js"></script>
<script type="text/javascript">

		(function() {
		})();

		var APP = new Vue({
			el : '#app',
			delimiters: ['${', '}'],
			//delimiters: ['[[',']]'
			data : {
				current_user : {{USER|raw}},
				companies : {{COMPANIES_LIST |raw}},
				isLoading : false
			},
			methods : {
				addCat : function($index,code,cat_name){
					if(cat_name == ""){
						alert("CAT NAME IS REQUIRED!!");
						return;
					}
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('customer_code', code);
					bodyFormData.set('cat_name',cat_name); 
					axios({
						method: 'post',
					    url: window.location.origin + "/api/add_category",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.companies[$index].categories.push(response.data.category);
				    	}else{
				    		alert("SOMETHING WENT WRONG!!.");
				    	}
				    })
				    .catch(err => {alert("ERROR");
				    	this.isLoading = false;   
				    })
				},
				updateCat : function(cat){
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('cat_id', cat.id);
					bodyFormData.set('updates',JSON.stringify(cat)); 

					axios({
						method: 'post',
					    url: window.location.origin + "/api/update_category",
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
				},
				deleteCat : function($index,category){
					
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('cat_id',category.id);

					axios({
						method: 'post',
					    url: window.location.origin + "/api/delete_category",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		location.reload();
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				    })
				},
				addAccount : function(account){
					var newAcc = {
						acc_no : account.new_acc.acc_no,
						nickname: 'Anonymus',
						password :account.new_acc.password,
						role : 'ADMIN',
						customer_code : account.name,
						active:1
					};
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('customer_code', newAcc.customer_code);
					bodyFormData.set('acc_no', newAcc.acc_no);
					bodyFormData.set('nickname', newAcc.nickname);
					bodyFormData.set('password', newAcc.password);
					bodyFormData.set('role', newAcc.role);
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
				    		alert("ACCOUNT CREATED\nRefresh page to view the added user");
				    		location.reload();
				    	}
				    })
				    .catch(err => {alert("ERROR");
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				}
			}
		});
		Vue.directive('init', {
		    bind: function(el, binding /*, vnode*/) {
		        console.log(binding.value); //# This line is optional, of course.
		    }
		});
</script>