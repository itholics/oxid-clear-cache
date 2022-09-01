<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="ith_clear_tmp_admin">
</form>

<div style="display: flex; margin-top: 50px;">
    <form name="myedit" id="myedit" class="ith-oxelastic" action="[{$oViewConf->getSelfLink() }]" method="post" style=" display: block; text-align: center; width: 100%;">
        [{ $oViewConf->getHiddenSid() }]
        <input type="hidden" name="cl" value="ith_clear_tmp_admin">
        <input type="hidden" name="fnc" value="clear">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="editval[oxuser__oxid]" value="[{ $oxid }]">
        <button type="submit">[{oxmultilang ident="CLEAR"}]</button>
    </form>
</div>