/*
 * Change Navbar color while scrolling
*/

$(window).scroll(function(){
	handleTopNavAnimation();
});

$(window).load(function(){
	handleTopNavAnimation();
});

function handleTopNavAnimation() {
	var top=$(window).scrollTop();

	if(top>10){
		$('#site-nav').addClass('navbar-solid');
	}
	else{
		$('#site-nav').removeClass('navbar-solid');
	}
}

/*
 * Registration Form
*/

$('#registration-form').submit(function(e){
    e.preventDefault();

		var postForm = { //Fetch form data
						'fname'     : $('#registration-form #fname').val(),
						'email'     : $('#registration-form #email').val(),
						'type'       : $('#registration-form #type').val()
		};

		if ( postForm.type == "Estudante" )
			{
				  postForm.curso 		= $('#registration-form #curso').val();
					postForm.ano 			= $('#registration-form #ano').val();
					postForm.JuniName = "-----";
			}
			else if ( postForm.type == "Junior Empresa" )
			{
					  postForm.curso 		= "-----";
						postForm.ano 			= "-----";
						postForm.JuniName = $('#registration-form #JuniName').val();
			}


    $.ajax({
            type      : 'POST',
            url       : './assets/php/contact.php',
            data      : postForm,
            dataType  : 'json',
            success   : function(data) {
                            if (data.success) {
                                $('#registration-msg .alert').html("Registration Successful");
                                $('#registration-msg .alert').removeClass("alert-danger");
                                $('#registration-msg .alert').addClass("alert-success");
                                $('#registration-msg').show();
                            }
                            else
                            {
                                $('#registration-msg .alert').html("Registration Failed");
                                $('#registration-msg .alert').removeClass("alert-success");
                                $('#registration-msg .alert').addClass("alert-danger");
                                $('#registration-msg').show();
                            }
                        }
        });
});

/*
 * SmoothScroll
*/

//smoothScroll.init();


/**
	*  Selector
	*/

$( document ).ready(function() {
  $("#JuniName").hide();
	$("#JuniName").prop('required', false);
	$("#ano").hide();
	$("#ano").prop('required', false);
	$("#curso").hide();
	$("#curso").prop('required', false);
});


$( "#type" ).change(function() {
	if ( $(this).val() == "Estudante" )
	{
		  $("#JuniName").hide();
			$("#JuniName").prop('required', false);
			$("#ano").show();
			$("#ano").prop('required', true);
			$("#curso").show();
			$("#curso").prop('required', true);
	}
	else if ( $(this).val() == "Junior Empresa" )
	{
		  $("#JuniName").show();
			$("#JuniName").prop('required', true);
			$("#ano").hide();
			$("#ano").prop('required', false);
			$("#curso").hide();
			$("#curso").prop('required', false);
	}

});
