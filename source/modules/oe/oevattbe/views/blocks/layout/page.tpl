[{if $oxcmp_basket->showTBECountryChangedError() }]
    [{assign var="sMessage" value="OEVATTBE_RESIDENCE_COUNTRY_CHANGED_MESSAGE"|oxmultilangassign}]
    [{include file="message/success.tpl" statusMessage=$sMessage}]
[{/if}]
[{$smarty.block.parent}]