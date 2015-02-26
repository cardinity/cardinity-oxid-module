<div style="padding: 10px; border-left: 1px solid #000; border-right: 1px solid #000;">
[{if $paymentType->oxuserpayments__oxpaymentsid->value eq 'cardinity'}]
    [{if $error}]
        <span style="color: #f00">[{$error}]</span><br/>
    [{/if}]
    Cardinity payment status: [{$edit->oxorder__cardinity_status->value}]
    
    [{if $edit->oxorder__cardinity_status->value eq $statusOK}]
        <form name="cardinity_refund" id="cardinity_refund" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="order_overview">
            <input type="hidden" name="fnc" value="cardinityRefund">
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="submit" class="edittext" name="refund" value="Refund" />
        </form>
    [{/if}]
[{/if}]
</div>

[{include file="order_overview.tpl"}]