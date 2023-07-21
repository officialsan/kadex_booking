<div id="modal-dialog" class="zoom-anim-dialog">
    <div class="small-dialog-header">
        <h3>
            <?= $service->service ?>
        </h3>
    </div>
    <div class="content">
        <h5>Hours</h5>
        <div class="numbers-row">
            <input type="text" value="1" id="qty_1" class="qty2 form-control" name="hours">
        </div>
        <h5>Size</h5>
        <ul class="clearfix">
            <li>
                <label class="container_radio">Medium
                    <span>+ $3.30</span>
                    <input type="radio" value="option1" name="options_1">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_radio">Large
                    <span>+ $5.30</span>
                    <input type="radio" value="option2" name="options_1">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_radio">Extra Large
                    <span>+ $8.30</span>
                    <input type="radio" value="option3" name="options_1">
                    <span class="checkmark"></span>
                </label>
            </li>
        </ul>
        <h5>Extra Ingredients</h5>
        <ul class="clearfix">
            <li>
                <label class="container_check">Extra Tomato
                    <span>+ $4.30</span>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_check">Extra Peppers
                    <span>+ $2.50</span>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_check">Extra Ham
                    <span>+ $4.30</span>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </li>
        </ul>
    </div>
    <div class="footer">
        <div class="row small-gutters">
            <div class="col-md-4">
                <button type="reset" class="btn_1 outline full-width mb-mobile">Cancel</button>
            </div>
            <div class="col-md-8">
                <button type="reset" class="btn_1 full-width">Add to cart</button>
            </div>
        </div>
        <!-- /Row -->
    </div>
</div>