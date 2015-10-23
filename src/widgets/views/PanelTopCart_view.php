<?php

use \Yii;
use yii\helpers\Html;

?>
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
    <a  class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-shopping-cart  fa-lg"></i>
        <span class="label label-warning"><?= Yii::$app->cart->getCount(); ?></span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">
            <div class="row">
                <div class="col-md-6 text-bold"><?= Yii::t('app', 'Total:') ?></div>
                <!-- /.col-md-6 -->
                <div class="col-md-6 text-right"><?= Yii::$app->cart->getCost(); ?></div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <li>
                    <a>
                        <i class="fa fa-server text-muted"></i> Start SSD | <span class="labale label-warning">&nbsp;purchase&nbsp;</span>
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-globe text-muted"></i> www.someoddname.com | <span class="labale label-warning">&nbsp;purchase&nbsp;</span>
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-globe text-muted"></i> www.someoddandstupidandlongdomainname.com | <span class="labale label-success">&nbsp;renew&nbsp;</span>
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-server text-muted"></i> OpenVZ Ultra | <span class="labale label-warning">&nbsp;purchase&nbsp;</span>
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-server text-muted"></i> OpenVZ Mega | <span class="labale label-success">&nbsp;renew&nbsp;</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer"><?= Html::a(Yii::t('app', 'View Cart'), '/cart/cart/index'); ?></li>
    </ul>
</li>