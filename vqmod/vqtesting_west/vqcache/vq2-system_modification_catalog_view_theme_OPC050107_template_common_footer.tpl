<footer>
<div class="footer-up-cols">
  <div class="container">
    <div class="row">
    <div class="custom-ship-banner col-sm-12">        <div class="container">     <div class="col-sm-12 custom-ship-container">    <div class="col-sm-3">    <a href="#">   <img src="./image/demo-img/ship1.png" class="img-responsive">   </a>    </div>     <div class="col-sm-3">     <a href="#">   <img src="./image/demo-img/ship2.png" class="img-responsive">    </a>    </div>     <div class="col-sm-3">     <a href="#">   <img src="./image/demo-img/ship3.png" class="img-responsive">    </a>    </div>     <div class="col-sm-3">     <a href="#">   <img src="./image/demo-img/ship4.png" class="img-responsive">    </a>    </div>     </div>      </div>    </div>
    
    
    </div>
    </div>
    
    
    
</div>


  <div class="container">
    <div class="row">
      <?php echo $footerright; ?>
    </div>
    <hr>    
   
  </div>
  
   <div class="bottom-footer"> 
    <div class="container">
    <div class="row"> 
    <div class="col-sm-6 pull-left">
     <p class="powered"> <?php echo $powered; ?></p> 
       </div> 
        <div class="col-sm-6 pull-right">
        <ul class="pay-icon list-inline">
         <li> We Accept </li>
        <li> <img src="./image/demo-img/visa.png"> </li>
         <li> <img src="./image/demo-img/mast.png"> </li>
          <li> <img src="./image/demo-img/swift.png"> </li>
           <li> <img src="./image/demo-img/paypal.png"> </li>     
     </div>
     </div>
    </div> 
    </div>  
</footer>

<!--
Website created by www.kodecube.com
//-->

<div id="loader-container"><img src="/image/twt.png"><div id="loader" class="loader"></div></div>


				<?php echo $htmlpromo; ?>
      

            <style>
            #cookie-space {
                display:none;
                height: 51px;
            }    
            #cookie-consent {
                width: 100%;
                position: fixed;
                left: 0px;
                z-index: 999;
                background: #fff;
                border-bottom: 5px solid #66a401;
                display: none;
                padding: 10px 0px;
                top: 0px;
                color:#2b2b2b;
                font-weight:bold;
            }
            #cookie-consent #accept {
                float: right;
                margin-top: 1px;
                margin-left: 10px;
                background: none repeat scroll 0% 0% rgba(97, 97, 97, 0.65);
                padding: 5px 10px;
                border: medium none;
                color: #FFF;
                cursor: pointer;
            }
            #cookie-inner {
                display: block;
                max-width: 1280px;
                margin-left: auto;
                margin-right: auto;
                padding: 0px 0px;
                min-width: 300px;
            }      
            </style>
            <script type="text/javascript">
                $(document).ready(function() {
                var myCookie = document.cookie.replace(/(?:(?:^|.*;\s*)accepted\s*\=\s*([^;]*).*$)|^.*$/, "$1");
                    if (myCookie != "yes") {
                        $('#cookie-consent').show();
                        $('#cookie-space').show();
                        $('#accept').click(function() {
                            document.cookie = "accepted=yes; expires=Thu, 18 Dec 2025 12:00:00 GMT; path=/";
                            $('#cookie-space').hide();
                            $('#cookie-consent').hide();
                        });
                    }
                });        
            </script>
            <div id="cookie-space"></div>                
            <div id="cookie-consent">
                <div id="cookie-inner">
                    <div id="cookie-text"><button id="accept"><?php echo $text_cookie_close; ?></button><?php echo $text_cookie; ?></div>   
                </div>
             </div>
            

				<?php echo $below_footer; ?>
				<div class="container"><div class="row"><?php echo $below_ft_lt; ?><?php echo $below_ft_rt; ?></div></div>
				<div class="container"><div class="row"><?php echo $below_ft_pm_lt; ?><?php echo $below_ft_pm_md; ?><?php echo $below_ft_pm_rt; ?></div></div>
				<?php echo $below_ft_btm; ?>
			
</body></html>