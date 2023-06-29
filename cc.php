<?php 
 include 'components/connection.php';
 session_start();
 if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}
?>

<style type="text/css">
.padding{
padding: 5rem !important;
}

.form-control:focus {
box-shadow: 10px 0px 0px 0px #ffffff !important;
border-color: #4ca746;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>Credit Card Payment</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/small leaf.png">
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href='https://use.fontawesome.com/releases/v5.7.7/css/all.css'>
    <script src='https://cdjns.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link rel="stylesheet" href="ccstyle.css">
</head>
   
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
<div class="logo">
    <img src="img/logo1.png">
</div>
 <div class="padding">
        <div class="row">
            <div class="container d-flex justify-content-center">
                <div class="col-md-6 col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                            
                            <div class="col-md-6">
                                <span>CREDIT/DEBIT CARD PAYMENT</span>
                                
                            </div>

                            <div class="col-md-6 text-right" style="margin-top: -5px;">

                                  <img src="https://img.icons8.com/color/36/000000/visa.png">
                                  <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                                  <img src="https://img.icons8.com/color/36/000000/amex.png">
                                           
                            </div>      

                        </div>    
  
                        </div>
                        <div class="card-body" style="height: 350px">
                            <div class="form-group">
                            <label for="cc-number" class="control-label">CARD NUMBER</label>
                            <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" required>
                          </div>

                          <div class="row">

                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="cc-exp" class="control-label">CARD EXPIRY</label>
                                    <input id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="&bull;&bull; / &bull;&bull;" required>
                                  </div>

                                
                            </div>

                             <div class="col-md-6">
                               <div class="form-group">
                                <label for="cc-cvc" class="control-label">CARD CVC</label>
                                <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="&bull;&bull;&bull;&bull;" required>
                              </div>
                            </div>
                              
                          </div>

      
                          <div class="form-group">
                            <label for="numeric" class="control-label">CARD HOLDER NAME</label>
                            <input  type="text" class="input-lg form-control">
                          </div>

                           <div class="form-group">
                            
                            <a href="order.php"><input value="PROCESS PAYMENT" type="button" class="btn btn-success btn-lg form-control" style="font-size: .8rem;"></a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<script type="text/javascript">
    $(function($) {
      $('[data-numeric]').payment('restrictNumeric');
      $('.cc-number').payment('formatCardNumber');
      $('.cc-exp').payment('formatCardExpiry');
      $('.cc-cvc').payment('formatCardCVC');
      $.fn.toggleInputError = function(erred) {
        this.parent('.form-group').toggleClass('has-error', erred);
        return this;
      };
      $('form').submit(function(e) {
        e.preventDefault();
        var cardType = $.payment.cardType($('.cc-number').val());
        $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
        $('.cc-brand').text(cardType);
        $('.validation').removeClass('text-danger text-success');
        $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
      });
    });