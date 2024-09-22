<?php
    wp_enqueue_script('ibtana-admin-wizard-script');
?>
<div class="wrap" id="ibtana-admin-wizard-parent">
    <ul class="nav nav-pills mb-3" id="ive-pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#pills-dashboard" type="button" role="tab" aria-controls="pills-dashboard" aria-selected="true"><?php _e('Dashboard', 'ibtana-visual-editor'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-th-templates-tab" data-template-type="wordpress" data-bs-toggle="pill" data-bs-target="#pills-th-templates" type="button" role="tab" aria-controls="pills-th-templates" aria-selected="false"><?php _e('Themes/Templates', 'ibtana-visual-editor'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-wc-templates-tab" data-template-type="woocommerce" data-bs-toggle="pill" data-bs-target="#pills-wc-templates" type="button" role="tab" aria-controls="pills-wc-templates" aria-selected="false"><?php _e('WooCommerce Templates', 'ibtana-visual-editor'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-th-bundle-packages-tab" data-bs-toggle="pill" data-bs-target="#pills-th-bundle-packages" type="button" role="tab" aria-controls="pills-th-bundle-packages" aria-selected="false"><?php _e('Theme Bundle/Packages', 'ibtana-visual-editor'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-settings" type="button" role="tab" aria-controls="pills-settings" aria-selected="false"><?php _e('Settings', 'ibtana-visual-editor'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-saved-templates-tab" data-bs-toggle="pill" data-bs-target="#pills-saved-templates" type="button" role="tab" aria-controls="pills-saved-templates" aria-selected="false"><?php _e('Saved Templates', 'ibtana-visual-editor'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-license-tab" data-bs-toggle="pill" data-bs-target="#pills-license" type="button" role="tab" aria-controls="pills-license" aria-selected="false"><?php _e('License', 'ibtana-visual-editor'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-addons-tab" data-bs-toggle="pill" data-bs-target="#pills-addons" type="button" role="tab" aria-controls="pills-addons" aria-selected="false"><?php _e('Addons', 'ibtana-visual-editor'); ?></button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="pills-dashboard-tab">
            <div class="ive-dashboard-tab-content-wrap">
                <div class="ive-dashboard-tab-content-card-wrap">
                    <div class="ive-dashboard-tab-content-card card-left">
                        <h1 class="ive-dashboard-content-heading card-heading-left"><?php _e('GET 20% OFF ON', 'ibtana-visual-editor'); ?></h1>
                        <p class="ive-dashboard-content-para card-para-left"><?php _e('WORDPRESS THEME BUNDLE', 'ibtana-visual-editor'); ?></p>
                        <p class="ive-dashboard-content-para-second card-para-second-left"><?php _e('Get Access to 240+ Premium WordPress Themes At Just $99', 'ibtana-visual-editor'); ?></p>
                        <a class="ive-dashboard-content-button" href="https://www.vwthemes.com/products/wp-theme-bundle" target="_blank" ><?php _e('BUY NOW', 'ibtana-visual-editor'); ?></a>
                    </div>
                    <div class="ive-dashboard-tab-content-card card-right">
                        <h1 class="ive-dashboard-content-heading card-heading-right"><?php _e('GET 25% OFF ON', 'ibtana-visual-editor'); ?></h1>
                        <p class="ive-dashboard-content-para card-para-right"><?php _e('PREMIUM WORDPRESS THEME', 'ibtana-visual-editor'); ?></p>
                        <p class="ive-dashboard-content-para-second card-para-second-right"><?php _e('Choose From Collection of 440+ Premium WordPress Themes', 'ibtana-visual-editor'); ?></p>
                        <a class="ive-dashboard-content-button" href="https://www.vwthemes.com/collections/premium-wordpress-themes" target="_blank" ><?php _e('BUY NOW', 'ibtana-visual-editor'); ?></a>
                    </div>
                </div>
                <div class="ive-dashboard-tab-content-choose-us-wrap">
                    <h3><?php _e('WHY CHOOSE US?', 'ibtana-visual-editor'); ?></h3>
                    <div class="ive-dashboard-tab-content-choose-us-card-container">
                        <div class="ive-dashboard-tab-content-choose-us-card">
                            <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/tap.svg'); ?>">
                            <?php _e('One Click Demo Importer', 'ibtana-visual-editor'); ?>
                        </div>
                        <div class="ive-dashboard-tab-content-choose-us-card">
                            <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/multiple.svg'); ?>">
                            <?php _e('245+ Themes & 5 Plugins', 'ibtana-visual-editor'); ?>
                        </div>
                        <div class="ive-dashboard-tab-content-choose-us-card">
                            <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/customer-service.svg'); ?>">
                            <?php _e('24/7 Support', 'ibtana-visual-editor'); ?>
                        </div>
                        <div class="ive-dashboard-tab-content-choose-us-card">
                            <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/gear.svg'); ?>">
                            <?php _e('Easy Customization', 'ibtana-visual-editor'); ?>
                        </div>
                        <div class="ive-dashboard-tab-content-choose-us-card">
                            <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/web-plugin.svg'); ?>">
                            <?php _e('Easy Plugins Compatibility', 'ibtana-visual-editor'); ?>
                        </div>
                        <div class="ive-dashboard-tab-content-choose-us-card">
                            <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/layer1.svg'); ?>">
                            <?php _e('Pocket Friendly', 'ibtana-visual-editor'); ?>
                        </div>
                        <div class="ive-dashboard-tab-content-choose-us-card">
                            <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/new-features.svg'); ?>">
                            <?php _e('Premium Plugin Features', 'ibtana-visual-editor'); ?>
                        </div>
                    </div>
                </div>
                <div class="ive-get-started-about">
                  <div class=""><span class="dashicons dashicons-megaphone"></span></div>
                  <div class="">
                    <h3><?php esc_html_e('Welcome to the Ibtana WordPress Website Builder', 'ibtana-visual-editor'); ?></h3>
                    <p>
                        <?php esc_html_e('Thank you for choosing Ibtana WordPress Website Builder - the most advanced kit of gutenberg blocks to build a stunning landing page and internal page attractive than ever before! Ready-to-use Full Demo Websites - Get 3+ of  professionally designed pre-built FREE starter templates built using Gutenberg, Ibtana WordPress Website Builder and the VW Themes. These can be imported in just a few clicks. Tweak them easily and build awesome websites in minutes!', 'ibtana-visual-editor'); ?>
                    </p>
                    <div class="ive-get-started-about-button-box">
                      <a class="redirect-ibtana-templates" href="#">
                          <?php esc_html_e('Know More »', 'ibtana-visual-editor'); ?>
                      </a>
                      <a class="ive-get-started-btn ive-rate-us-btn" target="_blank" rel="noopener" href="https://wordpress.org/support/plugin/ibtana-visual-editor/reviews/?filter=5#new-post">
                          <?php _e('Rate Us', 'ibtana-visual-editor'); ?> &#9733;&#9733;&#9733;&#9733;&#9733;
                      </a>
                  </div>
                </div>
                </div>
                <div class="ive-get-started-about-blocks">
                  <div class=""><span class="dashicons dashicons-smiley"></span></div>
                  <div class="">
                    <h3>
                        <?php esc_html_e('How to use Ibtana WordPress Website Builder', 'ibtana-visual-editor'); ?>
                    </h3>
                    <p>
                        <?php esc_html_e('Ibtana WordPress Website Builder comes with 15+ blocks through which you can easily create your templates using HTML and WordPress knowledge. If you want you can also try our themes package with pre-build landing and internal pages. We have different category light weight themes targeted with category wise landing and internal pages, installed through setup wizard.', 'ibtana-visual-editor'); ?>
                    </p>
                    <p>
                        <?php esc_html_e('Wish to see some real design implementations with these blocks?', 'ibtana-visual-editor'); ?>
                    </p>
                    <a href="#" class="redirect-ibtana-templates">
                        <?php esc_html_e('See Demos »', 'ibtana-visual-editor'); ?>
                    </a>
                </div>
                </div>
                <div class="ive-get-started-sidebar-css-gen">
                  <div class=""><span class="dashicons dashicons-admin-page"></span></div>
                  <div class="">
                    <h4><?php esc_html_e('CSS File Generation', 'ibtana-visual-editor'); ?></h4>
                    <p>
                        <?php esc_html_e('Enabling this option will generate CSS files for Ibtana WordPress Website Builder styling instead of loading the CSS inline on page.', 'ibtana-visual-editor'); ?>
                    </p>
                    <?php
                    $button_disabled = '';
                    if ('disabled' === $this->allow_file_generation && true === $this->has_read_write_perms) {
                        $val                    = 'enabled';
                        $file_generation_string = __('Enable File Generation', 'ibtana-visual-editor');
                    } elseif ('disabled' === $this->allow_file_generation && false === $this->has_read_write_perms) {

                        $val                    = 'disabled';
                        $file_generation_string = __('Inadequate File Permission', 'ibtana-visual-editor');
                        $button_disabled        = 'disabled';
                    } else {
                        $val                    = 'disabled';
                        $file_generation_string = __('Disable File Generation', 'ibtana-visual-editor');
                    }
                    ?>
                    <button class="ive-get-started-btn ive-file-generation" id="ive_file_generation" data-value="<?php echo esc_attr($val); ?>" <?php echo esc_attr($button_disabled); ?>>
                        <?php echo esc_html($file_generation_string); ?>
                    </button>
                  </div>
                </div>
                <div class="ive-get-started-blocks-accordion">
                    <button class="ive-block-accordion-btn">
                        <span class="dashicons dashicons-screenoptions ive-accordion-title-icon"></span>
                        <?php _e('Ibtana Blocks', 'ibtana-visual-editor'); ?>
                        <span class="dashicons dashicons-arrow-down ive-accordion-icon"></span>
                    </button>
                    <div class="panel ive-get-started-block-activation">
                        <?php
                        $ive_block_json	= file_get_contents(IBTANA_PLUGIN_DIR_URL . 'ive-blocks.json');
                        $ive_blocks 		= json_decode($ive_block_json, true);
                        foreach ($ive_blocks['ive_blocks'] as $key => $ive_bock) {

                        ?>
                            <div class="ive-get-started-row">
                                <div class="ive-get-started-col-7 ive-get-started-block-title">
                                    <b><?php esc_html_e($ive_bock['ive_block_title'], 'ibtana-visual-editor'); ?></b>
                                    <p>
                                        <?php esc_html_e($ive_bock['ive_block_text'], 'ibtana-visual-editor'); ?>
                                    </p>
                                </div>
                                <span class="ibtana-block-demo-tooltip">
                                    <a target="_blank" href="<?php echo esc_url($ive_bock['ive_block_demo']) ?>">
                                        <?php _e('View Demo', 'ibtana-visual-editor'); ?>
                                    </a>
                                </span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <button class="ive-block-accordion-btn">
                        <span class="dashicons dashicons-screenoptions ive-accordion-title-icon"></span>
                        <?php _e('Woocommerce Blocks', 'ibtana-visual-editor'); ?>
                        <span class="dashicons dashicons-arrow-down ive-accordion-icon"></span>
                    </button>
                    <div class="panel ive-get-started-block-activation">
                        <?php
                        $ive_block_json = file_get_contents(IBTANA_PLUGIN_DIR_URL . 'ive-blocks.json');
                        $ive_blocks = json_decode($ive_block_json, true);
                        foreach ($ive_blocks['iepa_blocks'] as $key => $ive_bock) {

                        ?>
                            <div class="ive-get-started-row">
                                <div class="ive-get-started-col-7 ive-get-started-block-title">
                                    <b>
                                        <?php esc_html_e($ive_bock['iepa_block_title'], 'ibtana-visual-editor'); ?>
                                    </b>
                                    <p>
                                        <?php esc_html_e($ive_bock['iepa_block_text'], 'ibtana-visual-editor'); ?>
                                    </p>
                                </div>
                                <span class="ibtana-block-demo-tooltip">
                                    <a target="_blank" href="<?php echo esc_url($ive_bock['ive_block_demo']) ?>">
                                        <?php _e('View Demo', 'ibtana-visual-editor'); ?>
                                    </a>
                                </span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-th-templates" role="tabpanel" aria-labelledby="pills-th-templates-tab">
            <?php
                // check if the vw premium theme is activated.
                $ive_is_pro_theme_activated	=	$this->ibtana_visual_editor_is_pro_theme_activated();

                $ive_plugin_data = '';
                $ive_plugin_version = '';
            ?>
            <div class="ive-ibtana-wizard-tabs-button-wrapper d-none">
                <div class="ibtana-button-wrap">
                <a class="active ibtana-free-template-button" data-template-type="wordpress"></a>
                </div>
            </div>
            <div class="ive-plugin-admin-page">

                <?php if ($ive_is_pro_theme_activated) : ?>
                    <div class="notice ive-wizard-notice is-dismissible">
                        <div class="ive-theme_box">
                            <h4>
                              <?php esc_html_e('Look\'s like you\'ve installed our ' . $ive_is_pro_theme_activated['ive_theme_title'] . ' theme. Click Get Started to run the setup wizard.', 'ibtana-visual-editor'); ?>
                            </h4>
                        </div>
                        <div class="ive-notice_button">
                            <a class="button button-primary button-hero" target="_blank" href="<?php echo esc_url($ive_is_pro_theme_activated['ive_theme_wizard_url']); ?>">
                                <?php esc_html_e('Get Started', 'ibtana-visual-editor'); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div id="ive-admin-main-tab-content-wrap-templates">
                    <!-- Wizard Content -->
                    <div class="ive-tab-content-box active ive-admin-main-tab-content1">
                        <div class="wrap">
                            <?php echo '<div class="ive-whizzie-wrap">';
                            // The wizard is a list with only one item visible at a time
                            $steps = $this->ibtana_visual_editor_admin_main_tab_step();
                            echo '<ul class="ive-wizard-content-menu">';
                            foreach ($steps as $step) {
                                $class = 'step step-' . esc_attr($step['id']);
                                echo '<li data-step="' . esc_attr($step['id']) . '" class="' . esc_attr($class) . '" >';
                                if (isset($content['title'])) {
                                    printf(
                                        '<h3 class="ive-wizard-main-title">%s</h3>',
                                        esc_html($step['title'])
                                    );
                                }
                                // $content is split into summary and detail
                                $content = call_user_func(array($this, $step['view']));
                                if (isset($content['summary'])) {
                                    printf(
                                        '<div class="summary">%s</div>',
                                        wp_kses_post($content['summary'])
                                    );
                                }
                                if (isset($content['detail'])) {
                                    // Add a link to see more detail
                                    printf('<div class="wz-require-plugins">');
                                    printf(
                                        '<div class="detail">%s</div>',
                                        $content['detail'] // Need to escape this
                                    );
                                    printf('</div>');
                                }
                                echo '</li>';
                            }
                            echo '</ul>';
                            ?>
                            <?php echo '</div>'; ?>

                        </div>
                    </div>
                </div>


                <div class="ive-plugin-popup">
                    <div class="ive-admin-modal">
                        <button class="ive-close-button">×</button>
                        <div class="ive-demo-step-container">

                            <div class="ive-current-step">

                                <div class="ive-demo-child ive-demo-step ive-demo-step-0 active">
                                    <h2><?php _e('Install Base Theme', 'ibtana-visual-editor'); ?></h2>
                                    <p><?php _e('We strongly recommend to install the base theme.', 'ibtana-visual-editor'); ?></p>
                                    <div class="ive-checkbox-container">
                                        <?php _e('Install Base Theme', 'ibtana-visual-editor'); ?>
                                        <span class="ive-checkbox active">
                                            <svg width="10" height="8" viewBox="0 0 11.2 9.1">
                                                <polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="ive-demo-plugins ive-demo-step ive-demo-step-1">
                                    <h2><?php _e('Install & Activate Plugins', 'ibtana-visual-editor'); ?></h2>
                                    <p>
                                        <?php
                                        _e(
                                            'The following plugins are required for this template in order to work properly. Ignore if already installed.',
                                            'ibtana-visual-editor'
                                        );
                                        ?>
                                    </p>
                                    <div class="ive-checkbox-container activated">
                                        <?php _e('Elementor', 'ibtana-visual-editor'); ?>
                                        <span class="ive-checkbox active">
                                            <svg width="10" height="8" viewBox="0 0 11.2 9.1">
                                                <polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="ive-checkbox-container">
                                        <?php _e('Gutenberg', 'ibtana-visual-editor'); ?>
                                        <span class="ive-checkbox active">
                                            <svg width="10" height="8" viewBox="0 0 11.2 9.1">
                                                <polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="ive-demo-template ive-demo-step ive-demo-step-2">
                                    <h2><?php _e('Import Content', 'ibtana-visual-editor'); ?></h2>
                                    <p><?php _e('This will import the template.', 'ibtana-visual-editor'); ?></p>
                                </div>

                                <div class="ive-demo-install ive-demo-step ive-demo-step-3">
                                    <h2><?php _e('Installing...', 'ibtana-visual-editor'); ?></h2>
                                    <p>
                                        <?php
                                        _e(
                                            "Please be patient and don't refresh this page, the import process may take a while, this also depends on your server.",
                                            'ibtana-visual-editor'
                                        );
                                        ?>
                                    </p>
                                    <div class="ive-progress-info">
                                        <?php _e('Required plugins', 'ibtana-visual-editor'); ?><span>10%</span>
                                    </div>
                                    <div class="ive-installer-progress">
                                        <div></div>
                                    </div>
                                </div>

                            </div>

                            <div class="ive-demo-step-controls">
                                <button class="ive-demo-btn ive-demo-back-btn"><?php _e('Back', 'ibtana-visual-editor'); ?></button>
                                <ul class="ive-steps-pills">
                                    <li class="active"><?php _e('1', 'ibtana-visual-editor'); ?></li>
                                    <li class=""><?php _e('2', 'ibtana-visual-editor'); ?></li>
                                    <li class=""><?php _e('3', 'ibtana-visual-editor'); ?></li>
                                </ul>
                                <button class="ive-demo-btn ive-demo-main-btn"><?php _e('Next', 'ibtana-visual-editor'); ?></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-wc-templates" role="tabpanel" aria-labelledby="pills-wc-templates-tab">
            <div class="ive-ibtana-wizard-tabs-button-wrapper d-none">
                <div class="ibtana-button-wrap">
                <a class="ibtana-free-template-button active" data-template-type="woocommerce"></a>
                </div>
            </div>
            <div class="ive-plugin-admin-page">
                <div id="ive-admin-main-tab-content-wrap-wc-templates">
                    <!-- Wizard Content -->
                    <div class="ive-tab-content-box active ive-admin-main-tab-content1">
                        <div class="wrap">
                            <?php echo '<div class="ive-whizzie-wrap">';
                            // The wizard is a list with only one item visible at a time
                            $steps = $this->ibtana_visual_editor_admin_main_tab_step();
                            echo '<ul class="ive-wizard-content-menu">';
                            foreach ($steps as $step) {
                                $class = 'step step-' . esc_attr($step['id']);
                                echo '<li data-step="' . esc_attr($step['id']) . '" class="' . esc_attr($class) . '" >';
                                if (isset($content['title'])) {
                                    printf(
                                        '<h3 class="ive-wizard-main-title">%s</h3>',
                                        esc_html($step['title'])
                                    );
                                }
                                // $content is split into summary and detail
                                $content = call_user_func(array($this, $step['view']));
                                if (isset($content['summary'])) {
                                    printf(
                                        '<div class="summary">%s</div>',
                                        wp_kses_post($content['summary'])
                                    );
                                }
                                if (isset($content['detail'])) {
                                    // Add a link to see more detail
                                    printf('<div class="wz-require-plugins">');
                                    printf(
                                        '<div class="detail">%s</div>',
                                        $content['detail'] // Need to escape this
                                    );
                                    printf('</div>');
                                }
                                echo '</li>';
                            }
                            echo '</ul>';
                            ?>
                            <?php echo '</div>'; ?>

                        </div>
                    </div>
                </div>


                <div class="ive-plugin-popup">
                    <div class="ive-admin-modal">
                        <button class="ive-close-button">×</button>
                        <div class="ive-demo-step-container">

                            <div class="ive-current-step">

                                <div class="ive-demo-child ive-demo-step ive-demo-step-0 active">
                                    <h2><?php _e('Install Base Theme', 'ibtana-visual-editor'); ?></h2>
                                    <p><?php _e('We strongly recommend to install the base theme.', 'ibtana-visual-editor'); ?></p>
                                    <div class="ive-checkbox-container">
                                        <?php _e('Install Base Theme', 'ibtana-visual-editor'); ?>
                                        <span class="ive-checkbox active">
                                            <svg width="10" height="8" viewBox="0 0 11.2 9.1">
                                                <polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="ive-demo-plugins ive-demo-step ive-demo-step-1">
                                    <h2><?php _e('Install & Activate Plugins', 'ibtana-visual-editor'); ?></h2>
                                    <p>
                                        <?php
                                        _e(
                                            'The following plugins are required for this template in order to work properly. Ignore if already installed.',
                                            'ibtana-visual-editor'
                                        );
                                        ?>
                                    </p>
                                    <div class="ive-checkbox-container activated">
                                        <?php _e('Elementor', 'ibtana-visual-editor'); ?>
                                        <span class="ive-checkbox active">
                                            <svg width="10" height="8" viewBox="0 0 11.2 9.1">
                                                <polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="ive-checkbox-container">
                                        <?php _e('Gutenberg', 'ibtana-visual-editor'); ?>
                                        <span class="ive-checkbox active">
                                            <svg width="10" height="8" viewBox="0 0 11.2 9.1">
                                                <polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="ive-demo-template ive-demo-step ive-demo-step-2">
                                    <h2><?php _e('Import Content', 'ibtana-visual-editor'); ?></h2>
                                    <p><?php _e('This will import the template.', 'ibtana-visual-editor'); ?></p>
                                </div>

                                <div class="ive-demo-install ive-demo-step ive-demo-step-3">
                                    <h2><?php _e('Installing...', 'ibtana-visual-editor'); ?></h2>
                                    <p>
                                        <?php
                                        _e(
                                            "Please be patient and don't refresh this page, the import process may take a while, this also depends on your server.",
                                            'ibtana-visual-editor'
                                        );
                                        ?>
                                    </p>
                                    <div class="ive-progress-info">
                                        <?php _e('Required plugins', 'ibtana-visual-editor'); ?><span>10%</span>
                                    </div>
                                    <div class="ive-installer-progress">
                                        <div></div>
                                    </div>
                                </div>

                            </div>

                            <div class="ive-demo-step-controls">
                                <button class="ive-demo-btn ive-demo-back-btn"><?php _e('Back', 'ibtana-visual-editor'); ?></button>
                                <ul class="ive-steps-pills">
                                    <li class="active"><?php _e('1', 'ibtana-visual-editor'); ?></li>
                                    <li class=""><?php _e('2', 'ibtana-visual-editor'); ?></li>
                                    <li class=""><?php _e('3', 'ibtana-visual-editor'); ?></li>
                                </ul>
                                <button class="ive-demo-btn ive-demo-main-btn"><?php _e('Next', 'ibtana-visual-editor'); ?></button>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
        </div>
        <div class="tab-pane fade" id="pills-th-bundle-packages" role="tabpanel" aria-labelledby="pills-th-bundle-packages-tab">
            <div class="ive-dashboard-tabs-bundle-search">
				<input class="ive-dashboard-tabs-bundle-search-input" type="text" placeholder="Search Bundles Here">
			</div>
            <div class="ive-get-started-sidebar-theme">
                <img src="<?php echo esc_url(IBTANA_PLUGIN_DIR_URL . 'dist/images/bundle-packages.png'); ?>">
                <div class="ive-get-started-sidebar-theme-bundle-box">
                    <p><?php esc_html_e('WordPress Theme bundle'); ?></p>
                    <a href="https://www.vwthemes.com/products/wp-theme-bundle?iva_bundle=true" target="_blank" class="ive-get-started-btn">
                        <?php esc_html_e('Buy Now', 'ibtana-visual-editor'); ?>
                    </a>
				</div>
			</div>
            <div class="ive-dashboard-tabs-bundle-wrap">

            </div>
            <button class="ive-dashboard-tabs-bundle-load-more" data-cursor=""><?php esc_html_e('Load More', 'ibtana-visual-editor'); ?></button>
        </div>
        <div class="tab-pane fade" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab">
            <?php
                wp_enqueue_style('ive-admin-codemirror-css', IBTANA_PLUGIN_DIR_URL . 'dist/assets/codemirror.min.css');
                wp_enqueue_script('ive-admin-codemirror-js', IBTANA_PLUGIN_DIR_URL . 'dist/assets/codemirror.min.js');

                $iepa_key = get_option(str_replace('-', '_', 'ibtana-ecommerce-product-addons') . '_license_key');
                $is_iepa_activated = false;
                if ($iepa_key) {
                    if (isset($iepa_key['license_key']) && isset($iepa_key['license_status'])) {
                        if (($iepa_key['license_key'] != '') && ($iepa_key['license_status'] == 1)) {
                            $is_iepa_activated = true;
                        }
                    }
                }
                $ive_general_settings = get_option('ive_general_settings');
            ?>
            <div class="ive-get-started-container ive-get-started-main-container">

                <div class="ive-get-started-sidebar-css-gen">
                    <h4>
                        <span class="dashicons dashicons-location-alt"></span>
                        <?php esc_html_e('Google API Key', 'ibtana-visual-editor'); ?>
                    </h4>
                    <p>
                        <?php esc_html_e('A Google API key is required to use the Map block without any warning.', 'ibtana-visual-editor'); ?>
                    </p>
                    <span class="ive-google_api_key">
                        <input type="text" name="google_api_key" id="google_api_key" value="<?php echo isset($ive_general_settings['google_api_key']) ? esc_attr($ive_general_settings['google_api_key']) : '' ?>" />
                        <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">
                            <?php esc_html_e('How to create a Google API Key', 'ibtana-visual-editor'); ?>
                        </a>
                    </span>
                </div>

                <div class="ive-get-started-sidebar-css-gen">
                    <h4>
                        <span class="dashicons dashicons-editor-code"></span>
                        <?php esc_html_e('Custom CSS', 'ibtana-visual-editor'); ?>
                    </h4>
                    <?php if (!$is_iepa_activated) : ?>
                        <p>
                            <?php esc_html_e('You need to activate your license to use this feature. To Enable This Feature', 'ibtana-visual-editor'); ?>
                            <a target="_blank" href="<?php echo esc_url(admin_url('admin.php?page=ibtana-visual-editor-addons')); ?>">
                                <?php esc_html_e('Upgrade Pro', 'ibtana-visual-editor'); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    <textarea id="ive-custom-css-code"><?php echo isset($ive_general_settings['ive_custom_css']) ? esc_textarea($ive_general_settings['ive_custom_css']) : ''; ?></textarea>
                </div>

                <div class="ive-get-started-sidebar-css-gen">
                    <h4>
                        <span class="dashicons dashicons-editor-code"></span>
                        <?php esc_html_e('Custom JS', 'ibtana-visual-editor'); ?>
                    </h4>
                    <?php if (!$is_iepa_activated) : ?>
                        <p>
                            <?php esc_html_e('You need to activate your license to use this feature. To Enable This Feature', 'ibtana-visual-editor'); ?>
                            <a target="_blank" href="<?php echo esc_url(admin_url('admin.php?page=ibtana-visual-editor-addons')); ?>">
                                <?php esc_html_e('Upgrade Pro', 'ibtana-visual-editor'); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    <textarea id="ive-custom-jss-code"><?php echo isset($ive_general_settings['ive_custom_js']) ? esc_textarea($ive_general_settings['ive_custom_js']) : ''; ?></textarea>
                </div>

                <div class="ive-save-settings-block">
                    <button type="submit" class="button button-primary pp-primary-button" id="ive-save-general-settings" name="save_settings">
                        <span>
                            <?php esc_html_e('Save', 'ibtana-visual-editor'); ?>
                        </span>
                    </button>
                </div>

                </div>
        </div>
        <div class="tab-pane fade" id="pills-saved-templates" role="tabpanel" aria-labelledby="pills-saved-templates-tab">
            <?php
                include IVE_DIR . 'classes/ive-saved-templates.php';
            ?>
        </div>
        <div class="tab-pane fade" id="pills-license" role="tabpanel" aria-labelledby="pills-license-tab">
            <?php
                $is_addons	= apply_filters('ive_is_add_on_installed', false);
            ?>
            <div class="ive-license-wrapper">
                <h3><?php esc_html_e('License', 'ibtana-visual-editor'); ?></h3>
                <div class="ive_padding_space"></div>
                <div class="ive-license-desc-row">
                    <?php

                    // If no addons installed.
                    if (!$is_addons) {
                        $base_url	= IBTANA_LICENSE_API_ENDPOINT . 'ibtana_license_get_language_strings';
                        $args 		= array(
                            "msg_key"	=>	'no_add_ons_installed_message'
                        );
                        $body			= wp_json_encode($args);
                        $options	= [
                            'timeout'     => 0,
                            'body'        => $body,
                            'headers'     => [
                                'Content-Type' => 'application/json',
                            ],
                        ];
                        $response = wp_remote_post($base_url, $options);

                        if (is_wp_error($response)) {
                            ?>
                            <h4>
                                <?php esc_html_e('No add-ons installed. See available add-ons - ') ?>
                                <a href="https://vwthemes.net/add-ons/" target="_blank">https://vwthemes.net/add-ons/</a>
                                <?php esc_html_e('.') ?>
                            </h4>
                            <?php
                        } else if (($response['response']['code'] === 200) && ($response['response']['message'] === 'OK')) {
                            $response = json_decode($response['body']);
                            $response_status = $response->status;
                            if ($response_status == true) {
                                esc_html_e($response->msg);
                            } else {
                                ?>
                                <h4>
                                    <?php esc_html_e('No add-ons installed. See available add-ons - ') ?>
                                    <a href="https://vwthemes.net/add-ons/" target="_blank">https://vwthemes.net/add-ons/</a>
                                    <?php esc_html_e('.') ?>
                                </h4>
                                <?php
                            }
                        }
                    } else {
                        esc_html_e(
                            'Enter your add-ons license keys here to receive updates for purchased add-ons. If your license key has expired, please renew your license.',
                            'ibtana-visual-editor'
                        );
                    }
                    ?>
                </div>
                <div class="ive-license-cards-row">
                    <?php do_action('ive_addon_license_area'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-addons" role="tabpanel" aria-labelledby="pills-addons-tab">
            <div class="ive-addons-wrapper">

            </div>

            <div class="wrap">
                <h1><?php esc_html_e('Addons', 'ibtana-visual-editor'); ?></h1>
                <div class="wp-list-table widefat ive-addon-cards">

                    <div id="the-ive-addons-list">
                        <?php //$this->ive_addons_page_cards();
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
