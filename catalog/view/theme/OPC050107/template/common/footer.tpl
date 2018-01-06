<footer>

<!--<div class="footer-up-cols">
  <div class="container">
    <div class="row">
    <div class="custom-ship-banner col-sm-12">        <div class="container">     <div class="col-sm-12 custom-ship-container">    <div class="col-sm-3">    <a href="#">   <img src="./image/demo-img/ship1.png" class="img-responsive">   </a>    </div>     <div class="col-sm-3">     <a href="#">   <img src="./image/demo-img/ship2.png" class="img-responsive">    </a>    </div>     <div class="col-sm-3">     <a href="#">   <img src="./image/demo-img/ship3.png" class="img-responsive">    </a>    </div>     <div class="col-sm-3">     <a href="#">   <img src="./image/demo-img/ship4.png" class="img-responsive">    </a>    </div>     </div>      </div>    </div>
    
    
    </div>
    </div>
    
    
    
</div>-->

 <div class="container">
 	<?php foreach($top_blocks as $module) echo $module; ?>
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
        <div class="col-sm-6 pull-right nowrap">
        <ul class="pay-icon list-inline">
         <li> We Accept </li>
        <li> <img src="./image/demo-img/productpay_footer.png"> </li>
          
         
     </div>
     </div>
    </div> 
    </div>  
    <div class="container">
    	<?php foreach($bottom_blocks as $module) echo $module; ?>
 	</div>
</footer>

<!--
Website created by www.kodecube.com
//-->

<div id="loader-container"><img src="/image/twt.png"><div id="loader" class="loader"></div></div>

</body></html>