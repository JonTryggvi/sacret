<?php
$slide_count = is_array(get_sub_field('hero_slider')) ? count(get_sub_field('hero_slider')) : 1;
if(have_rows('hero_slider')):

		$post_type = get_post_type();
		$set_product_margin = 'product' == $post_type ? 'uni_section--less-margin' : '';

	?>
		<section class="uni_section uni_section__hero slider owl-carousel <?php echo $set_product_margin; ?>" role="main" data-slide_count="<?php echo $slide_count; ?>" data-section_order="<?php echo $i ?>">
		<?php

			while(have_rows('hero_slider')): the_row();
				$img_position = get_sub_field('header_img_position') ? get_sub_field('header_img_position') : '50';
				$img_obj = get_sub_field('hero_img');
				$side_class = get_sub_field('hero_switch_sides') ? 'right' : '';
				$hero_link = get_sub_field('hero_link');
				$hero_link_text = get_sub_field('hero_link_text') ? get_sub_field('hero_link_text') : 'Nánar';
				$is_add_to_cart = get_sub_field('link_is_add_to_cart') ? get_sub_field('link_is_add_to_cart') : false;
				$sleppa_takka = get_sub_field('sleppa_takka') ? get_sub_field('sleppa_takka') : false;
		?>

			<div class="<?php echo $side_class; ?> uni_section__hero__row">
				<div class="uni_section__hero__row__text medium-7">
					<div class="uni_section__hero__row__text__box">
						<h1 class="hero_h1 stagger "><?php the_sub_field('hero_title'); ?></h1>
						<?php if(!empty(get_sub_field('hero_text'))) : ?>
							<p class="hero_p stagger"><?php the_sub_field('hero_text'); ?> </p>
						<?php endif; ?>
						<?php
							if(!$sleppa_takka) :
								if($is_add_to_cart) :
									$product_id = $post->ID;
									$add_to_cart_link = "/?add-to-cart=$product_id&quantity=1";
									$product = wc_get_product($product_id);
									$price = wc_price($product->get_price());
								?>
									<div>
										<a href="<?php echo $add_to_cart_link; ?>" class="btn addToCart staggerBtn" data-product-id="<?php echo $product_id; ?>"><?php echo $hero_link_text.' ' ;?></a>
										<span class="stagger"><?php echo $price; ?></span>

									</div>
								<?php		else :	?>
								<a class="btn staggerBtn" href="<?php echo $hero_link ?>"><?php echo $hero_link_text; ?></a>
						<?php endif; endif; ?>
					</div>
				</div>
				<div class="uni_section__hero__row__image stagger">
					<div class="uni_section__hero__row__image__backdrop-mask"></div>
					<div class="uni_section__hero__row__image__mask stagger">
						<picture>
							<source srcset="<?php echo $img_obj['sizes']['large']; ?>" media="(min-width: 600px)">
							<img  src="<?php echo $img_obj['sizes']['large']; ?>" alt="" style="object-position: <?php echo "50% $img_position%" ?>">
						</picture>
					</div>
				</div>
			</div>


	<?php 	endwhile; ?>
	</section>
<?php endif; ?>