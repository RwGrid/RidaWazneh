<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cvio Started Widget.
 *
 * @since 1.0
 */
class Cvio_Started_Section_Widget extends Widget_Base {

	public function get_name() {
		return 'cvio-started-section';
	}

	public function get_title() {
		return esc_html__( 'Started Section', 'cvio-plugin' );
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
			'layout_tab',
			[
				'label' => esc_html__( 'Layout Version', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'	   => esc_html__( 'Layout', 'cvio-plugin' ),
				'type'		=> Controls_Manager::SELECT,
				'default' => 'personal',
				'options' => [
					'personal' => __( 'Personal', 'cvio-plugin' ),
					'classic'  => __( 'Classic', 'cvio-plugin' ),
					'creative'  => __( 'Creative', 'cvio-plugin' ),
					'default'  => __( 'Default', 'cvio-plugin' ),
				],
			]
		);

		$this->add_control(
			'personal_image',
			[
				'label' => esc_html__( 'Personal Image', 'cvio-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => ['layout' => 'personal'],
			]
		);

		$this->end_controls_section();

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
				'label'	   => esc_html__( 'Title', 'cvio-plugin' ),
				'type'		=> Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'cvio-plugin' ),
				'default'	 => esc_html__( 'Title', 'cvio-plugin' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'	   => esc_html__( 'Title Tag', 'cvio-plugin' ),
				'type'		=> Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'  => __( 'H1', 'cvio-plugin' ),
					'h2' => __( 'H2', 'cvio-plugin' ),
					'div' => __( 'DIV', 'cvio-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitles_tab',
			[
				'label' => esc_html__( 'Subtitle', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'under_title',
			[
				'label'	   => esc_html__( 'Show under title', 'cvio-plugin' ),
				'type'		=> Controls_Manager::SELECT,
				'default' => 'subtitles',
				'options' => [
					'subtitles'  => __( 'Subtitles', 'cvio-plugin' ),
					'breadcrumbs' => __( 'Breadcrumbs', 'cvio-plugin' ),
					'hide' => __( 'Hide', 'cvio-plugin' ),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'subtitle', [
				'label'	   => esc_html__( 'Subtitle', 'cvio-plugin' ),
				'type'		=> Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter subtitle', 'cvio-plugin' ),
			]
		);

		$this->add_control(
			'subtitles',
			[
				'label' => esc_html__( 'Subtitle Strings', 'cvio-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ subtitle }}}',
				'condition' => ['under_title' => 'subtitles']
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'background_tab',
			[
				'label' => esc_html__( 'Background', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'texture',
			[
				'label' => esc_html__( 'Background Grained', 'cvio-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'cvio-plugin' ),
				'label_off' => __( 'Off', 'cvio-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'bg',
			[
				'label' => esc_html__( 'Background', 'cvio-plugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  => esc_html__( 'None', 'cvio-plugin' ),
					'image'  => esc_html__( 'Image', 'cvio-plugin' ),
					'video' => esc_html__( 'Video', 'cvio-plugin' ),
					'color' => esc_html__( 'Color', 'cvio-plugin' ),
					'slideshow' => esc_html__( 'Slideshow', 'cvio-plugin' ),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'cvio-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => ['bg' => 'image']
			]
		);

		$this->add_control(
			'image_color',
			[
				'label'	 => esc_html__( 'Image Ovarlay', 'cvio-plugin' ),
				'type'	  => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .video-bg-mask' => 'background-color: {{VALUE}};',
				],
				'condition' => ['bg' => 'image']
			]
		);

		$this->add_control(
			'video',
			[
				'label' => esc_html__( 'Video Link', 'cvio-plugin' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => false,
				'condition' => ['bg' => 'video']
			]
		);

		$this->add_control(
			'video_mute',
			[
				'label' => esc_html__( 'Mute', 'cvio-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'cvio-plugin' ),
				'label_off' => __( 'Off', 'cvio-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['bg' => 'video']
			]
		);

		$this->add_control(
			'video_color',
			[
				'label'	 => esc_html__( 'Video Ovarlay', 'cvio-plugin' ),
				'type'	  => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .video-bg-mask' => 'background-color: {{VALUE}};',
				],
				'condition' => ['bg' => 'video']
			]
		);

		$this->add_control(
			'color',
			[
				'label'	 => esc_html__( 'Background Color', 'cvio-plugin' ),
				'type'	  => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .video-bg' => 'background-color: {{VALUE}};',
				],
				'condition' => ['bg' => 'color']
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Choose Image', 'cvio-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'slideshow_items',
			[
				'label' => esc_html__( 'Slideshow Images', 'cvio-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'condition' => ['bg' => 'slideshow']
			]
		);

		$this->add_control(
			'slideshow_color',
			[
				'label'	 => esc_html__( 'Slideshow Ovarlay', 'cvio-plugin' ),
				'type'	  => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .video-bg-mask' => 'background-color: {{VALUE}};',
				],
				'condition' => ['bg' => 'slideshow']
			]
		);

		$this->add_control(
			'slideshow_autoplay',
			[
				'label'       => esc_html__( 'Slideshow Autoplay Speed', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '5000', 'cvio-plugin' ),
				'default'	=> esc_html__( '5000', 'cvio-plugin' ),
				'condition' => ['bg' => 'slideshow']
			]
		);

		$this->add_control(
			'navs',
			[
				'label' => esc_html__( 'Slideshow Navigation', 'cvio-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'cvio-plugin' ),
				'label_off' => __( 'Off', 'cvio-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['bg' => 'slideshow']
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_styling',
			[
				'label'	 => esc_html__( 'Title', 'cvio-plugin' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'	 => esc_html__( 'Color', 'cvio-plugin' ),
				'type'	  => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.started .h-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'	 => 'title_typography',
				'selector' => '{{WRAPPER}} .section.started .h-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle_styling',
			[
				'label'	 => esc_html__( 'Subtitle', 'cvio-plugin' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'	 => esc_html__( 'Color', 'cvio-plugin' ),
				'type'	  => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.started .started-content .h-subtitle, {{WRAPPER}} .section.started .started-content .typed-subtitle, {{WRAPPER}} .section.started .started-content .typed-cursor' => 'color: {{VALUE}};',
					'' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'	 => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .section.started .started-content .h-subtitle, {{WRAPPER}} .section.started .started-content .typed-subtitle, {{WRAPPER}} .section.started .started-content .typed-cursor',
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'title', 'basic' );
		?>

		<!-- Section Started -->
		<div class="section started<?php if ( $settings['bg'] == 'image' || $settings['bg'] == 'video' || $settings['bg'] == 'slideshow' || $settings['bg'] == 'color' ) : ?> background-enabled<?php endif; ?><?php if ( $settings['layout'] == 'creative' && $settings['layout'] ) : ?> layout-creative<?php endif; ?><?php if ( $settings['layout'] == 'personal' && $settings['layout'] ) : ?> personal<?php endif; ?><?php if ( $settings['layout'] == 'classic' && $settings['layout'] ) : ?> section-title<?php endif; ?>">

			<?php if( $settings['bg'] == 'none' ) : ?>
			<div class="video-bg">
				<div class="video-bg-mask"></div>
				<?php if( $settings['texture'] == 'yes' ) : ?><div class="video-bg-texture" id="grained_container"></div><?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if( $settings['bg'] == 'video' ) : ?>
			<div class="video-bg jarallax-video" data-jarallax-video="mp4:<?php echo esc_url( $settings['video']['url'] ); ?>" data-volume="<?php if ( ! $settings['video_mute'] ) : ?>100<?php endif; ?>">
				<div class="video-bg-mask"></div>
				<?php if( $settings['texture'] == 'yes' ) : ?><div class="video-bg-texture" id="grained_container"></div><?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if( $settings['bg'] == 'image' && $settings['image'] ) :
				if ( $settings['image']['id'] ) {
					$image = wp_get_attachment_image_url( $settings['image']['id'], 'cvio_1920xAuto' );
				} else {
					$image = $settings['image']['url'];
				}
			?>
			<div class="video-bg jarallax">
				<img class="jarallax-img" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>">
				<div class="video-bg-mask"></div>
				<?php if( $settings['texture'] == 'yes' ) : ?><div class="video-bg-texture" id="grained_container"></div><?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if( $settings['bg'] == 'color' ) : ?>
			<div class="video-bg">
				<?php if( $settings['texture'] == 'yes' ) : ?><div class="video-bg-texture" id="grained_container"></div><?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if( $settings['bg'] == 'slideshow' ) : ?>
			<div class="video-bg">
				<div class="started-carousel">
					<div class="swiper-container" data-autoplaytime="<?php echo esc_attr( $settings['slideshow_autoplay'] ); ?>">
						<div class="swiper-wrapper">
							<?php $i=0; foreach ( $settings['slideshow_items'] as $item ) : $i++; ?>
							<div class="swiper-slide <?php if ( $i == 1 ) : ?>first<?php endif; ?>">
								<div class="main-img" style="background-image: url(<?php echo esc_attr( $item['image']['url'] ); ?>);"></div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="video-bg-mask"></div>
				<?php if( $settings['texture'] == 'yes' ) : ?><div class="video-bg-texture" id="grained_container"></div><?php endif; ?>
			</div>
			<?php if( $settings['navs'] == 'yes' ) : ?>
			<div class="swiper-nav">
				<a class="prev swiper-button-prev fas fa-long-arrow-alt-left"></a>
				<a class="next swiper-button-next fas fa-long-arrow-alt-right"></a>
			</div>
			<?php endif; ?>
			<?php endif; ?>

			<div class="centrize full-width">
				<div class="vertical-center">
					<div class="started-content">

						<?php if ( $settings['layout'] == 'personal' && $settings['personal_image'] ) : ?>
							<?php if( $settings['personal_image'] ) :
								if ( $settings['personal_image']['id'] ) {
									$image = wp_get_attachment_image_url( $settings['personal_image']['id'], 'cvio_1280x720' );
								} else {
									$image = $settings['personal_image']['url'];
								}
							?>
							<div class="logo" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( $settings['title'] ) : ?>
						<<?php echo esc_attr( $settings['title_tag'] ); ?> class="h-title">
							<span {{{ view.getRenderAttributeString( 'title' ) }}}>
								<?php echo wp_kses_post( $settings['title'] ); ?>
							</span>
						</<?php echo esc_attr( $settings['title_tag'] ); ?>>
						<?php endif; ?>

						<?php if ( $settings['under_title'] == 'subtitles' && $settings['subtitles'] ) : ?>
						<div class="h-subtitles">
							<div class="h-subtitle typing-subtitle">
								<?php foreach ( $settings['subtitles'] as $index => $subtitle ) :
								$subtitle_text = $this->get_repeater_setting_key( 'subtitle', 'subtitles', $index );
								$this->add_inline_editing_attributes( $subtitle_text, 'none' );
								?>
								<p><?php echo wp_kses_post( $subtitle['subtitle'] ); ?></p>
								<?php endforeach; ?>
							</div>
							<span class="typed-subtitle"></span>
						</div>
						<?php endif; ?>

						<?php if ( $settings['under_title'] == 'breadcrumbs' ) : ?>
						<div class="h-subtitles">
							<div class="h-subtitle typing-bread">
								<?php cvio_breadcrumb(); ?>
							</div>
							<span class="typed-bread"></span>
						</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
			<a href="#" class="mouse_btn" style="display: none;"><span class="icon fas fa-chevron-down"></span></a>
		</div>

		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Cvio_Started_Section_Widget() );
