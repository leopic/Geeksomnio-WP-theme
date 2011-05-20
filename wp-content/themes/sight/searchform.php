<div class="search">
    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
        <fieldset>
            <input name="s" type="text" placeholder="<?php if(ICL_LANGUAGE_CODE == "es"){ echo "Buscar"; } else { echo "Search "; }?>" />
            <button type="submit"></button>
        </fieldset>
    </form>
</div>