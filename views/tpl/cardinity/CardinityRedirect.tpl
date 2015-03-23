<label>[{ oxmultilang ident="cardinity__PAYMENT_REDIRECT_MESSAGE" }]</label>

[{if $formAction}]
    <form action="[{$formAction}]" method="post">
        <input type="hidden" name="PaReq" value="[{$data}]" />
        <input type="hidden" name="TermUrl" value="[{$callbackUrl}]" />
        <input type="hidden" name="MD" value="[{$identifier}]" />
        <input type="submit" value="[{oxmultilang ident='cardinity__PAYMENT_REDIRECT_SUBMIT'}]" />
    </form>
    <script type="text/javascript">document.forms[0].submit();</script>
[{/if}]

