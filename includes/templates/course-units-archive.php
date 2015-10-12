<?php

//$course_id			 = do_shortcode( '[get_parent_course_id]' );
//$course_id			 = (int) $course_id;
$progress = do_shortcode( '[course_progress course_id="' . $course_id . '"]' );

do_shortcode( '[course_units_loop]' ); //required for getting unit results

?>

<?php
echo do_shortcode( '[course_unit_archive_submenu]' );
$complete_message = '';
if ( 100 == (int) $progress ) {
	$complete_message = '<div class="unit-archive-course-complete cp-wrap"><i class="fa fa-check-circle"></i> ' . __( 'Course Complete', 'coursepress_base_td' ) . '</div>';
}

?>
<h2><?php _e( 'Course Units', 'coursepress_base_td' );
	echo ' ' . $complete_message; ?></h2>
<div class="units-archive">
	<ul class="units-archive-list">
		<?php if ( have_posts() ) { ?>
			<?php
			while ( have_posts() ) : the_post();

				$draft = get_post_status() !== 'publish';
				$show_draft = $draft && cp_can_see_unit_draft();

				if( $draft && ! $show_draft ) {
					continue;
				}

				$additional_class    = '';
				$additional_li_class = '';
				$unit_id             = get_the_ID();

				$additional_content = '';
				if ( ! Unit::is_unit_available( $unit_id ) ) {
					$additional_class    = 'locked-unit';
					$additional_li_class = 'li-locked-unit';
					$additional_content = '<div class="' . esc_attr( $additional_class ) . '"></div>';
				}

				$unit_progress = do_shortcode( '[course_unit_percent course_id="' . $course_id . '" unit_id="' . $unit_id . '" format="true" style="flat"]' );

				?>
				<li class="<?php echo esc_attr( $additional_li_class ); ?>">
					<?php echo $additional_content; ?>
					<?php echo do_shortcode('[course_unit_title link="yes" last_page="no"]'); ?>
					<?php echo $unit_progress; ?>
					<?php echo do_shortcode( '[module_status format="true" course_id="' . $course_id . '" unit_id="' . $unit_id . '"]' ); ?>
				</li>
			<?php
			endwhile;
		} else {
			?>
			<p class="zero-course-units"><?php _e( "0 units in the course currently. Please check back later.", "cp" ); ?></p>
		<?php
		}
		wp_reset_postdata();
		?>
	</ul>
</div>