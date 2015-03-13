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
                <label>[{oxmultilang ident='cardinity__CCNUMBER'}]:</label>
                <input type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[ccnumber]" autocomplete="off" value="">
                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident='cardinity__REQUIRED_FIELD'}]</span>
                </p>
            </li>
            <li>
                <label>[{oxmultilang ident='cardinity__ACCOUNT_HOLDER'}]:</label>
                <input type="text" size="20" class="js-oxValidate js-oxValidate_notEmpty" maxlength="64" name="dynvalue[ccname]" value="">
                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident='cardinity__REQUIRED_FIELD'}]</span>
                </p>
            </li>
            <li>
                <label>[{oxmultilang ident='cardinity__VALID_UNTIL'}]:</label>
                <select name="dynvalue[ccmonth]" id="cardinity-month">
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
                  <option>12</option>
                </select>

                &nbsp;/&nbsp;

                <select name="dynvalue[ccyear]" id="cardinity-year">
                    [{assign var=year value='Y'|date}]
                    [{section name=years start=0 loop=11 step=1}]
                        <option>[{$year+$smarty.section.years.index}]</option>
                    [{/section}]
                </select>
                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident='cardinity__INVALID_DATE'}]</span>
                </p>
            </li>
            <li>
                <label>[{oxmultilang ident='cardinity__CVV'}]:</label>
                <input type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[ccpruef]" autocomplete="off" value="">
                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident='cardinity__REQUIRED_FIELD'}]</span>
                </p>
                <br>
                <div class="note">[{oxmultilang ident='cardinity__CVV_DESC'}]</div>
            </li>
        </ul>
        
        [{block name="checkout_payment_longdesc"}]
        [{if $paymentmethod->oxpayments__oxlongdesc->value}]
        <div class="desc">
            [{ $paymentmethod->oxpayments__oxlongdesc->value}]
        </div>
        [{/if}]
        [{/block}]
        [{oxscript include=$oViewConf->getModuleUrl('cardinity', 'out/src/js/cardinity.js')}]
    </dd>
    </dt>
</dl>
[{else}]
    [{$smarty.block.parent}]
[{/if}]
