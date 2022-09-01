[{$smarty.block.parent}]
[{if $oViewConf->isModuleActive('ith_clear_tmp')}]
    <style>
        @keyframes ith_spinner_anim {
            from {
                transform:rotate(0deg);
                color: black;
            }
            50% {
                color: gray;
            }
            to {
                transform: rotate(360deg);
                color: black;
            }
        }
        #ith_clear_tmp_loaded { color: green; font-size: larger; display: none; }
        #ith_clear_tmp_failed { color: red; font-size: larger; display: none; }
        #ith_clear_tmp_spinner { display:none; font-size : larger; animation-name: ith_spinner_anim; animation-duration: 1.5s; animation-iteration-count: infinite; animation-timing-function: linear; }
    </style>
    <li class="sep">
        <a href="#" class="rc" id="clear_tmp"><b>[{oxmultilang ident="ITH_CLEAR_TMP2"}] <span id="ith_clear_tmp_spinner">❖</span> <span id="ith_clear_tmp_loaded"> ✔ </span><span id="ith_clear_tmp_failed"> ✖ </span></b></a>
    </li>
    <script src="[{$oViewConf->getResourceUrl('js/libs/jquery.min.js')}]"></script>
    <script type="application/javascript">
        $('#clear_tmp').bind('click', function (e) {
            try {
                e.preventDefault();
                var url = '[{$oViewConf->getSelfLink()}]cl=ith_clear_tmp_admin&ajax=true';
                url = url.replace(/&amp;/g, '&');
                var $spinner = $('#ith_clear_tmp_spinner').css('display', 'inline-block');
                $.get(url).fail(function (xhr) {
                    $spinner.css('display', 'none');
                    $('#ith_clear_tmp_failed').fadeIn(400).delay(1000).fadeOut(600);
                    var $btn = $('#clear_tmp > b').css('color', 'red');
                    window.setTimeout(function () {
                        $btn.css('color', '')
                    }, 1600);
                    console.error('ITH_CLEAR_TMP: Failed with: ', xhr.responseText);
                    if (xhr.status === 666) {
                        alert('ITH_CLEAR_TMP failed tragically!');
                    }
                }).done(function () {
                    $spinner.css('display', 'none');
                    $('#ith_clear_tmp_loaded').fadeIn(400).delay(1000).fadeOut(600);
                    var $btn = $('#clear_tmp > b').css('color', 'green');
                    window.setTimeout(function () {
                        $btn.css('color', '')
                    }, 1600);
                });
            } catch (e) {
                console.error(e);
            }
        });
    </script>
[{/if}]