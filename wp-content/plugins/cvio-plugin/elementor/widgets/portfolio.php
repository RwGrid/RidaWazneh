<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cvio Portfolio Widget.
 *
 * @since 1.0
 */
class Cvio_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'cvio-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'cvio-plugin' );
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	public function get_categories() {
		return [ 'cvio-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'title_tab',
			[
				'label' => esc_html__( 'Title', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'cvio-plugin' ),
				'default'     => esc_html__( 'Title', 'cvio-plugin' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'cvio-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'  => __( 'H1', 'cvio-plugin' ),
					'h2' => __( 'H2', 'cvio-plugin' ),
					'div' => __( 'DIV', 'cvio-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filters_tab',
			[
				'label' => esc_html__( 'Filters', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Show Filters', 'cvio-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'cvio-plugin' ),
				'label_off' => __( 'Hide', 'cvio-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'	   => esc_html__( 'Layout', 'cvio-plugin' ),
				'type'		=> Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => [
					'classic' => __( 'Classic', 'cvio-plugin' ),
					'masonry'  => __( 'Masonry', 'cvio-plugin' ),
				],
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'cvio-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => __( 'All', 'cvio-plugin' ),
					'categories' => __( 'Categories', 'cvio-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Source', 'cvio-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_portfolio_categories(),
				'condition' => [
		            'source' => 'categories'
		        ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => esc_html__( 'Number of Items', 'cvio-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 8,
				'default'     => 8,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'cvio-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
				'options' => [
					'date'  => __( 'Date', 'cvio-plugin' ),
					'title' => __( 'Title', 'cvio-plugin' ),
					'rand' => __( 'Random', 'cvio-plugin' ),
					'menu_order' => __( 'Order', 'cvio-plugin' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Order', 'cvio-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'  => __( 'ASC', 'cvio-plugin' ),
					'desc' => __( 'DESC', 'cvio-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination_tab',
			[
				'label' => esc_html__( 'Pagination', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'       => esc_html__( 'Pagination Type', 'cvio-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'numbers',
				'options' => [
					'numbers' => __( 'Pagination', 'cvio-plugin' ),
					'button' => __( 'Button', 'cvio-plugin' ),
					'none' => __( 'No', 'cvio-plugin' ),
				],
			]
		);

		$this->add_control(
			'more_btn_txt',
			[
				'label'       => esc_html__( 'Button (title)', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'cvio-plugin' ),
				'default'     => esc_html__( 'All Posts', 'cvio-plugin' ),
				'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->add_control(
			'more_btn_link',
			[
				'label'       => esc_html__( 'Button (link)', 'cvio-plugin' ),
				'type'        => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_styling',
			[
				'label'     => esc_html__( 'Title', 'cvio-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section .titles .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .section .titles .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle_styling',
			[
				'label'     => esc_html__( 'Subtitle', 'cvio-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section .titles .subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .section .titles .subtitle',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Items', 'cvio-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .service-item .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .service-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .service-item .name',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Title Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .service-item .single-post-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .service-item .single-post-text',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_portfolio_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false
		);

		$portfolio_categories = get_categories( $args );

		foreach ( $portfolio_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );

		$paged = isset( $_GET['p-page'] ) ? (int) $_GET['p-page'] : 1;

		$portfolio_qv = get_field( 'portfolio_qv', 'option' );
		$portfolio_hide_desc = get_field( 'portfolio_hide_desc', 'options' );
		$portfolio_hide_single_link = get_field( 'portfolio_hide_single_link', 'options' );

		if ( $settings['source'] == 'all' ) {
			$cat_ids = '';
		} else {
			$cat_ids = $settings['source_categories'];
		}

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$pf_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'portfolio',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		?>

		<!-- Works -->
		<div class="section works">
			<div class="content">

				<?php if ( $settings['title'] ) : ?>
				<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
					<div class="title_inner">
						<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
							<?php echo wp_kses_post( $settings['title'] ); ?>
						</span>
					</div>
				</<?php echo esc_attr( $settings['title_tag'] ); ?>>
				<?php endif; ?>

				<?php if ( $settings['filters'] && $pf_categories ) : ?>
				<!-- filter -->
				<div class="filter-menu content-box">
					<div class="filters">
						<div class="btn-group">
							<label>
								<input type="radio" name="fl_radio" value=".box-item" /><?php echo esc_html__( 'All', 'cvio-plugin' ); ?>
							</label>
						</div>
						<?php foreach ( $pf_categories as $category ) : ?>
						<div class="btn-group">
							<label>
								<input type="radio" name="fl_radio" value=".f-<?php echo esc_attr( $category->slug ); ?>" /><?php echo esc_html( $category->name ); ?>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>

				<?php if ( $q->have_posts() ) : ?>
				<!-- portfolio items -->
				<div class="box-items portfolio-items <?php if( $portfolio_hide_desc ) : ?> portfolio-items__hide-desc<?php endif; ?><?php if ( $settings['layout'] == 'masonry' && $settings['layout'] ) : ?> portfolio-new<?php endif; ?>">
					<?php while ( $q->have_posts() ) : $q->the_post();

						/* post content */
						$current_categories = get_the_terms( get_the_ID(), 'portfolio_categories' );
						$category = '';
						$category_slug = '';
						if ( $current_categories && ! is_wp_error( $current_categories ) ) {
							$arr_keys = array_keys( $current_categories );
							$last_key = end( $arr_keys );
							foreach ( $current_categories as $key => $value ) {
								if ( $key == $last_key ) {
									$category .= $value->name . ' ';
								} else {
									$category .= $value->name . ', ';
								}
								$category_slug .= 'f-' . $value->slug . ' ';
							}
						}
						$id = get_the_ID();
						$title = get_the_title();
						$href = get_the_permalink();

						/*get portfolio type*/
						$type = get_field( 'portfolio_type', $id );
						$popup_url = '#popup-' . $id;
						$popup_class = 'has-popup-media';
						$preview_icon = 'fas fa-plus';
						$btn_text = get_field( 'button_text', $id );
						if(empty($btn_text)){
							$btn_text = esc_html__( 'View Project', 'cvio-plugin' );
						}
						$btn_url = get_field( 'button_url', $id );
						$images = false;
						$popup_link_target = false;

						if ( $type == 2 ) {
							$popup_url = get_the_post_thumbnail_url( $id, 'full' );
							$popup_class = 'has-popup-image';
							$preview_icon = 'fas fa-image';
						} elseif ( $type == 3 ) {
							$popup_url = get_field( 'video_url', $id );
							$popup_class = 'has-popup-video';
							$preview_icon = 'fas fa-video';
						} elseif ( $type == 4 ) {
							$popup_url = get_field( 'music_url', $id );
							$popup_class = 'has-popup-music';
							$preview_icon = 'fas fa-music';
						} elseif ( $type == 5 ) {
							$popup_url = '#gallery-' . $id;
							$popup_class = 'has-popup-gallery';
							$preview_icon = 'fas fa-images';
							$images = get_field( 'gallery', $id );
						} elseif ( $type == 6 ) {
							$popup_url = get_field( 'link_url', $id );
							$popup_link_target = true;
							$popup_class = 'has-popup-link';
							$preview_icon = 'fas fa-link';
						} else { }

					?>
					<div class="box-item <?php echo esc_attr( $category_slug ); ?>">
						<div class="image">
							<?php if ( ($portfolio_qv && $portfolio_hide_single_link) || ($portfolio_qv && !$portfolio_hide_single_link) ) : ?>
							<a href="<?php echo esc_url( $popup_url ); ?>" class="<?php echo esc_attr( $popup_class ); ?> hover-animated"<?php if ( $popup_link_target ) : ?> target="_blank"<?php endif; ?>>
							<?php else : ?>
							<a href="<?php echo esc_url( get_the_permalink( $id ) ); ?>" class="hover-animated"<?php if ( $popup_link_target ) : ?> target="_blank"<?php endif; ?>>
							<?php endif; ?>
								<?php
								if ( $settings['layout'] == 'classic' && $settings['layout'] ) :
									if ( has_post_thumbnail ( $id ) ) :
										echo get_the_post_thumbnail( $id, 'cvio_680x680' );
									endif;
								elseif ( $settings['layout'] == 'masonry' && $settings['layout'] ) :
									if ( has_post_thumbnail ( $id ) ) :
										echo get_the_post_thumbnail( $id, 'cvio_680xAuto' );
									endif;
								endif;
								?>
								<span class="info circle">
									<span class="centrize full-width">
										<span class="vertical-center">
											<i class="icon <?php echo esc_attr( $preview_icon ); ?>"></i>
										</span>
									</span>
								</span>
							</a>
							<?php if( $images ) : ?>
							<div id="gallery-<?php echo esc_attr( $id ); ?>" class="mfp-hide">
								<?php foreach( $images as $image ) : $gallery_img_src = wp_get_attachment_image_src( $image['ID'], 'full' ); ?>
								<a href="<?php echo esc_url( $gallery_img_src[0] ); ?>" title="<?php echo esc_attr( $image['title'] ); ?>"></a>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
						</div>
						<?php if ( ! $portfolio_hide_desc ) : ?>
						<div class="desc">
							<?php if ( $portfolio_hide_single_link ) : ?>
							<a href="<?php echo esc_url( $popup_url ); ?>" class="name <?php echo esc_attr( $popup_class ); ?>"<?php if ( $popup_link_target ) : ?> target="_blank"<?php endif; ?>><?php echo esc_html( $title ); ?></a>
							<?php else : ?>
							<a href="<?php echo esc_url( get_the_permalink( $id ) ); ?>" class="name"<?php if ( $popup_link_target ) : ?> target="_blank"<?php endif; ?>><?php echo esc_html( $title ); ?></a>
							<?php endif; ?>
							<?php if ( $category ) : ?>
							<span class="category"><?php echo esc_html( $category ); ?></span>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<?php if ( $type == 1 ) : ?>
						<div id="popup-<?php echo esc_attr( $id ); ?>" class="popup-box mfp-fade mfp-hide">
							<div class="content">
								<div class="image">
									<?php if ( has_post_thumbnail( $id ) ) :
										echo get_the_post_thumbnail( $id, 'cvio_680x680' );
									endif; ?>
								</div>
								<div class="desc single-post-text">
									<?php if ( $category ) : ?>
									<div class="category"><?php echo esc_html( $category ); ?></div>
									<?php endif; ?>
									<h4><?php echo esc_html( $title ); ?></h4>
									<?php echo apply_filters( 'the_content', get_post_field( 'post_content', $id ) ); ?>
									<?php if ( $btn_url || $btn_text ) : ?>
									<a href="<?php echo esc_url( $btn_url ); ?>" target="_blank" class="btn hover-animated">
										<span class="circle"></span>
										<span class="lnk">
											<?php
											if ( $btn_text && $btn_text != '' ) {
												echo esc_html( $btn_text );
											} else {
												echo esc_html__( 'View Project', 'cvio' );
											}
											?>
										</span>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>

					</div>
					<?php endwhile; ?>
				</div>


				<?php if ( $settings['pagination'] == 'numbers' ) : ?>
				<div class="pager">
					<?php
						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'format' => '?p-page=%#%',
							'current' => max( 1, $paged ),
							'total' => $q->max_num_pages,
							'prev_text' => esc_html__( 'Prev', 'ryancv-plugin' ),
							'next_text' => esc_html__( 'Next', 'ryancv-plugin' ),
							'show_all'     => false,
							'end_size'     => 1,
							'mid_size'     => 1,
							'prev_next'    => true,
							'add_args'     => false,
						) );
					?>
				</div>
				<?php endif; ?>
				<?php if ( $settings['pagination'] == 'button' ) : ?>
				<div class="bts bts-center">
					<a class="btn hover-animated" href="<?php echo esc_url( $settings['more_btn_link']['url'] ); ?>"<?php if ( $settings['more_btn_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_btn_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?>>
						<span class="circle"></span>
						<span class="lnk"><?php echo esc_html( $settings['more_btn_txt'] ); ?></span>
					</a>
				</div>
				<?php endif; ?>

				<?php else : get_template_part( 'template-parts/content', 'none' ); endif; wp_reset_postdata(); ?>

			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Cvio_Portfolio_Widget() );
