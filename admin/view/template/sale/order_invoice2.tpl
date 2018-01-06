<!doctype html>
<html dir="<?php echo $direction; ?>" class="no-js" lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="view/stylesheet/invoice-assets/css/main.css?v=5">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>
    <?php foreach ($orders as $order) { ?>
    <div class="invoice-container">

        <h1 class="heading cf">
            <img src="view/stylesheet/invoice-assets/logo.png?v=2" alt="thinkwinetrade" width="400" height="271" />
            <!-- <?php echo $order['store_name']; ?> -->
        </h1>

        <div class="brief">
            <div class="inner">
                <h2>
                    <?php echo $order['invoice_no']; ?><br>
                    ORDER # <?php echo $order['order_id']; ?>
                </h2>
                <hr />
                <p>
                    <?php
                        if( strpos( $order['store_address'], 'Addr: ' ) !== FALSE )
                        {
                            echo '<b>Address:</b> '.str_replace('Addr: ', '', $order['store_address']);
                        }
                        else if( strpos( $order['store_address'], 'Address: ' ) !== FALSE )
                        {
                            echo '<b>Address:</b> '.str_replace('Address: ', '', $order['store_address']);
                        }
                        else
                        {
                            echo $order['store_address'];
                        }
                    ?><br>
                    <b><?php echo $text_telephone; ?></b> <?php echo $order['store_telephone']; ?><br />
                    <?php if ($order['store_fax']) { ?>
                    <b><?php echo $text_fax; ?></b> <?php echo $order['store_fax']; ?><br />
                    <?php } ?>
                    <b><?php echo $text_email; ?></b> <?php echo $order['store_email']; ?><br />
                    <b><?php echo $text_website; ?></b> <a href="<?php echo $order['store_url']; ?>"><?php echo $order['store_url']; ?></a>
                </p>
            </div><!-- inner -->
        </div><!-- brief -->

        <div class="cf mb66">
            <div class="invoice-address">
                <div class="inner">
                    <h2><?php echo $text_to; ?></h2>
                    <p>
                        <?php echo $order['payment_address']; ?>
                    </p>
                </div>

                <div class="inner second">
                    <h2><?php echo $text_ship_to; ?></h2>
                    <p>
                        <?php echo $order['shipping_address']; ?>
                    </p>
                </div>
            </div><!-- invoice-address -->
            <table class="invoice-items">
                <thead>
                    <tr>
                        <th><?php echo $column_product; ?></th>
                        <th><?php echo $column_model; ?></th>
                        <th><?php echo $column_quantity; ?></th>
                        <th><?php echo $column_price; ?></th>
                        <th><?php echo $column_total; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order['product'] as $product) { ?>
                        <tr>
                          <td><?php echo $product['name']; ?>
                          <?php foreach ($product['option'] as $option) { ?>
                          <br />
                          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                          <?php } ?></td>
                          <td><?php echo $product['model']; ?></td>
                          <td><?php echo $product['quantity']; ?></td>
                          <td><?php echo $product['price']; ?></td>
                          <td><?php echo $product['total']; ?></td>
                        </tr>
                      <?php } ?>
                      <?php foreach ($order['voucher'] as $voucher) { ?>
                        <tr>
                          <td><?php echo $voucher['description']; ?></td>
                          <td></td>
                          <td>1</td>
                          <td><?php echo $voucher['amount']; ?></td>
                          <td><?php echo $voucher['amount']; ?></td>
                        </tr>
                      <?php } ?>
                </tbody>
            </table>
        </div><!-- CF -->

        <?php
          $counter = 0;
          $totals_string = '';
          foreach ($order['total'] as $total) {
            $counter++;
            if($counter == 1):
        ?>
        <div class="subtotal cf">
            <h2><?php echo $total['title']; ?></h2>
            <span class="amount"><?php echo $total['text']; ?></span>
        </div><!-- subtotla -->
        <?php
          else:
            $total_title = $total['title'];
            $total_num = $total['text'];
            $totals_string .= <<<OUT
              <li>
                {$total_title}
                <span class="amount">{$total_num}</span>
              </li>
OUT;
          endif;
        } ?>

        <div class="payment-info cf">
            <!-- <div class="left">
                <h2>Payment Method</h2>
                <p>Quisque mollis, sem id laoreet pretium, lectus elit molestie urna, id tristique risus ante at est. Sed pretium metus.</p>
            </div> -->
            <ul class="right">
               <?php echo $totals_string; ?>
            </ul>
        </div>

        <!-- <div class="signature cf">
            <img src="view/stylesheet/invoice-assets/signature.png" alt="Signature" />
            <div class="persona">
                <span class="name">Mark Williams</span><br>
                <span class="title">Director</span>
            </div>
        </div> -->

        <footer class="footer">
            <p>
                <?= $order['comment']; ?>
            </p>
        </footer>

    </div><!-- invoice-container -->
    <?php } ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        if( window.jQuery )
        {
            (function($)
            {

                $('.payment-info').find('.right').each(function(i, ele)
                {
                    $(ele).find('li:last-child').addClass('highlight');
                });

            })(jQuery);
        }
    </script>

</body>
</html>