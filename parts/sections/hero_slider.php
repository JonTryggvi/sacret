<?php if(have_rows('hero_slider')): ?>
		<section class="uni_section uni_section__hero slider owl-carousel" role="main" > 
		<?php
			while(have_rows('hero_slider')): the_row();
			$img_obj = get_sub_field('hero_img');
		?>
			<div class="uni_section__hero__row">
				<div class="uni_section__hero__row__left medium-7">
					<div class="uni_section__hero__row__left__box">
						<h1 class="text--pink"><?php the_sub_field('hero_title'); ?></h1>
						<p><?php the_sub_field('hero_text'); ?> </p>
						<?php $hero_link = get_sub_field('hero_link'); if(NULL !== $hero_link) :?>
							<a href="<?php echo $hero_link ?>">nánar</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="uni_section__hero__row__right">
					<picture>
						<source srcset="<?php echo $img_obj['sizes']['medium_large']; ?>" media="(min-width: 600px)">
						<img src="<?php echo$img_obj['sizes']['large']; ?>" alt="">
					</picture>
				</div>
			</div>
	<?php	endwhile; ?>
	</section>
<?php endif; ?>