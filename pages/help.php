    <br>
    <br>

    <table align="center" class="width50 mantisbt-theme-manager" cellspacing="1">

    <!-- Help -->
        <tr>
            <td>
                <table align="center" class="width100 mantisbt-theme-manager" cellspacing="1">
                    <tr>
                    	<td class="form-title" colspan="3">
                    		<?php echo lang_get( 'plugin_themeManager_help_title' )?>
                    	</td>
                    </tr>

                    <tr>
                    	<td >
                    	    <ol>
                    	    <!-- Create themes folder -->
                    	    	<li>
                    	    	    <?php if (!$error): ?><s><?php endif; ?>

                    	            <?php echo lang_get( 'plugin_themeManager_help_li_1' ) ?>

                    	    	    <?php if (!$error): ?></s><?php endif; ?>

                	                <?php
                                        $passed = $error ? "negative" : "positive";
                                        echo '<span class="' . $passed . '">' . $passed . '</span>';
                    	    	    ?>
                    	    	</li>
                    	    	<li>
                                    <?php echo lang_get( 'plugin_themeManager_help_li_2' ) ?>
                    	    	</li>
                    	    	<li>
                                    <?php echo lang_get( 'plugin_themeManager_help_li_3' ) ?>
                    	    	</li>
                    	    </ol>
                    	</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>