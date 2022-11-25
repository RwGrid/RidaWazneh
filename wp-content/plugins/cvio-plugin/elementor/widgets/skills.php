<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cvio Skills Widget.
 *
 * @since 1.0
 */
class Cvio_Skills_Widget extends Widget_Base {

	public function get_name() {
		return 'cvio-skills';
	}

	public function get_title() {
		return esc_html__( 'Skills', 'cvio-plugin' );
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
			'name', [
				'label'       => esc_html__( 'Title', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'cvio-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'progress_label', [
				'label'       => esc_html__( 'Progress Label', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '90%', 'cvio-plugin' ),
				'default'	=> esc_html__( '90%', 'cvio-plugin' ),
			]
		);

		$repeater->add_control(
			'progress_value', [
				'label'       => esc_html__( 'Progress Value (%)', 'cvio-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '90', 'cvio-plugin' ),
				'default'	=> esc_html__( '90', 'cvio-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Skills Items', 'cvio-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_type_tab',
			[
				'label' => esc_html__( 'Progress Settings', 'cvio-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'progress_type',
			[
				'label'       => esc_html__( 'Progress Type', 'cvio-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'percent',
				'options' => [
					'percent'  => __( 'Percent', 'cvio-plugin' ),
					'dotted' => __( 'Dotted', 'cvio-plugin' ),
					'circles' => __( 'Circles', 'cvio-plugin' ),
					'list' => __( 'Knowledges', 'cvio-plugin' ),
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
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .skills .name',
			]
		);

		$this->add_control(
			'item_progress_label_color',
			[
				'label'     => esc_html__( 'Progress Label Color', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills .progress .percentage .percent, {{WRAPPER}} .skills.circles .progress span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_progress_label_typography',
				'label'     => esc_html__( 'Progress Label Typography', 'cvio-plugin' ),
				'selector' => '{{WRAPPER}} .skills .progress .percentage .percent, {{WRAPPER}} .skills.circles .progress span',
			]
		);

		$this->add_control(
			'item_progress_line_color',
			[
				'label'     => esc_html__( 'Progress Line Background', 'cvio-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills .progress .percentage' => 'background: {{VALUE}};',
					'{{WRAPPER}} .skills.dotted .progress .da span' => 'background: {{VALUE}};',
					'{{WRAPPER}} .skills.circles .progress .bar, {{WRAPPER}} .skills.circles .progress .fill' => 'border-color: {{VALUE}};',
				],
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

		<!-- Section Skills -->
		<div class="section skills">
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
				<div class="skills content-box <?php echo esc_attr( $settings['progress_type'] ); ?>">
					<ul>
						<?php foreach ( $settings['items'] as $index => $item ) :
					    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
					    $this->add_inline_editing_attributes( $item_name, 'basic' );

					    $progress_label = $this->get_repeater_setting_key( 'progress_label', 'items', $index );
					    $this->add_inline_editing_attributes( $progress_label, 'none' );
					    ?>
						<li>
							<div class="name">
								<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
									<?php echo wp_kses_post( $item['name'] ); ?>
								</span>
							</div>
							<?php if ( $settings['progress_type'] == 'circles' ) : ?>
							<div class="progress p<?php echo esc_attr( $item['progress_value'] ); ?>">
								<div class="percentage"></div>
								<span <?php echo $this->get_render_attribute_string( $progress_label ); ?>>
									<?php echo esc_html( $item['progress_label'] ); ?>
								</span>
							</div>
							<?php endif; ?>
							<?php if ( $settings['progress_type'] != 'circles' ) : ?>
							<div class="progress">
								<div class="percentage" style="width: <?php echo esc_attr( $item['progress_value'] ); ?>%;">
									<span class="percent">
										<span <?php echo $this->get_render_attribute_string( $progress_label ); ?>>
											<?php echo esc_html( $item['progress_label'] ); ?>
										</span>
									</span>
								</div>
							</div>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
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

		<!-- Section Skills -->
		<div class="section skills">
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
				<!-- skills items -->
				<div class="skills content-box {{{ settings.progress_type }}}">
					<ul>
					    <# _.each( settings.items, function( item, index ) {

					    var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
					    view.addInlineEditingAttributes( item_name, 'basic' );

					    var item_progress_label = view.getRepeaterSettingKey( 'progress_label', 'items', index );
					    view.addInlineEditingAttributes( item_progress_label, 'none' );

					    #>
						<li>
							<div class="name">
								<span {{{ view.getRenderAttributeString( item_name ) }}}>
									{{{ item.name }}}
								</span>
							</div>
							<# if ( settings.progress_type == 'circles' ) { #>
							<div class="progress p{{{ item.progress_value }}}">
								<div class="percentage"></div>
								<span {{{ view.getRenderAttributeString( item_progress_label ) }}}>
									{{{ item.progress_label }}}
								</span>
							</div>
							<# } #>
							<# if ( settings.progress_type != 'circles' ) { #>
							<div class="progress">
								<div class="percentage" style="width: {{{ item.progress_value }}}%;">
									<span class="percent">
										<span {{{ view.getRenderAttributeString( item_progress_label ) }}}>
											{{{ item.progress_label }}}
										</span>
									</span>
								</div>
							</div>
							<# } #>
						</li>
						<# }); #>
					</ul>
				</div>
				<# } #>

				<div class="clear"></div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Cvio_Skills_Widget() );
