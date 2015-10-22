<?php

$this->title                    = Yii::t('app', 'Cart');
$this->params['breadcrumbs'][]  = $this->title;

?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <?= Yii::t('app', 'Your cart') ?>
                <small class="pull-right">Date: 2/10/2014</small>
            </h2>
        </div><!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Qty</th>
                    <th>Product</th>
                    <th>Serial #</th>
                    <th>Description</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Call of Duty</td>
                    <td>455-981-221</td>
                    <td>El snort testosterone trophy driving gloves handsome</td>
                    <td>$64.50</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Need for Speed IV</td>
                    <td>247-925-726</td>
                    <td>Wes Anderson umami biodiesel</td>
                    <td>$50.00</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Monsters DVD</td>
                    <td>735-845-642</td>
                    <td>Terry Richardson helvetica tousled street art master</td>
                    <td>$10.70</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Grown Ups Blue Ray</td>
                    <td>422-568-642</td>
                    <td>Tousled lomo letterpress</td>
                    <td>$25.99</td>
                </tr>
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/visa.png" alt="Visa">
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/mastercard.png" alt="Mastercard">
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/american-express.png" alt="American Express">
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
        </div><!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">Amount Due 2/22/2014</p>
            <div class="table-responsive">
                <table class="table">
                    <tbody><tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                    </tr>
                    <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                    </tr>
                    <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>$265.24</td>
                    </tr>
                    </tbody></table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> <?= Yii::t('app', 'Print'); ?></a>
            <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <?= Yii::t('app', 'Make oreder'); ?></button>
        </div>
    </div>
</section>