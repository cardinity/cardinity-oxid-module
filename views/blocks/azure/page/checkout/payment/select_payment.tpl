[{if $sPaymentID == "cardinity"}]
<dl>
    <dt>
    <input id="payment_[{$sPaymentID}]" type="radio" name="paymentid" value="[{$sPaymentID}]" [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]>
    <label for="payment_[{$sPaymentID}]"><b>[{ $paymentmethod->oxpayments__oxdesc->value}]
            [{if $paymentmethod->getPrice()}]
            [{assign var="oPaymentPrice" value=$paymentmethod->getPrice() }]
            [{if $oViewConf->isFunctionalityEnabled('blShowVATForPayCharge') }]
            ([{oxprice price=$oPaymentPrice->getNettoPrice() currency=$currency}] [{ oxmultilang ident="PLUS_VAT" }] [{oxprice price=$oPaymentPrice->getVatValue() currency=$currency }])
            [{else}]
            ([{oxprice price=$oPaymentPrice->getBruttoPrice() currency=$currency}])
            [{/if}]
            [{/if}]

        </b></label>
    </dt>
    <dt>
    <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
        <ul class="form">
            <li>
                <label>Credit card:</label>
                <select name="dynvalue[kktype]">
                    <option value="mcd" selected="">Mastercard</option>
                    <option value="vis">Visa</option>
                </select>
            </li>
            <li>
                <label>Number:</label>
                <input type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[kknumber]" autocomplete="off" value="4111111111111111">
                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">Specify a value for this required field.</span>
                </p>
            </li>
            <li>
                <label>Account holder:</label>
                <input type="text" size="20" class="js-oxValidate js-oxValidate_notEmpty" maxlength="64" name="dynvalue[kkname]" value="Mike Dough">
                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">Specify a value for this required field.</span>
                </p>
                <br>
                <div class="note">If different from billing address.</div>
            </li>
            <li>
                <label>Valid until:</label>
                <select name="dynvalue[kkmonth]">
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option selected="selected">12</option>
                </select>

                &nbsp;/&nbsp;

                <select name="dynvalue[kkyear]">
                    <option>2015</option>
                    <option selected="selected">2016</option>
                    <option>2017</option>
                    <option>2018</option>
                    <option>2019</option>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                </select>
            </li>
            <li>
                <label>CVV2 or CVC2 security code:</label>
                <input type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[kkpruef]" autocomplete="off" value="456">
                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">Specify a value for this required field.</span>
                </p>
                <br>
                <div class="note">This check digit is printed in reverse italic on the back side of your credit card right above the signature panel.</div>
            </li>
        </ul>
        
        [{block name="checkout_payment_longdesc"}]
        [{if $paymentmethod->oxpayments__oxlongdesc->value}]
        <div class="desc">
            [{ $paymentmethod->oxpayments__oxlongdesc->value}]
        </div>
        [{/if}]
        [{/block}]
    </dd>
    </dt>
</dl>
[{else}]
    [{$smarty.block.parent}]
[{/if}]
