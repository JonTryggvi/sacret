<?php if(have_rows('hero_slider')): 
		$post_type = get_post_type();
		$set_product_margin = 'product' == $post_type ? 'uni_section--less-margin' : '';
	?>
		<section class="uni_section uni_section__hero slider owl-carousel <?php echo $set_product_margin; ?>" role="main" > 
		<?php
		
			while(have_rows('hero_slider')): the_row();
				$img_obj = get_sub_field('hero_img');
				$side_class = get_sub_field('hero_switch_sides') ? 'right' : '';
				$hero_link = get_sub_field('hero_link'); if(NULL !== $hero_link) :
				$hero_link_text = get_sub_field('hero_link_text') ? get_sub_field('hero_link_text') : 'Nánar';
				$is_add_to_cart = get_sub_field('link_is_add_to_cart') ? get_sub_field('link_is_add_to_cart') : false;
				$sleppa_takka = get_sub_field('sleppa_takka') ? get_sub_field('sleppa_takka') : false;
	
		?>
			<div class="<?php echo $side_class; ?> uni_section__hero__row">
				<div class="uni_section__hero__row__text medium-7">
					<div class="uni_section__hero__row__text__box">
						<h1 class="hero_h1"><?php the_sub_field('hero_title'); ?></h1>
						<?php if(!empty(get_sub_field('hero_text'))) : ?>
							<p><?php the_sub_field('hero_text'); ?> </p>
						<?php endif; ?>
						<?php 
							if(!$sleppa_takka) :
								if($is_add_to_cart) :  $product_id = $post->ID;  ?>
									<a class="btn addToCart" data-product-id="<?php echo $product_id; ?>"><?php echo $hero_link_text;?></a>
								<?php		else :	?>
								<a class="btn" href="<?php echo $hero_link ?>"><?php echo $hero_link_text; ?></a>
						<?php endif; endif; endif; ?>
					</div>
				</div>
				<div class="uni_section__hero__row__image">
					<div class="uni_section__hero__row__image__backdrop-mask"></div>
					<div class="uni_section__hero__row__image__mask">
						<picture>
							<source srcset="<?php echo $img_obj['sizes']['large']; ?>" media="(min-width: 600px)">
							<img src="<?php echo$img_obj['sizes']['large']; ?>" alt="">
						</picture>
					</div>
				</div>
			</div>
	<?php	endwhile; ?>
	</section>
<?php endif; ?>