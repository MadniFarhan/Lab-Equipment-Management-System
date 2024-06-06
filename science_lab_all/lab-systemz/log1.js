jQuery('#m3').validate({
	rules:{
		name:"required",
		email:{
			required:true,
			email:true
		},
		password:{
			required:true,
			minlength:4
		},
                check:"required"
	},messages:{
		name:"Please enter your name",
		email:{
			required:"Please enter email",
			email:"Please enter valid email",
		},
		password:{
			required:"Please enter your password",
			minlength:"Password must be 5 char long"
		},
                check:"Error:(please select)"
	},
	submitHandler:function(form){
		form.submit();
	}
});



jQuery('#m4').validate({
	rules:{
		username:"required",
		email:{
			required:true,
			email:true
		},
		password:{
			required:true,
			minlength:4
		}
		
	},messages:{
		username:"Please enter your name",
		
		password:{
			required:"Please enter your password",
			minlength:"Password must be 5 char long"
		}
              
	},
	submitHandler:function(form){
		form.submit();
	}
});
