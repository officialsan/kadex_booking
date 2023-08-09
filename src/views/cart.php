<?php 
use Kadex\app\Cart;
$cart = (new Cart())->getCart();
$items = $cart['items'];
if(isset($cart['subTotal']) && $cart['subTotal'] > 0 ) {                   ?>
<div class="box_order mobile_fixed">
    <div class="head">
        <h3>Order Summary</h3>
        <a href="#0" class="close_panel_mobile">
            <i class="icon_close"></i>
        </a>
    </div>
    <!-- /head -->
    <div class="main">
        <ul class="clearfix">
            <?php foreach($items as $item) { ?>
            <li>
                <a href="#0" onclick="removeItem(<?= $item['product_id'] ?>,'<?= $action ?>')">
                    <?=$item['quantity']?>x
                        <?= $item['product_name']; ?>
                </a>
                <span>
                    <?= CURRENCY . $item['total_price'] ?>
                </span>
            </li>
            <?php } ?>

        </ul>
        <ul class="clearfix">

            <li class="total">Total
                <span>
                    <?= CURRENCY . $cart['subTotal'] ?>
                </span>
            </li>
        </ul>
        <div class="mb-2">
            <input name="date" id="date" type="date" value="<?= $cart['date']; ?>" class="form-control">
        </div>
        <div class="mb-2">
            <input name="time" type="time" id="time" value="<?= $cart['time']; ?>" class="form-control">
        </div>
        <div class="btn_1_mobile">
            <button class="btn_1 gradient full-width mb_5 order-now text-capitalize" onclick="<?= $action ?>()">
                <?= camelCaseToSpaceSeparated($action) ?>
            </button>
            <div class="text-center">
                <small>No money charged on this steps</small>
            </div>
        </div>
    </div>
</div>
<!-- /box_order -->
<?php } else {?>
<div class="box_order mobile_fixed">
    <div class="head">
        <h3>Order Summary</h3>
        <a href="#0" class="close_panel_mobile">
            <i class="icon_close"></i>
        </a>
    </div>
    <!-- /head -->
    <div class="main">
        <div class="btn_1_mobile">
            <div class="text-center">
                <strong>No item added to cart</strong>
            </div>
        </div>
    </div>
</div>
<!-- /box_order -->
<?php } ?>