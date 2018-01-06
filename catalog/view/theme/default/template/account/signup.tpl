<?php echo $signup_header;//$header;  ?>
<div class="account-wrapper" style="width: 80%">
    <div class="account-logo">
        <img src="admin/view/image/icon_logo.png" alt="Signup Vendor">
    </div>

    <div id="content" class="account-body">
        <h3 class="account-body-title"><?php echo $heading_title; ?></h3>
        <h5 class="account-body-subtitle"><?php echo $text_account_already; ?></h5>

        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
        <?php } ?>
        <div class="row">
        <div class="col-md-6">
            <?php
            if(isset($information_heading_title)){
                ?>
                <form id="account_info" class="form account-form">
                    <legend><?php echo $information_heading_title; ?></legend>
                    <p><?php echo $information_description; ?></p>
                </form>
                <?php
            }
            ?>
        </div>
        <div class="col-md-6">
        <form class="form account-form"  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

            <fieldset id="account">
                <legend><?php echo $text_your_details; ?></legend>
                <div class="form-group required">
                    <label for="input-username" class="placeholder-hidden"><?php echo $entry_username; ?></label>
                    </span><input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" tabindex="1">
                    <?php if ($error_username) { ?>
                    <div class="text-danger"><?php echo $error_username; ?></div>
                    <?php } ?>
                </div>

                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-firstname"><?php echo $entry_firstname; ?></label>
                    <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
                    <?php if ($error_firstname) { ?>
                    <div class="text-danger"><?php echo $error_firstname; ?></div>
                    <?php } ?>
                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-lastname"><?php echo $entry_lastname; ?></label>

                    <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
                    <?php if ($error_lastname) { ?>
                    <div class="text-danger"><?php echo $error_lastname; ?></div>
                    <?php } ?>
                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-email"><?php echo $entry_email; ?></label>

                    <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                    <?php if ($error_email) { ?>
                    <div class="text-danger"><?php echo $error_email; ?></div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-bank-name"><?php echo $entry_bank_name; ?></label>
                    <input type="text" name="bank_name" value="<?php echo $bank_name; ?>" placeholder="<?php echo $entry_bank_name; ?>" id="input-bank-name" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-iban"><?php echo $entry_iban; ?></label>
                    <input type="text" name="iban" value="<?php echo $iban; ?>" placeholder="<?php echo $entry_iban; ?>" id="input-iban" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-swift-bic"><?php echo $entry_swift_bic; ?></label>

                    <input type="text" name="swift_bic" value="<?php echo $swift_bic; ?>" placeholder="<?php echo $entry_swift_bic; ?>" id="input-swift-bic" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-tax-id"><?php echo $entry_tax_id; ?></label>

                    <input type="text" name="tax_id" value="<?php echo $tax_id; ?>" placeholder="<?php echo $entry_tax_id; ?>" id="input-tax-id" class="form-control" />

                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-bank-address"><?php echo $entry_bank_address; ?></label>

                    <input type="text" name="bank_address" value="<?php echo $bank_address; ?>" placeholder="<?php echo $entry_bank_address; ?>" id="input-bank-address" class="form-control" />
                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-paypal"><span data-toggle="tooltip" title="<?php echo $help_paypal; ?>"><?php echo $entry_paypal; ?></span></label>

                    <input type="email" name="paypal" value="<?php echo $paypal; ?>" placeholder="<?php echo $entry_paypal; ?>" id="input-paypal" class="form-control" />
                    <?php if ($error_paypal) { ?>
                    <div class="text-danger"><?php echo $error_paypal; ?></div>
                    <?php } ?>

                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-telephone"><?php echo $entry_telephone; ?></label>

                    <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
                    <?php if ($error_telephone) { ?>
                    <div class="text-danger"><?php echo $error_telephone; ?></div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-fax"><?php echo $entry_fax; ?></label>
                    <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
                </div>
            </fieldset>

            <fieldset id="address">
                <legend><?php echo $text_your_address; ?></legend>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-company"><?php echo $entry_company; ?></label>

                        <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company" class="form-control" />
                        <?php if ($error_company) { ?>
                        <div class="text-danger"><?php echo $error_company; ?></div>
                        <?php } ?>

                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-company-id"><?php echo $entry_company_id; ?></label>

                        <input type="text" name="company_id" value="<?php echo $company_id; ?>" placeholder="<?php echo $entry_company_id; ?>" id="input-company-id" class="form-control" />
                        <?php if ($error_company_id) { ?>
                        <div class="text-danger"><?php echo $error_company_id; ?></div>
                        <?php } ?>
                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-address-1"><?php echo $entry_address_1; ?></label>

                        <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1" class="form-control" />
                        <?php if ($error_address_1) { ?>
                        <div class="text-danger"><?php echo $error_address_1; ?></div>
                        <?php } ?>

                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-address-2"><?php echo $entry_address_2; ?></label>

                        <input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2" class="form-control" />

                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-city"><?php echo $entry_city; ?></label>

                        <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
                        <?php if ($error_city) { ?>
                        <div class="text-danger"><?php echo $error_city; ?></div>
                        <?php } ?>

                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-postcode"><?php echo $entry_postcode; ?></label>

                        <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
                        <?php if ($error_postcode) { ?>
                        <div class="text-danger"><?php echo $error_postcode; ?></div>
                        <?php } ?>

                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-country"><?php echo $entry_country; ?></label>

                    <select name="country_id" id="input-country" onchange="$('select[name=\'zone_id\']').load('index.php?route=account/signup/zone&country_id=' + this.value + '&zone_id=<?php echo $zone_id; ?>');" class="form-control">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($countries as $country) { ?>
                        <?php if ($country['country_id'] == $country_id) { ?>
                        <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if ($error_country) { ?>
                    <div class="text-danger"><?php echo $error_country; ?></div>
                    <?php } ?>

                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-zone"><?php echo $entry_zone; ?></label>

                        <select name="zone_id" id="input-zone" class="form-control">
                        </select>
                        <?php if ($error_zone) { ?>
                        <div class="text-danger"><?php echo $error_zone; ?></div>
                        <?php } ?>

                </div>
                <?php if ($mvd_signup_show_plan) { ?>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-singup-plan"><?php echo $entry_plan; ?></label>

                        <select name="singup_plan" id="singup_plan" class="form-control">
                            <?php foreach ($singup_plans as $singup_plan) { ?>
                            <?php if ($singup_plan['commission_id'] != '1') { ?>
                            <option value="<?php echo $singup_plan['commission_id']; ?>:<?php echo $singup_plan['commission_type']; ?>:<?php echo $singup_plan['product_limit_id']; ?>:<?php echo $singup_plan['duration']; ?>:<?php echo $singup_plan['commission']; ?>"><?php if ($singup_plan['commission_type'] == '0') { ?><?php echo $singup_plan['commission_text']; ?></option>
                            <?php } elseif ($singup_plan['commission_type'] == '1') { ?><?php echo $singup_plan['commission_text']; ?></option>
                            <?php } elseif ($singup_plan['commission_type'] == '2') { ?><?php echo $singup_plan['commission_text']; ?></option>
                            <?php } elseif ($singup_plan['commission_type'] == '3') { ?><?php echo $singup_plan['commission_text']; ?></option>
                            <?php } elseif ($singup_plan['commission_type'] == '4') { ?><?php echo $singup_plan['commission_text']; ?></option>
                            <?php } elseif ($singup_plan['commission_type'] == '5') { ?><?php echo $singup_plan['commission_text']; ?></option>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?><input type="hidden" name="hsignup_plan" id="hsignup_plan" value="" />
                        </select>

                </div>
                <?php if ($mvd_paypal_status && $mvd_bank_status) { ?>
                <div class="form-group">
                    <label class="placeholder-hidden"><?php echo $entry_payment_method; ?></label>

                        <label class="radio-inline">
                            <input type="radio" name="payment_method" value="1" checked="checked" /><?php echo $text_paypal; ?></label>
                        <label class="radio-inline">
                            <input type="radio" name="payment_method" value="0" /><?php echo $text_bank; ?></label>

                </div>
                <?php } elseif ($mvd_paypal_status && !$mvd_bank_status) { ?>
                <input type="hidden" name="payment_method" value="1" />
                <?php } elseif (!$mvd_paypal_status && $mvd_bank_status) { ?>
                <input type="hidden" name="payment_method" value="0" />
                <?php } else { ?>
                <input type="hidden" name="payment_method" value="<?php echo $mvd_signup_default_payment_method; ?>" />
                <?php } ?>
                <?php } else { ?>
                <input type="hidden" name="singup_plan" value="<?php echo $default_commission; ?>" />
                <input type="hidden" name="hsignup_plan" id="hsignup_plan" value="<?php echo $hsignup_plan; ?>" />
                <input type="hidden" name="payment_method" value="<?php echo $mvd_signup_default_payment_method; ?>" />
                <?php } ?>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-store-url"><?php echo $entry_store_url; ?></label>

                        <input type="text" name="store_url" value="<?php echo $store_url; ?>" placeholder="<?php echo $entry_store_url; ?>" id="input-store-url" class="form-control" />

                </div>
                <div class="form-group">
                    <label class="placeholder-hidden" for="input-store-description"><?php echo $entry_store_description; ?></label>
                    <textarea name="store_description" rows="5" placeholder="<?php echo $entry_store_description; ?>" class="form-control"><?php echo $store_description; ?></textarea>

                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo $text_your_password; ?></legend>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-password"><?php echo $entry_password; ?></label>

                    <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                    <?php if ($error_password) { ?>
                    <div class="text-danger"><?php echo $error_password; ?></div>
                    <?php } ?>

                </div>
                <div class="form-group required">
                    <label class="placeholder-hidden" for="input-confirm"><?php echo $entry_confirm; ?></label>

                    <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
                    <?php if ($error_confirm) { ?>
                    <div class="text-danger"><?php echo $error_confirm; ?></div>
                    <?php } ?>

                </div>
            </fieldset>

            <?php if ($text_agree) { ?>
            <div class="form-group">
                <label class="checkbox-inline">
                    <?php if ($agree) { ?>
                    <input type="checkbox" name="agree" value="1" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="agree" value="1" />
                    <?php } ?>
                    &nbsp;
                    <?php echo $text_agree; ?>
                </label>
            </div> <!-- /.form-group -->
            <?php } ?>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-block btn-lg" tabindex="6">
                    <?php echo $button_sign_up; ?> &nbsp; <i class="fa fa-play-circle"></i>
                </button>
            </div> <!-- /.form-group -->

        </form>
        </div>
        </div>

    </div> <!-- /.account-body -->

    <!--<div class="account-footer">
        <p>
            Already have an account? &nbsp;
            <a href="<?php echo HTTP_SERVER . 'admin' ?>" class="">Login to your Account!</a>
        </p>
    </div> <!-- /.account-footer -->

</div>

<?php if ($mvd_signup_show_plan) { ?>
<script type="text/javascript"><!--
$("#hsignup_plan").val($("#singup_plan option:selected").text());
$('select[name=\'singup_plan\']').change(function () { 
$("#hsignup_plan").val($("#singup_plan option:selected").text());
});
//--></script>
<?php } ?>

<script type="text/javascript"><!--
$('select[name=\'zone_id\']').load('index.php?route=account/signup/zone&country_id=<?php echo $country_id; ?>&zone_id=<?php echo $zone_id; ?>');
//--></script>

<script type="text/javascript"><!--
    $(document).ready(function() {
        $('.text-danger').each(function() {
            var element = $(this).parent();

            if (element.hasClass('form-group')) {
                element.addClass('has-error');
            }
        });

        $('.form-group.required').append("<span class='note-required'>*</span>");//
    });
    //--></script>
<footer id="footer">Thinkwinetrade.com 2015</div>
    </body></html>