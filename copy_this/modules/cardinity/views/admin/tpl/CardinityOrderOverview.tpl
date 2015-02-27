<div style="padding: 10px; border-left: 1px solid #7a7a7a; border-right: 1px solid #7a7a7a;">
[{if $paymentType->oxuserpayments__oxpaymentsid->value eq 'cardinity'}]
    [{if $error}]
        <span style="color: #f00">[{$error}]</span><br/>
    [{/if}]
    [{assign var=status value=$edit->oxorder__cardinity_status->value}]
    [{ oxmultilang ident="CARDINITY__PAYMENT_STATUS" }]: [{ oxmultilang ident="CARDINITY__STATUS_$status" }]
    
    [{if $edit->oxorder__cardinity_status->value eq $statusRefunded}]
        <br/>[{ oxmultilang ident="CARDINITY__REFUND_DATE" }]: [{$edit->oxorder__cardinity_refunded->value }]
    [{/if}]
    [{if $edit->oxorder__cardinity_status->value eq $statusFailed}]
        <br/>[{$paymentResponse.error}]
    [{/if}]
    [{if $edit->oxorder__cardinity_status->value eq $statusOk}]
        <form name="cardinity_refund" id="cardinity_refund" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="order_overview">
            <input type="hidden" name="fnc" value="refund">
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="submit" class="edittext" name="refund" value="[{ oxmultilang ident="CARDINITY__REFUND" }]" onclick="return confirm('[{ oxmultilang ident="CARDINITY__CONFIRM" }]');" />
        </form>
    [{/if}]
[{/if}]
</div>

[{include file="order_overview.tpl"}]