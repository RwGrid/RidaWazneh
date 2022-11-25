<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cvio About Me Widget.
 *
 * @since 1.0
 */
class Cvio_About_Me_Widget extends Widget_Base {

	public function get_name() {
		return 'cvio-about-me';
	}

	public function get_title() {
		return esc_html__( 'About Me', 'cvio-plugin' );
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
			'description_tab',
			[
				'label' => esc_html__( 'Description', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_profile',
			[
				'label' => esc_html__( 'Profile Photo', 'cvio-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'cvio-plugin' ),
				'label_off' => __( 'Off', 'cvio-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'profile',
			[
				'label' => esc_html__( 'Profile Photo', 'cvio-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => ['show_profile' => 'yes']
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'cvio-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter your description', 'cvio-plugin' ),
				'default'     => esc_html__( 'Type your description here', 'cvio-plugin' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list_tab',
			[
				'label' => esc_html__( 'Info List', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label', [
				'label'       => esc_html__( 'Label', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter label', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter label', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'value', [
				'label'       => esc_html__( 'Value', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter value', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter value', 'cvio-plugin' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'cvio-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'buttons_tab',
			[
				'label' => esc_html__( 'Buttons', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label', [
				'label'       => esc_html__( 'Label', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter label', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter label', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'value', [
				'label' => esc_html__( 'URL', 'arcdeco-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'buttons',
			[
				'label' => esc_html__( 'Buttons', 'cvio-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
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
			'description_styling',
			[
				'label'     => esc_html__( 'Description', 'cvio-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.about .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .section.about .desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list_styling',
			[
				'label'     => esc_html__( 'List', 'cvio-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_color',
			[
				'label'     => esc_html__( 'Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .info-list ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'list_color2',
			[
				'label'     => esc_html__( 'Label Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .info-list ul li strong' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_typography',
				'selector' => '{{WRAPPER}} .info-list ul li',
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
		$this->add_inline_editing_attributes( 'description', 'advanced' );

		?>

		<!-- Section About -->
		<div class="section about">
			<div class="content content-box">

				<?php if ( $settings['title'] ) : ?>
				<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
					<div class="title_inner">
						<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
					</div>
				</<?php echo esc_attr( $settings['title_tag'] ); ?>>
				<?php endif; ?>

				<?php if( $settings['profile'] && $settings['show_profile'] ) :
					if ( $settings['profile']['id'] ) {
						$image = wp_get_attachment_image_url( $settings['profile']['id'], 'cvio_160xAuto' );
					} else {
						$image = $settings['profile']['url'];
					}
				?>
				<div class="image">
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>">
				</div>
				<?php endif; ?>

				<?php if ( $settings['description'] || $settings['list'] ) : ?>
				<div class="desc">

					<?php if ( $settings['description'] ) : ?>
					<!-- text -->
					<div class="single-post-text">
						<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
							<?php echo wp_kses_post( $settings['description'] ); ?>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( $settings['list'] ) : ?>
					<div class="info-list">
						<ul>
							<?php foreach ( $settings['list'] as $index => $item ) :

						    $item_label = $this->get_repeater_setting_key( 'label', 'list', $index );
						    $this->add_inline_editing_attributes( $item_label, 'none' );

						    $item_value = $this->get_repeater_setting_key( 'value', 'list', $index );
						    $this->add_inline_editing_attributes( $item_value, 'none' );

						    ?>
							<li>
								<?php if ( $item['label'] ) : ?>
								<strong>
									<span <?php echo $this->get_render_attribute_string( $item_label ); ?>>
										<?php echo esc_html( $item['label'] ); ?>
									</span>
								</strong>
								<?php endif; ?>
								<?php if ( $item['value'] ) : ?>
								<span <?php echo $this->get_render_attribute_string( $item_value ); ?>>
									<?php echo esc_html( $item['value'] ); ?>
								</span>
								<?php endif; ?>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>

					<?php if ( $settings['buttons'] ) : ?>
					<div class="bts bts-list">
						<?php foreach ( $settings['buttons'] as $index => $item ) :

					    $item_label = $this->get_repeater_setting_key( 'label', 'buttons', $index );
					    $this->add_inline_editing_attributes( $item_label, 'none' );

					    ?>
					    <?php if ( $item['label'] ) : ?>
						<a<?php if ( $item['value'] ) : if ( $item['value']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['value']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['value']['url'] ); ?>"<?php endif; ?> class="btn hover-animated">
							<span class="circle"></span>
							<span <?php echo $this->get_render_attribute_string( $item_label ); ?>>
								<span class="lnk"><?php echo esc_html( $item['label'] ); ?></span>
							</span>
						</a>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

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
		view.addInlineEditingAttributes( 'description', 'advanced' );
		#>

		<!-- Section About -->
		<div class="section about">
			<div class="content content-box">

				<# if ( settings.title ) { #>
				<div class="title">
					<div class="title_inner">
						<span {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</span>
					</div>
				</div>
				<# } #>

				<# if( settings.profile && settings.show_profile ) { #>
				<div class="image">
					<img src="{{{ settings.profile.url }}}" alt="{{{ settings.title }}}">
				</div>
				<# } #>

				<# if( settings.description || settings.list ) { #>
				<div class="desc">

					<# if( settings.description ) { #>
					<!-- text -->
					<div class="single-post-text">
						<div {{{ view.getRenderAttributeString( 'description' ) }}}>
							{{{ settings.description }}}
						</div>
					</div>
					<# } #>

					<# if( settings.list ) { #>
					<!-- info list -->
					<div class="info-list">
						<ul>
							<# _.each( settings.list, function( item, index ) {

						    var item_label = view.getRepeaterSettingKey( 'label', 'list', index );
						    view.addInlineEditingAttributes( item_label, 'none' );

						    var item_value = view.getRepeaterSettingKey( 'value', 'list', index );
						    view.addInlineEditingAttributes( item_value, 'none' );

						    #>
							<li>
								<# if ( item.label ) { #>
								<strong>
									<span {{{ view.getRenderAttributeString( item_label ) }}}>
										{{{ item.label }}}
									</span>
								</strong>
								<# } #>
								<# if ( item.value ) { #>
								<span {{{ view.getRenderAttributeString( item_value ) }}}>
									{{{ item.value }}}
								</span>
								<# } #>
							</li>
							<# }); #>
						</ul>
					</div>
					<# } #>

					<# if( settings.buttons ) { #>
					<div class="bts bts-list">
					    <# _.each( settings.buttons, function( item, index ) {

					    var item_label = view.getRepeaterSettingKey( 'label', 'buttons', index );
					    view.addInlineEditingAttributes( item_label, 'none' );

					    var item_value = view.getRepeaterSettingKey( 'value', 'buttons', index );
					    view.addInlineEditingAttributes( item_value, 'none' );

					    #>
						<a href="<# if( item.value ) { #>{{{ item.value.url }}}<# } #>" class="btn hover-animated">
							<# if( item.label ) { #>
							<span class="circle"></span>
							<span {{{ view.getRenderAttributeString( item_label ) }}}>
								<span class="lnk">{{{ item.label }}}</span>
							</span>
							<# } #>
						</a>
						<# }); #>
					</div>
					<# } #>

				</div>
				<# } #>

				<div class="clear"></div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Cvio_About_Me_Widget() );
