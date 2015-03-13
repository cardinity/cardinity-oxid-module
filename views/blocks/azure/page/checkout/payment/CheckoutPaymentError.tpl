[{assign var="iPayError" value=$oView->getPaymentError() }]
[{if $iPayError == -1}]
    <div class="status error">[{ $oView->getPaymentErrorText() }]</div>
[{else}]
    [{$smarty.block.parent}]
[{/if}]
