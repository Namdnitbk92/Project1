var _app = function(){
	this.baseUrl = '/Project1/tms/public/';
};

if (typeof $ !== 'function')
	throw new Error('JQuery not include in app');

_app.prototype = {
	Loading : function(action){
		var loading = $('.loadingArea');
		if(action === 'show') 
			loading.show(1);
		else
			loading.hide(1);	
	},
	initAnimate : function(){
		var animate = $('.sub-nav');
		if(animate.length > 0)
			setTimeout(function(){
				animate.transition('jiggle');
			},400);
	},
	Request : function(_this){
		var parent = _this;
		/*get data from form-date*/
		var processData = function(data){
			if(_.contains(data,'&'))
			{
				data = data.split('&');
				var obj  = {};
				for(var k in data) {
					var temp = _.contains(data[k],'=') ? data[k].split('=') : void 0;
					if(Array.isArray(temp))
						obj[temp[0]] = temp[1];
				}
				return obj;
			}	

			return data;
		};

		return {
				sendData : function(url,data){
					var request = $.ajax({
						url : url,	
						data : processData(data),
						dataType : 'json',
						method : 'POST',
						complete  :function(res){
							setTimeout(function(){
								parent.Loading('hide');
							},1000);
							
						}
					})

				}
		}
	},
	LoginEvent : function(){
		var parent = this;
		var args = [];
		var clickLogin = function() {
			
			var btnLogin = $('.btn-login');

				if(btnLogin.length > 0) {
					btnLogin.click(function(event){
						var _form = $('.form-login');
						parent.Loading('show');
						new parent.Request(parent).sendData('login',_form.serialize());
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

		var course = function(){};

		course.prototype.event = function() {
			var add = $('.add-course');
			/*var modal = $('#add-course-modal');*/
			var subjectList = $('select[name="subjectList"]');
			var container = $('#subject_list');

			subjectList.change(function() {
				var temp = container.data('value');
				var selected = $('.subjectSelected');
				temp = temp === undefined ? '-' : temp;

				if(!subjectList.val())
					return;

				temp += ', ' + subjectList.val();
				container.data('value',temp);
				$('input[name="subjectData"]').val(temp);
				selected.html(container.data('value'));
				$('.pl').transition('jiggle');
			});
			
			/*add.click(function(){
				modal.modal('show');
			})*/

		}

		course.prototype.run = function()
		{
			this.event();
		}

		new course().run();

		args.push(clickLogin);
		args.push(triggerTooltip);
		args.push(c.run);

		return (function(args) {

			if(args.length == 0)
				return;

			for(var k in args) {
				typeof args[k] === "function" ? args[k]() : void 0;
			}

		}(args))
	},
	OtherEvent : function(){
	},
	useDataTable : function(colName,data,config){
		/*init table*/
		var TableBuilder = function(){};
		TableBuilder.prototype = {
			createCol : function(col){
				if(!Array.isArray(col))
					return '';

				var strCol = '<table class="display" cellspacing="0" width="100%">';
				strCol += '<thead>';
				for(var i = 0 ;i < col.length; i++) {
					strCol += '<th>' + col[i] + '</th>';	
				}	
				strCol += '<thead>';

				return strCol;
			},
			fillContent : function(data){
				var tbody = '<tbody>';
				var body = '';
				if(Array.isArray(data)) {
					for(var d in data) {
						var iterator = data[d];
						body += '<tr>'
						for(var k in iterator)
							body += '<td>' + iterator[k]+ '</td>';	


					}
				}
				return tbody + body + '<tbody>';
			},
			run : function(col,data){
				return this.createCol(col) + this.fillContent(data);
			}
		}

		var tableId = config.id ? config.id : null;

		if(_.isNull(tableId) == null  || _.isUndefined(tableId))
			throw new Error('use dataTable required id for table!');

		var tableObj = $('#' + tableId);
		if(tableObj.length == 0)
			throw new Error('DOM Element #' + tableId + ' not exists');

		builder = new TableBuilder();
		tableObj.html(builder.run(colName,data));
		tableObj.DataTable(config);
		/*style custom for data table*/
		document.getElementById("my-table").style.boxShadow = "rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.188235) 0px 6px 20px 0px";
		
		var wrapper = $('#' + tableId +'_wrapper');
		if(wrapper.length > 0) {
			$(_.first(wrapper.find('input'))).css('outline','none');
			$(_.first(wrapper.find('input'))).css('border-radius','10px');
		}
	},
	redirect : function(url)
	{
		if(_.isNull(url) || _.isUndefined(url))
			return;

		window.location.href = url;
	}, 
	run : function(){
		this.LoginEvent();
		this.initAnimate();
	}
}

var app = new _app();

$(document).ready(function(){
	/*init global object use in app*/
	try{
		app.run();
	}catch(e)
	{
		console.log(e);
	}
});


//# sourceMappingURL=all.js.map
