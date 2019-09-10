(function() {
   // your page initialization code here
   // the DOM will be available here
   //alert(window.location.href)
   //alert(JSON.stringify(window.location));
})();



var getRateValue = function(){
	var rates = document.getElementsByName('rate');
	var rate_value;
	for(var i = 0; i < rates.length; i++){
	    if(rates[i].checked){
	        rate_value = rates[i].value;
	    }
	}
	return rate_value == undefined ? 0 : rate_value;
};

var APP = new Vue({
	el : '#app',
	delimiters: ['${', '}'],
	data : {
		isLoading : false,
		showFeedbackForm : true,
		accountId : app_info.ACC_ID,
		appId : app_info.APP_ID,
		refCode : app_info.REF_CODE,
		formData : {
			//phone : "",email:"",username:"",comment:"",stars_count:0
			phone : "+255",email:"grand123grand1@gmail.com",username:"Grand",
			comment:"Awesome service",stars_count:0,share : 1,comment_cat_id:-1
		}
	}, 
	methods : {
		openNewAccModal : function(){
			jQuery("#newAccountModal").modal();
		},
		submitMyComment : function(){
			this.formData.stars_count = getRateValue();
			this.formData.share = this.formData.share == true ? 1 : 0;
			
			this.isLoading = true;
			var bodyFormData = new FormData();
			bodyFormData.set('comment',JSON.stringify(this.formData)); 
			axios({
				method: 'post',
			    url: window.location.origin + "/cff-api/comment/"+this.accountId+"/"+this.appId+'/'+ this.refCode,
			    data: bodyFormData,
			    config: { headers: {'Content-Type': 'multipart/form-data' }}
			})
		    .then(response => {
		    	this.isLoading = false;
		    	this.showFeedbackForm = false;
				setTimeout(function(){
					console.log("@*gmtech.co.tz*@");
					this.goHome();
				}.bind(this),5000); 
		    })
		    .catch(err => {
		    	this.isLoading = false;
		       	this.isLoading = false;
		    	this.showFeedbackForm = false;
				setTimeout(function(){
					console.log("@*gmtech.co.tz*@");
					this.goHome();
				}.bind(this),5000);     
		    })

		},
		goHome : function(){
			if(this.showFeedbackForm) return;

			this.formData = {
				phone : "+255",email:"grand123grand1@gmail.com",username:"Grand",
				comment:"Awesome service",stars_count:0,share : 1,comment_cat_id:-1
			};
			this.isLoading = false;
			this.showFeedbackForm = true;
		}
		
	}
	
});