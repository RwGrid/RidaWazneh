<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cvio Resume Widget.
 *
 * @since 1.0
 */
class Cvio_Resume_Widget extends Widget_Base {

	public function get_name() {
		return 'cvio-resume';
	}

	public function get_title() {
		return esc_html__( 'Resume', 'cvio-plugin' );
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
				'default' => 'div',
				'options' => [
					'h1'  => __( 'H1', 'cvio-plugin' ),
					'h2' => __( 'H2', 'cvio-plugin' ),
					'div' => __( 'DIV', 'cvio-plugin' ),
				],
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'date', [
				'label'       => esc_html__( 'Date', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter date', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter date', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'show_image', [
				'label' => esc_html__( 'Image', 'cvio-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'cvio-plugin' ),
				'label_off' => __( 'Off', 'cvio-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'cvio-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => ['show_image' => 'yes']
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Title', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'desc', [
				'label'       => esc_html__( 'Description', 'cvio-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter description', 'cvio-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'cvio-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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
					'{{WRAPPER}} .section .content .title .title_inner' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .section .content .title .title_inner',
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
			'item_date_color',
			[
				'label'     => esc_html__( 'Date Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .resume-item .date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_date_typography',
				'label'     => esc_html__( 'Date Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .resume-item .date',
			]
		);

		$this->add_control(
			'item_name_color',
			[
				'label'     => esc_html__( 'Title Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .resume-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_name_typography',
				'label'     => esc_html__( 'Title Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .resume-item .name',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Description Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .resume-item .single-post-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .resume-item .single-post-text',
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

		<!-- Resume -->
		<div class="section resume-widget">
			<div class="content">

				<?php if ( $settings['title'] ) : ?>
				<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
					<div class="title_inner">
						<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
					</div>
				</<?php echo esc_attr( $settings['title_tag'] ); ?>>
				<?php endif; ?>

				<?php if ( $settings['items'] ) : ?>
				<div class="resume-items">

					<?php foreach ( $settings['items'] as $index => $item ) :

				    $item_date = $this->get_repeater_setting_key( 'date', 'items', $index );
				    $this->add_inline_editing_attributes( $item_date, 'none' );

				    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
				    $this->add_inline_editing_attributes( $item_name, 'basic' );

				    $item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
				    $this->add_inline_editing_attributes( $item_desc, 'advanced' );

				    ?>
					<div class="resume-item content-box<?php if ( $index == 0 ) : ?> active<?php endif; ?>">

						<?php if ( $item['date'] ) : ?>
						<div class="date">
							<span <?php echo $this->get_render_attribute_string( $item_date ); ?>>
								<?php echo esc_html( $item['date'] ); ?>
							</span>
						</div>
						<?php endif; ?>

						<?php if( $item['image'] && $item['show_image'] == 'yes' ) :
							if ( $item['image']['id'] ) {
								$image = wp_get_attachment_image_url( $item['image']['id'], 'cvio_160xAuto' );
							} else {
								$image = $item['image']['url'];
							}
						?>
						<div class="image">
							<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>">
						</div>
						<?php endif; ?>

						<?php if ( $item['name'] ) : ?>
						<div class="name">
							<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
								<?php echo wp_kses_post( $item['name'] ); ?>
							</span>
						</div>
						<?php endif; ?>

						<?php if ( $item['desc'] ) : ?>
						<div class="single-post-text">
							<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
								<?php echo wp_kses_post( $item['desc'] ); ?>
							</div>
						</div>
						<?php endif; ?>

					</div>
					<?php endforeach; ?>

				</div>
				<?php endif; ?>

				<div class="clear"></div>
			</div>
		</div>

		<?php
	}

	/**
	 * Render widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'basic' );
		#>

		<!-- Resume -->
		<div class="section resume-widget">
			<div class="content">

				<# if ( settings.title ) { #>
				<div class="title">
					<div class="title_inner">
						<span {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</span>
					</div>
				</div>
				<# } #>

				<# if ( settings.items ) { #>
				<div class="resume-items">

				    <# _.each( settings.items, function( item, index ) {

				    var item_date = view.getRepeaterSettingKey( 'date', 'items', index );
				    view.addInlineEditingAttributes( item_date, 'none' );

				    var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
				    view.addInlineEditingAttributes( item_name, 'basic' );

				    var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
				    view.addInlineEditingAttributes( item_desc, 'advanced' );

				    #>
					<div class="resume-item content-box<# if ( index == 0 ) { #> active<# } #>">

						<div class="date">
							<span {{{ view.getRenderAttributeString( item_date ) }}}>
								{{{ item.date }}}
							</span>
						</div>

						<# if( item.image && item.show_image == 'yes' ) { #>
						<div class="image">
							<img src="{{{ item.image.url }}}" alt="{{{ settings.title }}}">
						</div>
						<# } #>

						<div class="name">
							<span {{{ view.getRenderAttributeString( item_name ) }}}>
								{{{ item.name }}}
							</span>
						</div>

						<div class="single-post-text">
							<div {{{ view.getRenderAttributeString( item_desc ) }}}>
								{{{ item.desc }}}
							</div>
						</div>

					</div>
					<# }); #>

				</div>
				<# } #>

				<div class="clear"></div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Cvio_Resume_Widget() );
