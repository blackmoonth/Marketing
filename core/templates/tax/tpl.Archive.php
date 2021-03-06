<?php
/**
 * Copyright (c) 2014-2018, yunsheji.cc
 * All right reserved.
 *
 * @since 1.1.0
 * @package Marketing
 * @author 云设计
 * @date 2018/02/14 10:00
 * @link https://yunsheji.cc
 */
?>
<?php tt_get_header(); ?>
<?php $paged = get_query_var('paged') ? : 1; ?>
    <div id="content" class="wrapper">
        <?php $vm = TermPostsVM::getInstance($paged); ?>
        <?php if($vm->isCache && $vm->cacheTime) { ?>
            <!-- Archive posts cached <?php echo $vm->cacheTime; ?> -->
        <?php } ?>
        <?php if($data = $vm->modelData) { $pagination_args = $data->pagination; $term = $data->term; $term_posts = $data->term_posts; ?>
          <?php if (tt_get_option('tt_enable_k_fbsbt', true)) { ?>
            <!-- 归档名及介绍信息(自定义分类等Term) -->
            <section class="billboard term-header">
                <div class="catga-section-info text-center">
                    <h2 class="postmodettitle"><i class="tico tico-price-term"></i> <?php echo $term['name']; ?></h2>
                    <?php if($term['description'] != ''){ ?>
                        <div class="postmode-description"><p><?php printf(__('%d results in total', 'tt'), $data->count); ?></p></div>
                    <?php } ?>
                </div>
            </section>
      <?php } ?>
            <!-- 归档文章 -->
        <div id="postcard-main" class="main primary" role="main">
            <section class="container archive-posts category-posts">
                <div class="row loop-rows posts-loop-grid mt20 mb20 clearfix">

                    <?php foreach ($term_posts as $term_post) { ?>
                        <div class="col-md-3 col-sm-4 col-xs-6">

                            <article id="<?php echo 'post-' . $term_post['ID']; ?>" class="post type-post status-publish wow bounceInUp">
                                <div class="entry-thumb hover-scale">
                                    <a href="<?php echo $term_post['permalink']; ?>">
                                        <img width="250" height="170" src="<?php echo LAZY_PENDING_IMAGE; ?>" data-original="<?php echo $term_post['thumb']; ?>" class="thumb-medium wp-post-image lazy" alt="" style="display: block;" />
                                    </a>
                                    <?php echo $term_post['category']; ?>
                                </div>
                                <div class="entry-detail">
                                    <header class="entry-header">
                                        <h2 class="entry-title h4">
                                            <a href="<?php echo $term_post['permalink']; ?>" rel="bookmark" target="_blank" title="<?php echo $term_post['title']; ?>"><?php echo $term_post['title']; ?></a>
                                        </h2>
                                        <div class="entry-meta entry-meta-1">
                                            <span class="entry-date text-muted"><i class="tico tico-alarm"></i><time class="entry-date" datetime="<?php echo $term_post['time']; ?>"><?php echo $term_post['time']; ?></time></span>
                                            <span class="comments-link text-muted pull-right"><i class="tico tico-comments-o"></i><a href="<?php echo $term_post['permalink'] . '#respond'; ?>" target="_blank"><?php echo $term_post['comment_count']; ?></a></span>
                                            <span class="views-count text-muted pull-right mr10"><i class="tico tico-eye"></i><?php echo $term_post['views']; ?></span>
                                        </div>
                                    </header>
                                </div>
                            </article>

                        </div>
                    <?php } ?>


                </div>

                <?php if($pagination_args['max_num_pages'] > 1) { ?>
                    <?php tt_pagination(str_replace('999999999', '%#%', get_pagenum_link(999999999)), $pagination_args['current_page'], $pagination_args['max_num_pages']); ?>
                <?php } ?>
            </section>
        </div>
        <?php } ?>
    </div>
<?php tt_get_footer(); ?>