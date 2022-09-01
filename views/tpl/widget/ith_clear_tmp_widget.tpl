[{capture name="ith_clear_tmp"}]
    [{strip}]
        <script type="application/javascript">
            [{if $blHotkey}]
                $(window).on('keyup', function (e) {
                    try {
                        if (e.ctrlKey && e.shiftKey && e.which === 46) {
                            e.preventDefault();
                            $.get('[{$oViewConf->getBaseDir()}]index.php?cl=ith_clear_tmp').fail(function (xhr, content) {
                                console.error('ITH_CLEAR_TMP: Failed with: ' + content);
                                if (xhr.status === 666) {
                                    alert('ITH_CLEAR_TMP failed tragically!');
                                }
                            }).done(function (content) {
                                console.info('ITH_CLEAR_TMP: ' + content);
                                location.reload();
                            });
                        }
                    } catch (e) {
                        console.error(e);
                    }
                });
            [{/if}]
        </script>
    [{/strip}]
[{/capture}]
[{oxscript add=$smarty.capture.ith_clear_tmp|strip_tags}]