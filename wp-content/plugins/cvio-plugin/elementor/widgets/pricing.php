<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cvio Pricing Widget.
 *
 * @since 1.0
 */
class Cvio_Pricing_Widget extends Widget_Base {

	public function get_name() {
		return 'cvio-pricing';
	}

	public function get_title() {
		return esc_html__( 'Pricing', 'cvio-plugin' );
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
			'icon', [
  				'label'       => esc_html__( 'Icon', 'cvio-plugin' ),
  				'type'        => Controls_Manager::ICONS,
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
			'price', [
				'label'       => esc_html__( 'Price', 'cvio-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 100,
				'default'	=> 100,
			]
		);

		$repeater->add_control(
			'price_before', [
				'label'       => esc_html__( 'Price (before)', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '$', 'cvio-plugin' ),
				'default'	=> esc_html__( '$', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'price_after', [
				'label'       => esc_html__( 'Price (after)', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'hour', 'cvio-plugin' ),
				'default'	=> esc_html__( 'hour', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'list', [
				'label'       => esc_html__( 'List', 'cvio-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$repeater->add_control(
			'button', [
				'label'       => esc_html__( 'Button (title)', 'cvio-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Button', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label'       => esc_html__( 'Button (link)', 'cvio-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Pricing Items', 'cvio-plugin' ),
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
			'item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_name_color',
			[
				'label'     => esc_html__( 'Title Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Title Typography', 'cvio-plugin' ),
				'name'     => 'item_name_typography',
				'selector' => '{{WRAPPER}} .pricing-item .name',
			]
		);

		$this->add_control(
			'item_price_color',
			[

				'label'     => esc_html__( 'Price Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .amount .number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_price_typography',
				'label'     => esc_html__( 'Price Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .amount .number',
			]
		);

		$this->add_control(
			'item_price2_color',
			[

				'label'     => esc_html__( 'Price Secondary Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .amount .number .dollar, {{WRAPPER}} .pricing-item .amount .number .period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_price2_typography',
				'label'     => esc_html__( 'Price Secondary Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .amount .number .dollar, {{WRAPPER}} .pricing-item .amount .number .period',
			]
		);

		$this->add_control(
			'item_list_color',
			[

				'label'     => esc_html__( 'List Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .feature-list' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_list_typography',
				'label'     => esc_html__( 'List Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .feature-list',
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

		<!-- Section Pricing -->
		<div class="section pricing">
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
				<div class="pricing-items">

					<?php foreach ( $settings['items'] as $index => $item ) :

				    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
				    $this->add_inline_editing_attributes( $item_name, 'none' );

				    $item_price = $this->get_repeater_setting_key( 'price', 'items', $index );
				    $this->add_inline_editing_attributes( $item_price, 'none' );

				    $item_price_before = $this->get_repeater_setting_key( 'price_before', 'items', $index );
				    $this->add_inline_editing_attributes( $item_price_before, 'none' );

				    $item_price_after = $this->get_repeater_setting_key( 'price_after', 'items', $index );
				    $this->add_inline_editing_attributes( $item_price_after, 'none' );

				    $item_desc = $this->get_repeater_setting_key( 'list', 'items', $index );
				    $this->add_inline_editing_attributes( $item_desc, 'advanced' );

				    $item_button = $this->get_repeater_setting_key( 'button', 'items', $index );
				    $this->add_inline_editing_attributes( $item_button, 'none' );

				    ?>
					<div class="pricing-col">
						<div class="pricing-item content-box">
							<?php if ( $item['icon'] ) : ?>
							<div class="icon"><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
							<?php endif; ?>
							<?php if ( $item['name'] ) : ?>
							<div class="name">
								<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
									<?php echo esc_html( $item['name'] ); ?>
								</span>
							</div>
							<?php endif; ?>
							<?php if ( $item['price'] ) : ?>
							<div class="amount">
								<span class="number">
									<?php if ( $item['price_before'] ) : ?>
									<span class="dollar">
										<span <?php echo $this->get_render_attribute_string( $item_price_before ); ?>>
											<?php echo esc_html( $item['price_before'] ); ?>
										</span>
									</span>
									<?php endif; ?>
									<?php if ( $item['price'] ) : ?>
									<span <?php echo $this->get_render_attribute_string( $item_price ); ?>>
										<?php echo esc_html( $item['price'] ); ?>
									</span>
									<?php endif; ?>
									<?php if ( $item['price_after'] ) : ?>
									<span class="period">
										<span <?php echo $this->get_render_attribute_string( $item_price_after ); ?>>
											<?php echo esc_html( $item['price_after'] ); ?>
										</span>
									</span>
									<?php endif; ?>
								</span>
							</div>
							<?php endif; ?>
							<?php if ( $item['list'] ) : ?>
							<div class="feature-list">
								<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
									<?php echo wp_kses_post( $item['list'] ); ?>
								</div>
							</div>
							<?php endif; ?>
							<?php if ( $item['button'] ) : ?>
							<div class="bts">
								<a<?php if ( $item['link'] ) : if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?> class="btn hover-animated">
									<span class="circle"></span>
									<span <?php echo $this->get_render_attribute_string( $item_button ); ?>>
										<span class="lnk"><?php echo esc_html( $item['button'] ); ?></span>
									</span>
								</a>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<?php endforeach; ?>

				</div>
				<?php endif; ?>

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

		<!-- Section Pricing -->
		<div class="section pricing">
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
				<div class="pricing-items">
					<# _.each( settings.items, function( item, index ) {

				    var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
				    view.addInlineEditingAttributes( item_name, 'none' );

				    var item_price = view.getRepeaterSettingKey( 'price', 'items', index );
				    view.addInlineEditingAttributes( item_price, 'none' );

				    var item_price_before = view.getRepeaterSettingKey( 'price_before', 'items', index );
				    view.addInlineEditingAttributes( item_price_before, 'none' );

				    var item_price_after = view.getRepeaterSettingKey( 'price_after', 'items', index );
				    view.addInlineEditingAttributes( item_price_after, 'none' );

				    var item_desc = view.getRepeaterSettingKey( 'list', 'items', index );
				    view.addInlineEditingAttributes( item_desc, 'advanced' );

				    var item_button = view.getRepeaterSettingKey( 'button', 'items', index );
				    view.addInlineEditingAttributes( item_button, 'none' );

					var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );

				    #>
					<div class="pricing-col">
						<div class="pricing-item content-box">
							<# if ( item.icon ) { #>
							<div class="icon">{{{ iconHTML.value }}}</div>
							<# } #>
							<# if ( item.name ) { #>
							<div class="name">
								<span {{{ view.getRenderAttributeString( item_name ) }}}>
									{{{ item.name }}}
								</span>
							</div>
							<# } #>
							<# if ( item.price ) { #>
							<div class="amount">
								<span class="number">
									<# if ( item.price_before ) { #>
									<span class="dollar">
										<span {{{ view.getRenderAttributeString( item_price_before ) }}}>
											{{{ item.price_before }}}
										</span>
									</span>
									<# } #>
									<# if ( item.price ) { #>
									<span {{{ view.getRenderAttributeString( item_price ) }}}>
										{{{ item.price }}}
									</span>
									<# } #>
									<# if ( item.price_after ) { #>
									<span class="period">
										<span {{{ view.getRenderAttributeString( item_price_after ) }}}>
											{{{ item.price_after }}}
										</span>
									</span>
									<# } #>
								</span>
							</div>
							<# } #>
							<# if ( item.list ) { #>
							<div class="feature-list">
								<div {{{ view.getRenderAttributeString( item_desc ) }}}>
									{{{ item.list }}}
								</div>
							</div>
							<# } #>
							<# if ( item.button ) { #>
							<div class="bts">
								<a<# if ( item.link ) { #><# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #> class="btn hover-animated">
									<span class="circle"></span>
									<span {{{ view.getRenderAttributeString( item_button ) }}}>
										<span class="lnk">{{{ item.button }}}</span>
									</span>
								</a>
							</div>
							<# } #>
						</div>
					</div>
					<# }); #>

				</div>
				<# } #>

			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Cvio_Pricing_Widget() );
