<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cvio Clients Widget.
 *
 * @since 1.0
 */
class Cvio_Clients_Widget extends Widget_Base {

	public function get_name() {
		return 'cvio-clients';
	}

	public function get_title() {
		return esc_html__( 'Clients', 'cvio-plugin' );
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
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'cvio-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter name', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label' => esc_html__( 'URL', 'cvio-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Clients Items', 'cvio-plugin' ),
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

		<!-- Section Clients -->
		<div class="section clients">
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

				<?php if ( $settings['items'] ) : ?>
				<div class="content-box">
					<div class="clients-items">
						<?php foreach ( $settings['items'] as $index => $item ) : ?>
						<div class="clients-col">
							<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'cvio_282x282' ); ?>
							<div class="clients-item">
								<?php if ( $item['link'] ) : ?>
								<a <?php if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
								<?php endif; ?>
									<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
								<?php if ( $item['link'] ) : ?>
								</a>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
						<?php endforeach; ?>
					</div>
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

		<!-- Section Clients -->
		<div class="section clients">
			<div class="content">

				<# if ( settings.title ) { #>
				<div class="title">
					<div class="title_inner">
						<span {{{ view.getRenderAttributeString( 'title' ) }}}>
							{{{ settings.title }}}
						</span>
					</div>
				</div>
				<# } #>

				<# if ( settings.items ) { #>
				<div class="content-box">
					<div class="clients-items">
						<# _.each( settings.items, function( item, index ) { #>
						<div class="clients-col">
							<# if ( item.image ) { #>
							<div class="clients-item">
								<# if ( item.link ) { #>
								<a <# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}">
								<# } #>
									<img src="{{{ item.image.url }}}" alt="{{{ item.name }}}" />
								<# if ( item.link ) { #>
								</a>
								<# } #>
							</div>
							<# } #>
						</div>
						<# }); #>
					</div>
				</div>
				<# } #>

				<div class="clear"></div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Cvio_Clients_Widget() );
