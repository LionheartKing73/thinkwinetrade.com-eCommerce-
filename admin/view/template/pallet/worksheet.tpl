<!doctype html>
<html dir="<?php echo $direction; ?>" class="no-js" lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="view/stylesheet/worksheet.css?v=5">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>
    <?php foreach ($orders as $order) { ?>
    <div class="invoice-container">

        <h1 class="heading cf">
            <img src="view/stylesheet/invoice-assets/logo.png?v=2" alt="thinkwinetrade" width="400" height="271" />
        </h1>

        <div class="brief">
            <div class="inner">
                <h2>
                    ORDER # <?php echo $order['order_id']; ?>
                </h2>
            </div><!-- inner -->
        </div><!-- brief -->

        <div class="cf mb66">
            <?php foreach ($order['pallets'] as $pallet) { ?>
                <table class="invoice-items">
                    <thead>
                        <tr>
                            <th><?php echo $column_pallet_no; ?></th>
                            <th><?php echo $column_product; ?></th>
                            <th><?php echo $column_model; ?></th>
                            <th><?php echo $column_vendor; ?></th>
                            <th><?php echo $column_quantity; ?></th>
                            <th><?php echo $column_price; ?></th>
                            <th class="text-right"><?php echo $column_total; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pallet['products'] as $product) { ?>
                            <tr>
                              <td><?php echo $pallet['pallet_no']; ?></td>
                              <td><?php echo $product['name']; ?></td>
                              <td><?php echo $product['model']; ?></td>
                              <td><?php echo $product['vendor']; ?></td>
                              <td><?php echo $product['quantity']; ?></td>
                              <td><?php echo $product['price']; ?></td>
                              <td class="text-right"><?php echo $product['total']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="cf"></div>

                <div class="sub-totals-table">
                    <table class="totals-table">
                        <tr class="totals-row right">
                            <td><strong><?php echo $pallet['totals']['title']; ?>:</strong></td><td class="totals-row-text"><?php echo $pallet['totals']['text']; ?></td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
        </div>

        <table class="totals-table">
            <?php foreach ($totals as $total) { ?>
                <tr class="totals-row right">
                    <td><strong><?php echo $total['title']; ?>:</strong></td><td class="totals-row-text"><?php echo $total['text']; ?></td>
                </tr>
            <?php } ?>
        </table>

    </div>

    <?php } ?>

</body>
</html>