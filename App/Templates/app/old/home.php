<!DOCTYPE html>
<html>
	<title>OS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.min.css">
	<script type="text/javascript" src="./dist/js/jquery.min.js"></script>
	<script type="text/javascript" src="./dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./dist/css/style.css">

	<body id="app">
	<div class="container" >	
		<div class="row" style="margin-top:30px;">
			<div class="panel panel-default">
				<div class="panel-header" style="padding: 20px;">
					
				    <table width="100%">
				    	<tr>
				    		<td>
				    			<span class="glyphicon glyphicon-user"></span>
							  &nbsp;
						    Account [ {{"{{"}} current_user.acc_no {{"}}"}} - <span style="color: gray;">{{"{{"}} current_user.nickname {{"}}"}}</span> ]
					    
				    		</td>
				    		<td align="right">
				    			<div style="">
				    				<div v-show="isLoading" style="width: 20px;height: 20px;" class="loader"></div>
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
								<center>
									<span class="glyphicon glyphicon-qrcode"></span>
								&nbsp;&nbsp;
									<input type="text" id="myPlayerID" v-model="myPlayerID" size="35" disabled />
								</center>
							</div>
						</div><br><br>

						<div class="row" style="font-size: 0.6em;">
							<div class="col-md-4">
								
								<table class='table table-responsive'>
									<tr style="background-color: gray;color:white;">
										<td>PlayerID</td>
										<td>Type</td>
										<td>DEtails</td>
										<td>Subscribe</td>
										<td>Action</td>
									</tr>
									<tr v-repeat="acc in players">
										<td v-if='acc.player_id != myPlayerID'>{{"{{"}} acc.player_id {{"}}"}}</td>

										<td v-if='acc.player_id == myPlayerID' style="background-color: orange;color:white;">{{"{{"}} acc.player_id {{"}}"}}</td>


										<td>{{"{{"}} acc.device_type {{"}}"}}</td>
										<td>{{"{{"}} acc.device_description {{"}}"}}</td>
										<td>
											<span v-if="acc.subscribe" style="color:green;" class="glyphicon glyphicon-bell"></span>
										</td>
										<td>
											

											<button v-if="!acc.subscribe" v-on="click: subscribePlayer(acc,$index)" class="btn btn-xs btn-success">+</button>
											<button v-if="acc.subscribe" v-on="click: unSubscribePlayer(acc,$index)" class="btn btn-xs btn-default">-</button>
										</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								
								<table width="100%" class="table table-responsive">
									<tr style="background-color: gray;color:white;">
										<td>My-Categories</td>
										<td>All Available Categories</td>
									</tr>
									<tr>
										<td style="color:white;font-weight: bold;">
											
											<ul v-repeat="cat in my_categories">
												<li style="background-color: orange;">
													<button v-on="click: removeCategory(cat,$index)" class="btn btn-xs btn-danger">-</button>&nbsp;
												{{"{{"}} cat.category.name {{"}}"}}</li>
											</ul>

										</td>
										<td>
											
											<ul v-repeat="cat in categories">
												<li>
													<button v-on="click: addCategory(cat)" class="btn btn-xs btn-success">+</button>&nbsp;
												{{"{{"}} cat.name {{"}}"}}</li>
											</ul>

										</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								

								<table class='table table-responsive'>
									<tr style="background-color: gray;color:white;">
										<td>Account</td>
										<td>Nick - Name</td>
										<td>Status</td>
										<td>Action</td>
									</tr>
									<tr v-repeat="acc in friends_accounts">
										<td><span class="badge glyphicon glyphicon-hdd" style="color:white;font-size: 0.9em;">&nbsp;{{"{{"}} acc.acc_no {{"}}"}}</span></td>
										<td>{{"{{"}} acc.nickname {{"}}"}}</td>
										<td>{{"{{"}} acc.active {{"}}"}}</td>
										<td>
											<button v-on="click: openSendSmsToAccountModal(acc)" class="btn btn-xs btn-default">
												<span class="glyphicon glyphicon-bell" style="color:orange;"></span>
											sms</button>
										</td>
									</tr>
								</table>
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
			  	<button v-if="current_user.role == 'ADMIN' || current_user.role == 'DEVELOPER'" class="btn btn-default btn-xs">
			  		<a href="/users">Users
			  		</a>
			  	</button>
			  	&nbsp;&nbsp;
			  	<button v-if="current_user.role == 'DEVELOPER'" class="btn btn-default btn-xs">
			  		<a href="/companies">Companies
			  		</a>
			  	</button>
			  	&nbsp;&nbsp;
			  	<button v-if="current_user.role == 'DEVELOPER'" class="btn btn-default btn-xs">
			  		<a href="/credentials_init">Credentials Inits
			  		</a>
			  	</button>
			  </div>
			</div>
		</div>
	</div>


	  <!-- send smsto account modal -->
    <div class="modal fade" id="sendSmsToAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

          <div class="modal-body">

                <!-- loading indicator-->
                
                <div v-if="isLoading">
                	<div style="width: 20px;height: 20px;" class="loader"></div>
                </div>

                <div class="row main">
                    <div class="col-md-12" style="padding:30px;">
                        <h4 class="g-tpl-title">Enter Message</h4><br>
                        
                        <table>
                        	<tr>
                        		<td>
                        			Subject:&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        		</td>
                        		<td style="margin-left: 10px;">
                        			<input v-model="smsObj.subject" class="form-control input-normal" type="text" placeholder="subject" name="">
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			Body:<br><br>
                        		</td>
                        		<td>
                        			<textarea v-model="smsObj.body" class="form-control input-normal" placeholder="body of notification"></textarea>
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>
                        			Img-Url:<br><br>
                        		</td>
                        		<td>
                        			<input v-model="smsObj.img_url" class="form-control input-normal" type="text" placeholder="url-img" name="">
                        		</td>
                        	</tr>
                        </table>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button ng-if="1" type="button" class="btn btn-warning g-tpl-warning" v-on="click: sendSmsToAccount()">Send Now</button>
            <button type="button" class="btn btn-default g-tpl-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /send smsto account modal -->


	</body>




	
	<script type="text/javascript" src="./dist/js/vue.min.js"></script>
	<script type="text/javascript" src="./dist/js/axios.min.js"></script>
	<script type="text/javascript">

		(function() {
		   // your page initialization code here
		   // the DOM will be available here
		   //alert(window.location.href)
		})();

		//user agent
		//alert(JSON.stringify(window.navigator));


		Vue.component('modal', {
		    template: '#sendSmsToAccountModal',
		    data: function () {
		        console.log("### DATA");
		    },
		});
		

		var APP = new Vue({
			el : '#app',
			delimiters: ['${', '}'],
			//delimiters: ['[[',']]']  "XXXX-XXXX-XXXX" "b2440a14-c5c3-4213-adf1-07ec3ad7730c"
			data : {
				current_user : {{USER|raw}},
				categories : {{CATEGORIES|raw}},
				my_categories : {{MY_CATEGORIES|raw}},
				players : {{PLAYERS|raw}},
				friends_accounts :{{FRIENDS_ACCOUNTS|raw}},

				myPlayerID : "XXXX-XXXX-XXXX",
				isLoading : false,
				selectedFriendAccount : null,
				smsObj : {subject:'',body:'',img_url:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTr19pppHsQKpm2uWguS1LgbV5L_NGqu4v53ws7POmHm23tlV53Rg'},

				name: "Gr@nd M@ster",
				counter : 0,
				list : [],
				editStatus : {
					tempObj : {},
					onEdit : false,
					index : 0
				}
			},
			methods : {
				openSendSmsToAccountModal : function(account){
					this.selectedFriendAccount =account;
					jQuery("#sendSmsToAccountModal").modal();
				},
				sendSmsToAccount : function(){
					
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('sender_account_no', this.current_user.acc_no);
					bodyFormData.set('account_no', this.selectedFriendAccount.acc_no);
					bodyFormData.set('subject', this.smsObj.subject );
					bodyFormData.set('body', this.smsObj.body );
					bodyFormData.set('img_url', this.smsObj.img_url );

					axios({
						method: 'post',
					    url: window.location.href + "api/send_sms_to_account",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	jQuery("#sendSmsToAccountModal").modal('toggle');
				    	if(response.data.status == "OK"){
				    		this.players[$index].subscribe = 1;
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				},
				subscribePlayer : function(player,$index){
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('account_no', this.current_user.acc_no);
					bodyFormData.set('player_id', player.id );

					axios({
						method: 'post',
					    url: window.location.href + "api/subscribe_player",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.players[$index].subscribe = 1;
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				},
				unSubscribePlayer : function(player,$index){
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('account_no', this.current_user.acc_no);
					bodyFormData.set('player_id', player.id );

					axios({
						method: 'post',
					    url: window.location.href + "api/unsubscribe_player",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.players[$index].subscribe = 0;
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				},
				addCategory : function(cat){
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('account_no', this.current_user.acc_no);
					bodyFormData.set('cat_id', cat.id );

					axios({
						method: 'post',
					    url: window.location.href + "api/add_cat_to_acc",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	if(response.data.status == "OK"){
				    		this.my_categories.push(response.data.category);
				    	}
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				},
				removeCategory : function(cat,$index){
					var oldCat = cat;
					this.isLoading = true;
					var bodyFormData = new FormData();
					bodyFormData.set('account_no', this.current_user.acc_no);
					bodyFormData.set('cat_id', cat.id );

					axios({
						method: 'post',
					    url: window.location.href + "api/remove_cat_from_acc",
					    data: bodyFormData,
					    config: { headers: {'Content-Type': 'multipart/form-data' }}
					})
				    .then(response => {
				    	this.isLoading = false;
				    	this.my_categories.splice($index,1);
				    })
				    .catch(err => {
				    	this.isLoading = false;
				       // Manage the state of the application if the request 
				       // has failed      
				    })
				},
				addPlayer : function(){
					if(this.myPlayerID == "" || this.myPlayerID == "XXXX-XXXX-XXXX"){

					}
					else{
						//check if player present in a list
						var found = 0;
						for(var i = 0;i<this.players.length;i++){
							if(this.players[i].player_id == this.myPlayerID) found=1;
							//console.log(JSON.stringify(this.players[i]))
						}
						if(found == 1) { console.log("--Player-FOUND--");}
						else{
							//player not found add..
							console.log("--Player-NOT-FOUND--");
							
							var bodyFormData = new FormData();
							bodyFormData.set('account_no', this.current_user.acc_no);
							bodyFormData.set('player_id', this.myPlayerID );

							axios({
								method: 'post',
							    url: window.location.href + "api/add_player",
							    data: bodyFormData,
							    config: { headers: {'Content-Type': 'multipart/form-data' }}
							})
						    .then(response => {
						    	//console.log(JSON.stringify(response))
						    	if(response.data.status == "OK"){
						    		
						    		if(response.data.player != null) {this.players.push(response.data.player);
						    			alert("DEVICE-ADDED.");
						    			}
						    	}else{

						    	}
						    })
						    .catch(err => {
						       // Manage the state of the application if the request 
						       // has failed      
						    })
						}
					}
					
				}
			}
			
		});

		//run interval for the auto fix date
		setInterval(function(){
			console.log("--player-check--");
			APP.addPlayer();
		},10000);
	</script>



	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script src="https://testaviva.dk/service-worker.js"></script>
	<script>
	  var OneSignal = window.OneSignal || [];
	  OneSignal.push(function() {

	    OneSignal.init({
	      appId: '{{APP_INFO.app_id}}',
	      allowLocalhostAsSecureOrigin: true,
	      notifyButton: {
	        enable: true,
	      }
	    });

	    //.endInit();
	    OneSignal.getUserId(function(userId) {
	      console.log("OneSignal User ID:", userId);
	      //document.getElementById('myPlayerID').innerHTML=userId;
	      document.getElementById('myPlayerID').value=userId;
	      //set vue my app
	      APP.myPlayerID = userId;

	      // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
	    }); 
	                 
	    OneSignal.getUserId().then(function(userId) {
	      console.log("OneSignal User ID:", userId);
	      // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
	    });

	  });



	</script>


</html>


