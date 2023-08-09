<?php

use Kadex\app\Auth;

$head = '
        <link href="'.APP_URL.'/assets/css/detail-page.css" rel="stylesheet">
        <link href="'.APP_URL.'/assets/css/order-sign_up.css" rel="stylesheet">
';
require_once 'includes/header.php'; 
$user = Auth::user();
?>
    <main class="bg_gray">

        <div class="container margin_60_20">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="box_order_form">
                        <div class="head">
                            <div class="title">
                                <h3>Personal Details</h3>
                            </div>
                        </div>
                        <!-- /head -->
                        <div class="main">
                            <form id="order-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="fname" value="<?= $user->fname; ?>" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="lname" value="<?= $user->lname; ?>" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input class="form-control" name="email" value="<?= $user->email; ?>" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" name="phone" value="<?= $user->phone; ?>" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input class="form-control" name="city" value="<?= $user->city; ?>" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Landmark</label>
                                            <input class="form-control" name="landmark" value="<?= $user->landmark; ?>" placeholder="landmark">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control" name="country">
                                                <option> Select a country</option>
                                                <?php foreach($countries  as $country) { ?>
                                                <option value="<?= $country['id'] ?>" <?php if($country[ 'id']==$user->country) { echo 'selected';} ?>>
                                                    <?= $country['country'] ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" rows="3"><?= nl2br($user->address); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Instructions</label>
                                            <textarea class="form-control" name="instructions" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /box_order_form -->
                    <div class="box_order_form">
                        <div class="head">
                            <div class="title">
                                <h3>Payment Method</h3>
                            </div>
                        </div>
                        <!-- /head -->
                        <div class="main">
                            <div class="payment_select">
                                <label class="container_radio">Credit Card
                                    <input type="radio" value="" checked name="payment_method">
                                    <span class="checkmark"></span>
                                </label>
                                <i class="icon_creditcard"></i>
                            </div>
                            <div class="form-group">
                                <label>Name on card</label>
                                <input type="text" class="form-control" id="name_card_order" name="name_card_order" placeholder="First and last name">
                            </div>
                            <div class="form-group">
                                <label>Card number</label>
                                <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card number">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Expiration date</label>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="mm">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="yyyy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Security code</label>
                                        <div class="row">
                                            <div class="col-md-4 col-6">
                                                <div class="form-group">
                                                    <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <img src="<?= APP_URL ?>/assets/img/icon_ccv.gif" width="50" height="29" alt="ccv">
                                                <small>Last 3 digits</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End row -->
                            <div class="payment_select" id="paypal">
                                <label class="container_radio">Pay with Paypal
                                    <input type="radio" value="" name="payment_method">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="payment_select">
                                <label class="container_radio">Pay with Cash
                                    <input type="radio" value="" name="payment_method">
                                    <span class="checkmark"></span>
                                </label>
                                <i class="icon_wallet"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /box_order_form -->
                </div>
                <!-- /col -->
                <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
                    <?php view('cart',['action'=>'orderSubmit']); ?>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

    </main>


    <?php include 'includes/footer.php';?>

    </body>

    </html>