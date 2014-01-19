<?php get_header() ?>
<div id="main" class="site-main">
    <div id="primary" class="content-area">
        <div id="content" class="site-content home_page_container" role="main">
            <div class="entry-content">
                <div class="hero-unit-area">
                    <?php if ( dynamic_sidebar('home_hero_top') ) : else : endif; ?>
                </div>
                <div class="home_main_widget_container clearfix">
                    <?php if ( dynamic_sidebar('home_main_widget') ) : else : endif; ?>
                </div>
                <div class="hero-unit-area">
                    <?php if ( dynamic_sidebar('home_hero_bottom') ) : else : endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>