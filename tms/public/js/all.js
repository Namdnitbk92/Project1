var _app = function(){
	this.baseUrl = '/tms/public/';
};


if (typeof $ !== 'function')
	throw new Error('JQuery not include in app');

_app.prototype = {
	sendData : function(url,data){
		var parent = this;
		url = _.contains(url,this.baseUrl) ? void 0 : (this.baseUrl + url);
		console.log(url);
		var request = $.ajax({
			url : url,	
			data : data,
			datatype : 'json',
			method : 'POST',
			async : false
		})

		request.done(function(event){
			console.log(event);
		})
	},
	LoginEvent : function(){
		var parent = this;

		var clickLogin = function() {
			
			var btnLogin = $('.btn-login');

				if(btnLogin.length > 0) {
					btnLogin.click(function(event){
						var _form = $('.form-login');
						parent.sendData('login',{_form.serialize()});	
					});
				} else {
					var interval = setInterval(function(){
						btnLogin = $('.btn-login');
						if(btnLogin.length > 0) {
							clearInterval(this);
							parent.LoginEvent();
						}
					},200);
				} 
		}
		/*init tooltip for each input*/
		var triggerTooltip = function(){
			var password = $('input[name="password"]');
			var email = $('input[name="email"]');
			password.popup !== undefined ? password.popup({
				position : 'right center',
				content : 'Please enter password to login with your"s account'
			}) : void 0;

			email.popup !== undefined ? email.popup({
				position : 'right center',
				content : 'Please enter email to login with your"s account'
			}) : void 0;
		}

		return (function(c,t){
			typeof c === "function" ? c() : void 0;
			typeof t === "function" ? t() : void 0;	
		}(clickLogin,triggerTooltip))

	},
	OtherEvent : function(){
	},
	run : function(){
		this.LoginEvent();
	}
}

$(document).ready(function(){
	/*init global object use in app*/
	var app = new _app();
	try{
		app.run();
	}catch(e)
	{
		console.log(e);
	}
});

//# sourceMappingURL=all.js.map

//# sourceMappingURL=all.js.map
