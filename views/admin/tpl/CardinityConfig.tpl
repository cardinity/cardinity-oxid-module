[{include file="headitem.tpl" title="Cardinity Payment Configuration"}]

<style>
    input[type=text] {
        width:400px;
        height: 22px;
    }
</style>
<div style="padding:20px;">
    <form name="cardinity_configuration" id="cardinity_configuration" action="[{$oViewConf->getSelfLink()}]" method="post">
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="save">
        [{$oViewConf->getHiddenSid()}]

        <div class="cardinityCont">
            <label>[{ oxmultilang ident="CARDINITY__CONSUMER_KEY" }]</label><br/>
            <input type="text" class="editinput" name="cardinityConfig[consumerKey]" value="[{$cardinityConfig.consumerKey}]"/><br/>
            <br/>
            <label>[{ oxmultilang ident="CARDINITY__CONSUMER_SECRET" }]</label><br/>
            <input type="text" class="editinput" name="cardinityConfig[consumerSecret]" value="[{$cardinityConfig.consumerSecret}]"/><br/>
            <input type="submit" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.cardinity_configuration.fnc.value='save'" style="margin:6em 3em; width:80px; height:25px;"/>
        </div>
        <input type="hidden" name="fnc" value="save" />
    </form>
</div>
[{include file="bottomitem.tpl"}]
