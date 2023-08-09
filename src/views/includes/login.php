<!-- Sign In Modal -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="modal_header">
        <h3>Sign In</h3>
    </div>
    <form method="POST" id="login-form" action="<?= APP_URL; ?>/login">

        <div class="sign-in-wrapper">
            <!-- <a href="#0" class="social_bt facebook">Login with Facebook</a>
            <a href="#0" class="social_bt google">Login with Google</a>
            <div class="divider"><span>Or</span></div> -->
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="number" class="form-control" name="phone" id="phone">
                <i class="">+971</i>
            </div>
            <div class="text-center">
                <p class="error" id="login-submit-error"></p>
                <input id="login-submit-btn" type="submit" value="Send Otp" class="btn_1 full-width mb_5">
                <!-- Don’t have an account?
                <a href="<?= APP_URL; ?>/signup">Sign up</a> -->
            </div>
            <div id="forgot_pw">
                <div class="form-group">
                    <label>Please confirm login email below</label>
                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                    <i class="icon_mail_alt"></i>
                </div>
                <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
                <div class="text-center">
                    <input type="submit" value="Reset Password" class="btn_1">
                </div>
            </div>
        </div>
    </form>
    <!--form -->
    <form method="POST" id="otp-form" action="<?= APP_URL; ?>/check-otp" style="display:none">
        <div class="sign-in-wrapper">
            <div class="form-group">
                <label>Enter Otp</label>
                <input type="number" class="form-control" name="otp" id="otp">
                <input type="hidden" class="form-control" name="phone" id="otp-phone">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="text-center">
                <p class="error" id="otp-submit-error"></p>
                <input id="otp-submit-btn" type="submit" value="Submit" class="btn_1 full-width mb_5"> Don’t change phone number?
                <a href="javascript::void(0)" onclick="showLoginPhone()">Click here</a>
            </div>
        </div>
    </form>
    <!--form -->
</div>
<!-- /Sign In Modal -->