{{--
	Template Name: Dashi Template
--}}

@extends('layouts.app-blank')
@section('content')

<link rel="stylesheet" href="<?= get_theme_file_uri() . '/framework/assets/dashi.css'; ?>">

<?php

if ( ! defined( 'ABSPATH' ) ) {
exit;
}
$downloads     = WC()->customer->get_downloadable_products();
$has_downloads = (bool) $downloads;

$product_ids = [];
foreach ($downloads as $download) {
		$ids = $download['product_id'];
		$product_ids[] = $ids;
}

?>
@while(have_posts()) @php the_post() @endphp
	<!-- Header -->
	<header style="background-image:url('{{ the_field('background_mac') }}') ">
	    <div class="conatiner">
	        <div id="navs" class="row">
	            <div class="col-md-8">
	                <div id="navbar">
	                    <?php if( get_field('logo_premast') ): ?>
	                    <a href="<?= the_field('link_logo_premast'); ?>"> <img style="padding-left:60px;"
	                            src="<?php the_field('logo_premast'); ?>" /> </a>
	                    <?php endif; ?>
	                    <?php
											$link = get_field('pricing_btn');
												if( $link ):
											?>
	                    <div class="col" style="margin-left: 50.5rem;">
	                        <?php if( get_field('ppt_logo') ): ?>
	                        <img src="<?php the_field('ppt_logo'); ?>" />
	                        <?php endif; ?>
	                    </div>
	                    <a style="box-shadow: none!important;" id="nav-btn" class="btn btn-danger "
	                        href="<?php echo esc_url( $link ); ?>">Purchase Now for
	                        <?php the_field('pricing_number'); ?></a>

	                    <?php
												endif;
											?>
	                </div>
	            </div>
	        </div>
	    </div>


	    <div class="conatiner" style="width:100%;">
	        <div clas="row">
	            <div class="col-12">
	                <?php if( get_field('logo_premast') ): ?>
	                <a class="logos" href="<?= the_field('link_logo_premast'); ?>"> <img
	                        src="<?php the_field('logo_premast'); ?>" /> </a>
	                <?php endif; ?>
	                <div class="row">
	                    <div class="col-md-6 dashi-head">
	                        <img class="dashi-logo" src="<?php the_field('dashi_logo'); ?>" />
	                        <h3 class="dashi-text"><?php the_field('f_heading'); ?></h3>
	                        @if(is_user_logged_in() && in_array('1013447', $product_ids))
	                        <a style="box-shadow: none!important;" class="btn btn-primary"
	                            href="<?php echo esc_url( $link ); ?>">download now</a>
	                        @else
	                        <p class="subtext"><?php the_field('f_sub_heading'); ?></p>
	                        <p class="pricing"><?php the_field('pricing_text'); ?></p>
	                        <?php
													$link = get_field('pricing_btn');
														if( $link ): 
													?>
	                        <a style="box-shadow: none!important;" class="btn btn-primary "
	                            href="<?php echo esc_url( $link ); ?>">Purchase Now </a>
													<?php 
														endif; 
													?>
	                        @endif
	                        <!-- Button trigger modal -->
	                        <button type="button" class="btn btn-outline-success" data-toggle="modal"
	                            data-target="#exampleModal">
	                            Download Demo
	                        </button>
	                        <!-- Modal -->
	                        <div class="modal fade download-dashi-demo" id="exampleModal" tabindex="-1"
	                            aria-labelledby="exampleModalLabel" aria-hidden="true">
	                            <div class="modal-dialog modal-dialog-centered">
	                                <div class="modal-content">
	                                    <div class="modal-header">
	                                        <h5 class="modal-title" id="exampleModalLabel">Get dashi Demo File For Free
	                                        </h5>
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                            <span aria-hidden="true">&times;</span>
	                                        </button>
	                                    </div>
	                                    <div class="modal-body">
	                                        <?php
																					$form_id = get_field('form_download_demo');
																					if( $form_id ):
																					?>
	                                        <?= do_shortcode( '[gravityform id="'.$form_id['id'].'" name="" title="false" description="false" ajax="true" ]' ); ?>
	                                        <?php endif; ?>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>
	<!-- end Header -->

	<!-- the full access container -->
	<section>
	    <div class="container-fluid pt-5 " style="padding-left:0!important;">
	        <div class="row">
	            <div class="col-md-6">
	                <img class="first-ani" style="width:100%;" src="<?php the_field('sec_ani_img'); ?>" />
	            </div>
	            <div class="col-md-6">
	                <div class="access">
	                    <p class="full"><?php the_field('sec_heading'); ?></p>
	                    <p class="subline"><?php the_field('sec_sub_heading'); ?></p>
	                    <div class="badges">
	                        <div class="first">
	                            <img src="<?php the_field('light_badge'); ?>">
	                        </div>
	                        <div class="second">
	                            <img src="<?php the_field('update_badge'); ?>">
	                        </div>
	                        <div class="third">
	                            <img src="<?php the_field('support_badge'); ?>">
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    </div>
	</section>

	<!-- container that contain animations and counter -->
	<section>
			<div class="conatiner">
					<div class="row p-5">
							<div class="col-md-6">
									<p class="text"><?php the_field('side_text'); ?></p>
									<div class="counter">
											<div class="container">
													<div class="row">
															<div class="col-md-4 col-4">
																	<div class="themes">
																			<p class="counter-count counting">35</p>
																			<div class="vl"></div>
																			<p class="themes-p">Color Theme</p>

																	</div>
															</div>
															<div class="col-md-4 col-4">
																	<div class="icons">
																			<p class="counter-count counting">3000</p>
																			<div class="vl"></div>
																			<p class="icons-p">Vector Icons</p>
																	</div>
															</div>
															<div class="col-md-4 col-4">
																	<div class="characters">
																			<p class="counter-count counting">100</p>
																			<p class="characters-p">Vector Characters</p>
																	</div>
															</div>
													</div>
											</div>
									</div>
							</div>
							<div class="col-md-6">
									<img class="img-fluid" src="<?php the_field('ani_img'); ?>" />
							</div>
					</div>
			</div>
	</section>


	<!-- image bar that should be animated  -->
	<section>
	    <div class="container-fluid">
	        <div class="row justify-content-center">
	            <div class="headline">
	                <p>Save countless hours by <br> using these templates</p>
	            </div>
	            <div class="sheet-breakout">
	                <div class="slides-grid" style="overflow: hidden">
	                    <div class="slides"
	                        style="background-image:url('{{ the_field('slide_image') }}'); height:622px; width: 8000px; background-size:2300; background-repeat:repeat-x;background-position: center left ;  box-shadow: 0 40px 84px #141518; scroll-grid 180s linear infinite; -webkit-animation: scroll-grid 130s linear infinite;">
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- dashboard slide  -->
	        <div class="row justify-content-center p-5">
	            <div class="category">
	                <p class="c-text">Dashboard Categories included</p>
	                <p class="c-sub">Track, analyze and display your data using Dashi bundle for magnificent results</p>
	            </div>
	        </div>
	    </div>
	    <div class="container" style="padding-bottom: 90px;">
	        <div class="slider" id="lightSlider">
	            <?php
						$dashboard_categories = get_field('dashboard_categories');
						foreach ($dashboard_categories as  $value):
						$slide_number = get_field('slide_colors', $value->ID );
						$title = wp_trim_words(get_the_title($value->ID), 3, '...');
						?>
	            <div class="items">
	                <div class="img-top-card">
	                    <img src="<?= Utilities::global_thumbnails($value->ID,'full'); ?>">
	                    <div class="overlay-bg"
	                        style="background-image: url(<?= Utilities::global_thumbnails($value->ID,'full'); ?>);"></div>
	                </div>
	                <p class="models"><a class="text-white" href="<?= get_permalink($value->ID); ?>"><?= $title; ?></a></p>
	                <p class="slidesnum"><?= $slide_number; ?> slides </p>
	            </div>
	            <?php endforeach; ?>
	        </div>
	    </div>
	</section>


		<!-- customize sections  -->
		<section style="background:#202020;">
			<div class="container">
					<div class="row justify-content-center customize-support">
							<div class="custom">
									<p class="custom-head"><?php the_field('cust_headline'); ?></p>
									<p class="custom-sub"><?php the_field('cust_sub'); ?></p>
							</div>
					</div>
					<div class="row" style="padding-bottom:90px; text-align:center; align-items:center;">
							<div class="col-md-3 col-6">
									<img  src="<?php the_field('cust_icon'); ?>">
									<h5 class="icon_title"><?php the_field('icon_title'); ?></h5>
							</div>
							<div class="col-md-3 col-6">
									<img  src="<?php the_field('cust_charts'); ?>">
									<h5 class="chart_title"><?php the_field('chart_title'); ?></h5>
							</div>
							<div id="cc" class="col-md-3 col-6">
									<img src="<?php the_field('cust_setting'); ?>">
									<h5 class="setting_title"><?php the_field('setting_title'); ?></h5>
							</div>
							<div class="col-md-3 col-6">
									<img src="<?php the_field('cust_colors'); ?>">
									<h5 class="color_title"><?php the_field('color_title'); ?></h5>
							</div>
					</div>
			</div>
	</section>

	{{-- new section --}}
	<section class="section-new" style="background-color:#171717;">
		<div  class="container-fluid" class="new-section">
			<div class="row">
				<div class="col-md-6">
					<img class="img-fluid " id="image-preview" style="width:100%;" src="<?php the_field('image_preview'); ?>"/>
					</div>

					<div class="col-md-6 pt-5">
							<div class="headline-section">
							<h3 class="edit"><?php the_field('plus_header'); ?></h3>
							</div>
							<?php
							$image = get_field('puls-sub');
							?>
							<div>
									<img class="plus-logo" src="<?= $image; ?>">
									<h3 class="exclusive-text"><?php the_field('exclusive_text'); ?> </h3>
							</div>
							<?php
							$image = get_field('icon_list');
							// dd($image['url']);
							?>
							<div class="icons_list">
									<img src="<?php the_field('icon_list'); ?>">
							</div>
					</div>
			</div>
		</div>
	</section>

	<!-- carousel and testmonials  -->
	<section>
		<div class="container">
			<div class="row justify-content-center">
					<div class="customers">
							<p class="head-count"><?php the_field('test_headline'); ?></p>
							<p class="sub-test"><?php the_field('test_sub'); ?></p>
					</div>
			</div>

			<div class="row">
				<div class="col-md-8 offset-md-2 col-10 offset-1 mt-5">
					<ol class="carousel-indicators">
							<?php
							$counter =  -1;
							if( have_rows('customers') ):
									while( have_rows('customers') ): the_row();
									$counter++;
							?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?= $counter; ?>" class="<?= ($counter == 0)? 'active':''; ?>"></li>
							<?php
									endwhile;
							endif; ?>
					</ol>
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner mt-4">
							<?php
								$counter = -1;
								if( have_rows('customers') ):
									while( have_rows('customers') ): the_row();
									$counter++;
									?>
									<div class="carousel-item text-center <?= ($counter == 0)? 'active':''; ?>">
											<div class="rating-box">
													<span class="rating-star full-star"></span>
													<span class="rating-star full-star"></span>
													<span class="rating-star full-star"></span>
													<span class="rating-star full-star"></span>
													<span class="rating-star half-star"></span>
											</div>
											<p class="cr-text"><?= the_sub_field('customer_content'); ?></p>
											<p class="cust"><?= the_sub_field('customers_name'); ?></p>
									</div>
									<?php
									endwhile;
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- bundle update section -->
	<section style="background:linear-gradient(247.87deg, #00A3FF -15.32%, rgba(7, 62, 255, 0.8) 87.3%);">
			<div class="container">
					<div class="row justify-content-center pt-5">
							<div class="bundels">
									<p class="bd-head"><?= the_field('timeline_headline'); ?></p>
									<p class="bd-sub"><?= the_field('timeline_subheadline'); ?></p>
							</div>
							<div class="col-12 timeline">


								@if(wp_is_mobile())
									<div class="accordion" id="accordionExample">
										<?php
										$counter = -1;
										if( have_rows('timelines') ):
											while( have_rows('timelines') ): the_row();
												$counter++;
										?>
											<div class="card">
												<div class="card-header" id="headingOne<?= $counter; ?>">
													<h2 class="mb-0">
														<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne<?= $counter; ?>" aria-expanded="true" aria-controls="collapseOne<?= $counter; ?>">
															<?= the_sub_field('headline_item'); ?> <span><?= the_sub_field('date_item'); ?></span>
														</button>
													</h2>
												</div>

												<div id="collapseOne<?= $counter; ?>" class="collapse <?= ($counter == 0)? 'show':''; ?>" aria-labelledby="headingOne<?= $counter; ?>" data-parent="#accordionExample">
													<div class="card-body">
													<h3><?= the_sub_field('headline_item_content'); ?></h3>
													<p><?= the_sub_field('description_item_content'); ?></p>
													</div>
												</div>
											</div>
										<?php
											endwhile;
										endif;
										?>
									</div>
								@else
									<ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
										<?php
											$counter = -1;
											if( have_rows('timelines') ):
												while( have_rows('timelines') ): the_row();
													$counter++;
										?>
											<li class="nav-item <?= ($counter == 0)? 'active':''; ?>">
												<a class="nav-link <?= ($counter == 0)? 'active':''; ?>" id="home-tab<?= $counter; ?>" data-toggle="tab" href="#home<?= $counter; ?>" role="tab" aria-controls="home<?= $counter; ?>" aria-selected="true"><?= the_sub_field('headline_item'); ?> <span><?= the_sub_field('date_item'); ?></span></a>
											</li>
										<?php
												endwhile;
											endif;
										?>
									</ul>
									<div class="tab-content" id="myTabContent">
										<?php
											$counter = -1;
											if( have_rows('timelines') ):
												while( have_rows('timelines') ): the_row();
												$counter++;
										?>
											<div class="tab-pane fade <?= ($counter == 0)? 'show active':''; ?>" id="home<?= $counter; ?>" role="tabpanel" aria-labelledby="home-tab<?= $counter; ?>">
												<div class="col-md-6 col-12 col-content">
														<h3><?= the_sub_field('headline_item_content'); ?></h3>
														<p><?= the_sub_field('description_item_content'); ?></p>
													</div>
											</div>
										<?php
												endwhile;
											endif;
										?>
									</div>

								@endif

							</div>
					</div>
			</div>
	</section>

	<!-- pricing section -->
	<section
			style="background-repeat: no-repeat; align-items:center; background:url('{{ the_field('dot_background') }}'); width:100%; ">
			<div class="container">
					<div class="row justify-content-center pt-5">
							<div class="full-ac text-center">
									<p class="full-head"><?php the_field('headline_text'); ?></p>
									<p class="full-sub"><?php the_field('sub_text'); ?>
									<div class="btn-pr">
											<?php
											$link = get_field('pricing_button');
											if( $link ): ?>
											<a  class="btn btn-primary" style="box-shadow: none!important;"  href="<?php echo esc_url( $link ); ?>">Purchase Now </a>
													<?php endif; ?>
									</div>

							</div>
					</div>
			</div>

			</div>
	</section>

	<section class="footer">
		<div class="container">
			<div class="row align-items-center m-0">
				<a href="{{ the_field('link_logo_footer') }}"><img src="{{ the_field('logo_footer') }}" alt="logo footer"></a>
					<ul class="footer-links">
						<?php
						if( have_rows('mune_footer') ):
							while ( have_rows('mune_footer') ) : the_row();
						?>
						<?php
						$link = get_sub_field('link_mune_footer');
						if( $link ):
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
						<li>
							<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						</li>
						<?php endif; ?>
						<?php
							endwhile;
						endif;
						?>
					</ul>

				<ul class="footer-menu p-0 list-inline">
					<li><?= _e('follow us', 'theme'); ?></li>
					<?php
					if( have_rows('follow_us') ):
						while ( have_rows('follow_us') ) : the_row(); ?>
							<li><a href="<?= the_sub_field('links_social_media'); ?>"><?= the_sub_field('icon_image'); ?></a></li>
					<?php
						endwhile;
					endif;
					?>
				</ul>
			</div>
		</div>
	</section>


	<script>
		jQuery(function ($) {

			$(window).scroll(function () {
				if ($(window).scrollTop() >= 100) {
					$('#navbar').addClass('fixed');
				} else {
					$('#navbar').removeClass('fixed');
				}
			});

			$("#lightSlider").lightSlider({
				item: 5,
					responsive: [{
							breakpoint: 800,
							settings: {
								item: 3,
								slideMove: 1,
								slideMargin: 6,
							}
						},
						{
							breakpoint: 480,
							settings: {
								item: 1,
								slideMove: 1
							}
						}
					]
			});

			$('ul#myTab li.nav-item').on('click', function() {
				$('ul#myTab li').removeClass('active');
				$(this).addClass('active');
				if($( "ul#myTab li:last-child" ).hasClass( "active" )) {
					$('ul#myTab li:first-child').addClass('active');
					$('ul#myTab li:last-child').removeClass('active');
				}
			});
		});
	</script>

@endwhile
@endsection
