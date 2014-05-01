<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$firstname = trim($_POST["firstname"]);
	$lastname = trim($_POST["lastname"]);
	$company = trim($_POST['company']);
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	
	$ccompany = trim($_POST['clientcompany']);
	$ccity = trim($_POST['clientcity']);
	$cstate = trim($_POST['clientstate']);
	$cname = trim($_POST['clienttname']);
	$ccontact = trim($_POST['clientcontact']);
	
	$goals = trim($_POST['goals']);
	$strategy = trim($_POST['strategy']);
	$results = trim($_POST['results']);
	$summary = trim($_POST['summary']);
	
	$screenshot1 = trim($_POST['screenshot1']);
	$screenshot2 = trim($_POST['screenshot2']);
	$screenshot3 = trim($_POST['screenshot3']);
	$screenshot4 = trim($_POST['screenshot4']);
	
	 if ($firstname == '' OR $email == '') {
		$error_message =  'Blank name, email or message. D&apos;oh!';
	 }
	
	if (!isset($error_message)) {
		foreach ( $_POST as $value) {
			if( stripos($value, 'Content-Type:') !== FALSE ) {
				$error_message =   'There was a problem with the information you entered.';
			}
		}
	}
	
	require_once('inc/phpmailer/class.phpmailer.php');
	$mail = new PHPMailer();
	
	if (!isset($error_message) && !$mail->ValidateAddress($email)){
		$error_message = 'You must enter a valid email address.';
	}
	
	if (!isset($error_message)) {
		$email_body = "";
		
		$email_body = $email_body . "**Submitter Information:**<br />";
		$email_body = $email_body . "First name: " . $firstname . "<br />";
		$email_body = $email_body . "Last name: " . $lastname . "<br />";
		$email_body = $email_body . "Company: " . $company . "<br />";
		$email_body = $email_body . "" . $city . ", ";
		$email_body = $email_body . "" . $state . "<br />";
		$email_body = $email_body . "Email: " . $email . "<br />";
		$email_body = $email_body . "Phone: " . $phone . "<br /><br />";
		
		$email_body = $email_body . "**Client Information:**<br />";
		$email_body = $email_body . "Client Company: " . $ccompany . "<br />";
		$email_body = $email_body . "" . $ccity . ", ";
		$email_body = $email_body . "" . $cstate . "<br />";
		$email_body = $email_body . "Client Contact: " . $cname . "<br />";
		$email_body = $email_body . "" . $ccontact . "<br /><br />";
		
		$email_body = $email_body . "**Submission:**<br />";
		$email_body = $email_body . "Goals: " . $goals . "<br /><br />";
		$email_body = $email_body . "Strategy: " . $strategy . "<br /><br />";
		$email_body = $email_body . "Results: " . $results . "<br /><br />";
		$email_body = $email_body . "Summary: " . $summary . "<br /><br />";
		
		$mail->SetFrom($email,$firstname . ' ' . $lastname);
			
		$address = "greghauenstein@gmail.com";
		$mail->AddAddress($address, "The Hashies");
		
		$mail->Subject    = "Hashies Application submission";
		
		$mail->MsgHTML($email_body);
			
		if($mail->Send()) {
			header("Location: /status=sent");
			exit;
		} else {
		  $error_message = 'There was a problem submitting your application: ' . $mail->ErrorInfo;
		}
		
	} // end if request_method
}
?>
<?php 
include('inc/header.php'); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				
				<?php if (isset($_GET["status"]) AND $_GET["status"] == "sent") { ?>
					<h3 class="ctr">Thank you for your submission!</h3>
					<p class="ctr"><img src="/smcdsm_icon-logo.jpg"></p>
				<?php } else { ?>
				
				<form method="POST" action="/" class="" role="form">
				
					<!-- Nav tabs -->
					<ul id="myTab" class="nav nav-tabs">
					  <li class="active"><a href="#yourinfo" data-toggle="tab">Your Info</a></li>
					  <li><a href="#agencyinfo" data-toggle="tab">Agency Info</a></li>
					  <li><a href="#submission" data-toggle="tab">Your Submission</a></li>
					</ul>
					
					<!-- Tab panes -->
					<div class="tab-content">
					  <div class="tab-pane fade in active" id="yourinfo">
					  	<div class="row">
					  		<div class="col-sm-12">
					  			<h3>Your information</h3>
					  			<div class="alert alert-warning">
					  				<p><strong>All fields are required.</strong> If we can't contact you, your entry will be forfeit!</p>
					  			</div>
					  		</div>
					  	</div>
					  	<div class="row">
					  		<div class="col-sm-5 col-sm-offset-1">
					  			<label for="firstname">Your first name</label>
					  			<input id="firstname" name="firstname" type="text" class="form-control" placeholder="">
					  		</div>
					  	  	<div class="col-sm-5">
					  	    	<label for="lastname">Your last name</label>
					  	    	<input id="lastname" name="lastname" type="text" class="form-control" placeholder="">
					  	  	</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-10 col-sm-offset-1">
					  			<label for="company">Your company/organization</label>
					  			<input id="company" name="company" type="text" class="form-control" placeholder="">
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-7 col-sm-offset-1">
					  			<label for="city">Your city/town</label>
					  			<input id="city" name="city" type="text" class="form-control" placeholder="" />
					  		</div>
					  		<div class="col-sm-3">
					  			<label>State</label>
					  			<select name="state" class="form-control">
					  				<option value="AL">AL</option>
					  				<option value="AK">AK</option>
					  				<option value="AZ">AZ</option>
					  				<option value="AR">AR</option>
					  				<option value="CA">CA</option>
					  				<option value="CO">CO</option>
					  				<option value="CT">CT</option>
					  				<option value="DE">DE</option>
					  				<option value="DC">DC</option>
					  				<option value="FL">FL</option>
					  				<option value="GA">GA</option>
					  				<option value="HI">HI</option>
					  				<option selected value="IA">IA</option>
					  				<option value="ID">ID</option>
					  				<option value="IL">IL</option>
					  				<option value="IN">IN</option>
					  				<option value="KS">KS</option>
					  				<option value="KY">KY</option>
					  				<option value="LA">LA</option>
					  				<option value="ME">ME</option>
					  				<option value="MD">MD</option>
					  				<option value="MA">MA</option>
					  				<option value="MI">MI</option>
					  				<option value="MN">MN</option>
					  				<option value="MS">MS</option>
					  				<option value="MO">MO</option>
					  				<option value="MT">MT</option>
					  				<option value="NE">NE</option>
					  				<option value="NV">NV</option>
					  				<option value="NH">NH</option>
					  				<option value="NJ">NJ</option>
					  				<option value="NM">NM</option>
					  				<option value="NY">NY</option>
					  				<option value="NC">NC</option>
					  				<option value="ND">ND</option>
					  				<option value="OH">OH</option>
					  				<option value="OK">OK</option>
					  				<option value="OR">OR</option>
					  				<option value="PA">PA</option>
					  				<option value="RI">RI</option>
					  				<option value="SC">SC</option>
					  				<option value="SD">SD</option>
					  				<option value="TN">TN</option>
					  				<option value="TX">TX</option>
					  				<option value="UT">UT</option>
					  				<option value="VT">VT</option>
					  				<option value="VA">VA</option>
					  				<option value="WA">WA</option>
					  				<option value="WV">WV</option>
					  				<option value="WI">WI</option>
					  				<option value="WY">WY</option>
					  			</select>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-5 col-sm-offset-1">
					  			<label for="email">Your email</label>
					  			<input id="email" name="email" type="email" class="form-control" placeholder="">
					  		</div>
					  	  	<div class="col-sm-5">
					  	    	<label for="phone">Your phone number</label>
					  	    	<input id="phone" name="phone" type="text" class="form-control" placeholder="">
					  	  	</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-4 col-sm-offset-4">
					  			<a href="#agencyinfo" data-toggle="tab" class="btn btn-primary btn-large btn-block">Next</a>
					  		</div>
					  	</div>
					  	
					  </div><!-- /.tab-pane #yourinfo -->
					  
					  <div class="tab-pane fade" id="agencyinfo">
					  	<div class="row">
					  		<div class="col-sm-12">
					  			<h3>Agency information</h3>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-10 col-sm-offset-1">
					  			<label for="clientcompany">Your client's company/organization</label>
					  			<input id="clientcompany" name="clientcompany" type="text" class="form-control" placeholder="">
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-7 col-sm-offset-1">
					  			<label for="clientcity">Client's city/town</label>
					  			<input id="clientcity" name="clientcity" type="text" class="form-control" placeholder="" />
					  		</div>
					  		<div class="col-sm-3">
					  			<label for="clientstate">Client's state</label>
					  			<select name="clientstate" class="form-control">
					  				<option value="AL">AL</option>
					  				<option value="AK">AK</option>
					  				<option value="AZ">AZ</option>
					  				<option value="AR">AR</option>
					  				<option value="CA">CA</option>
					  				<option value="CO">CO</option>
					  				<option value="CT">CT</option>
					  				<option value="DE">DE</option>
					  				<option value="DC">DC</option>
					  				<option value="FL">FL</option>
					  				<option value="GA">GA</option>
					  				<option value="HI">HI</option>
					  				<option selected value="IA">IA</option>
					  				<option value="ID">ID</option>
					  				<option value="IL">IL</option>
					  				<option value="IN">IN</option>
					  				<option value="KS">KS</option>
					  				<option value="KY">KY</option>
					  				<option value="LA">LA</option>
					  				<option value="ME">ME</option>
					  				<option value="MD">MD</option>
					  				<option value="MA">MA</option>
					  				<option value="MI">MI</option>
					  				<option value="MN">MN</option>
					  				<option value="MS">MS</option>
					  				<option value="MO">MO</option>
					  				<option value="MT">MT</option>
					  				<option value="NE">NE</option>
					  				<option value="NV">NV</option>
					  				<option value="NH">NH</option>
					  				<option value="NJ">NJ</option>
					  				<option value="NM">NM</option>
					  				<option value="NY">NY</option>
					  				<option value="NC">NC</option>
					  				<option value="ND">ND</option>
					  				<option value="OH">OH</option>
					  				<option value="OK">OK</option>
					  				<option value="OR">OR</option>
					  				<option value="PA">PA</option>
					  				<option value="RI">RI</option>
					  				<option value="SC">SC</option>
					  				<option value="SD">SD</option>
					  				<option value="TN">TN</option>
					  				<option value="TX">TX</option>
					  				<option value="UT">UT</option>
					  				<option value="VT">VT</option>
					  				<option value="VA">VA</option>
					  				<option value="WA">WA</option>
					  				<option value="WV">WV</option>
					  				<option value="WI">WI</option>
					  				<option value="WY">WY</option>
					  			</select>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-5 col-sm-offset-1">
					  			<label for="clientname">Client's name</label>
					  			<input id="clientname" name="clientname" type="text" class="form-control" placeholder="">
					  			<span class="help-block">Not required</span>
					  		</div>
					  	  	<div class="col-sm-5">
					  	    	<label for="clientcontact">Client's phone or email</label>
					  	    	<input id="clientcontact" name="clientcontact" type="text" class="form-control" placeholder="">
					  	    	<span class="help-block">Not required</span>
					  	  	</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-4 col-sm-offset-2">
					  			<a href="#yourinfo" data-toggle="tab" class="btn btn-default btn-large btn-block">Back</a>
					  		</div>
					  		
					  		<div class="col-sm-4">
					  			<a href="#submission" data-toggle="tab" class="btn btn-primary btn-large btn-block">Next</a>
					  		</div>
					  	</div>
					  	
					  </div><!-- /.tab-pane #agencyinfo -->
					  
					  <div class="tab-pane fade" id="submission">
					  	<div class="row">
					  		<div class="col-sm-12">
					  			<h3>Your submission</h3>
					  			<p>Please limit your answers to roughly 250 characters. Be sure to include only what can be shared publicly.</p>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-10 col-sm-offset-1">
					  			<label for="goals">Goals</label>
					  			<textarea name="goals" id="goals" class="form-control"></textarea>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-10 col-sm-offset-1">
					  			<label for="strategy">Strategy and Execution</label>
					  			<textarea name="strategy" id="strategy" class="form-control"></textarea>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-10 col-sm-offset-1">
					  			<label for="results">Evaluation/Results</label>
					  			<textarea name="results" id="results" class="form-control"></textarea>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-10 col-sm-offset-1">
					  			<label for="summary">Summary Statement</label>
					  			<textarea name="summary" id="summary" class="form-control" placeholder="Please limit yourself to roughly 3-4 sentences."></textarea>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-10 col-sm-offset-1">
					  			<label>Add screenshots</label>
					  		</div>
					  		
					  		<div class="col-sm-8 col-sm-offset-1">
					  			<div id="InputsWrapper">
					  				<div class="row"><div class="col-sm-11"><input class="form-control" type="text" name="screenshot1" id="screenshot1" placeholder="http://" /></div></div>
					  			</div>
					  			<span class="help-block">Maximum of 4</span>
					  		</div>
					  		<div class="col-sm-2 ">
					  			<a href="#" id="AddMoreFileBox"><i class="fa fa-plus"></i></a>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-6 col-sm-offset-3">
					  			<button type="submit" id="submit-button" class="btn btn-success btn-block">
					  				Submit application
					  			</button>
					  		</div>
					  	</div>
					  	
					  	<div class="row">
					  		<div class="col-sm-4 col-sm-offset-4">
					  			<a href="#agencyinfo" data-toggle="tab" class="btn btn-default btn-sm btn-block">Back</a>
					  		</div>
					  	</div>
					  	
					  </div><!-- /.tab-pane #submission -->
					  					
					</div>
					
				</form>
				
				<?php } ?>
	
			</div>
		</div>
	</div>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script>
	  $('#myTab a').click(function (e) {
	    e.preventDefault()
	    $(this).tab('show')
	  })
	</script>
	<script src="scripts.js" type="text/javascript"></script>
</body>
</html>