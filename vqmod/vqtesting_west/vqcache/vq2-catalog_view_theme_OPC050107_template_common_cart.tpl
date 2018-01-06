
     <a onclick="$('#loader-container').show();" href="<?php echo $pallet_worksheet; ?>" class="cartlink cartkc">
    <div class="text-cart"></div>
    <div class="price-cart">
        <button type="button" class="btn btn-inverse btn-block">

               <?php
     if(isset($palletsqty) && $palletsqty >0) {
        echo '<span class="badge" id="frontballoon">'.$palletsqty.'</span>';
    } else {
        echo '<span class="badge" id="frontballoon">0</span>';
        }?>

        <span id="grandtotal" >
        <?php echo (isset($grandtotal) && $grandtotal != '') ? ' ' . $grandtotal : '0,00' ?>
        </span></button>
    </div>
</a>
      



