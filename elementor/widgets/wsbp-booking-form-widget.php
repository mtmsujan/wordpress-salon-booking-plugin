<?php

namespace Wsbp_Addon;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Hero Section Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Wsbp_Booking_Widget extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve Wsbp widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'Wsbp-Booking-Widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Hero Section widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Wsbp Booking Widget', 'jhfahim');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Hero Section widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-calendar';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url()
	{
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['general'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['Booking Form', 'Wsbp', 'services'];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{


		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'wsbp'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'wsbp_font_family',
			[
				'label' => esc_html__('Font Family', 'wsbp'),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Poppins','Open Sans'",
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_progress_btn_color',
			[
				'label' => esc_html__('Progress Color', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .header ul li.active p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_progress_bg_color',
			[
				'label' => esc_html__('Progress Active Backgrond', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#064635',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .header ul li.active p,.wsbp_booking-plugin-content .wrapper .header ul li.active:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_progress_normal_bg_color',
			[
				'label' => esc_html__('Progress Normal Backgrond', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#519259',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .header ul li p' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_title_color',
			[
				'label' => esc_html__('Title Color', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .form_wrap h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_label_color',
			[
				'label' => esc_html__('Label Color', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .form-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_prev_next_color',
			[
				'label' => esc_html__('Prev/next Color', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .btns_wrap .common_btns button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'wsbp_form_prev_next_bg_color',
			[
				'label' => esc_html__('Prev/next Background', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#064635',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .btns_wrap .common_btns button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_hover_next_bg_color',
			[
				'label' => esc_html__('Hover next', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#519259',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .btns_wrap .common_btns button.btn_next:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_hover_prev_bg_color',
			[
				'label' => esc_html__('Hover Prev', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#064635',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content .wrapper .btns_wrap .common_btns button.btn_back:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'wsbp_form_book_now_color',
			[
				'label' => esc_html__('Book Now Bg', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#519259',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content #wsbp_book_now' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_book_now_hov_color',
			[
				'label' => esc_html__('Book Now Hover', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#064635',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content #wsbp_book_now:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_find_time_color',
			[
				'label' => esc_html__('Find Time Color', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content button.btn.btn-primary.find-time' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'wsbp_form_find_time_bg_color',
			[
				'label' => esc_html__('Find Time Background', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#064635',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content #wsbp_available_times_row button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wsbp_form_assistants_color',
			[
				'label' => esc_html__('Assistants Color', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#064635',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'wsbp_form_services_color',
			[
				'label' => esc_html__('Services Color', 'wsbp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#064635',
				'selectors' => [
					'{{WRAPPER}} .wsbp_booking-plugin-content h3' => 'color: {{VALUE}}',
				],
			]
		);



		$this->end_controls_section();
	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{

		$settings = $this->get_settings_for_display();


?>
		<!--PEN CONTENT -->
		<div class="wsbp_booking-plugin-content">

			<div class="wrapper">
				<div class="header">
					<ul>
						<li class="active form_1_progessbar">
							<div>
								<p>1</p>
							</div>
						</li>
						<li class="form_2_progessbar">
							<div>
								<p>2</p>
							</div>
						</li>
						<li class="form_3_progessbar">
							<div>
								<p>3</p>
							</div>
						</li>
						<li class="form_4_progessbar">
							<div>
								<p>4</p>
							</div>
						</li>
					</ul>
				</div>
				<div class="form_wrap">
					<div class="form_1 data_info">
						<h2>Select Services</h2>
						<form>
							<div class="form_container">
								<div class="mb-3">
									<label for="service-select" class="form-label">Select Service</label>
									<select class="form-select" name="wsbp_booking_services" id="wsbp_booking_services" required>
										<option value="" disabled selected>Select Service</option>
										<?php
										$services = get_posts(array(
											'post_type' => 'wsbp-services',
											'post_status' => 'publish',
											'orderby' => 'title',
											'order' => 'ASC',
											'numberposts' => -1,
										));
										foreach ($services as $service) {
											$selected = '';
											if ($services_name == $service->ID) {
												$selected = 'selected';
											}
											echo '<option value="' . $service->ID . '"' . $selected . '><a href="' . get_permalink($service->ID) . '">' . $service->post_title . '</a></option>';
										}
										?>
									</select>
									<div id="wsbp_service_error_message"></div>
								</div>
								<div class="mb-3">
									<label for="person-number" class="form-label">Number of persons</label>
									<input type="number" class="form-control" id="wsbp_num_of_person" name="wsbp_num_of_person" value="1" required>
								</div>
								<div class="mb-3">
									<label for="datetime-picker" class="form-label">Select Date</label>
									<div class="ui calendar" id="wsbp_booking_calender">
										<div class="ui input left icon">
											<i class="fas fa-calendar-alt"></i>
											<input type="text" placeholder="Date" name="wsbp_booking_calender_date" id="wsbp_booking_calender_date" required>
										</div>
										<div id="wsbp_date_error_message"></div>
									</div>
								</div>
								<div class="col-md-12">
									<button class="btn btn-primary find-time" id="wsbp_find_available_time">Click Here To Find Available Time</button>
								</div>
								<table class="table ">
									<tbody>
										<tr id="wsbp_available_times_row">

										</tr>
									</tbody>
								</table>
								<div id="wsbp_time_error_message"></div>
							</div>
						</form>
					</div>
					<div class="form_2 data_info" style="display: none;">
						<h2>Select Assistence</h2>
						<form>
							<div class="form_container">
								<div class="multisteps_form__content">
									<?php
									$assistants = get_posts(array(
										'post_type' => 'wsbp-assistants',
										'post_status' => 'publish',
										'orderby' => 'title',
										'order' => 'ASC',
										'numberposts' => -1,
									));

									if ($assistants) {
										foreach ($assistants as $assistant) {

											// Get the title
											$title = $assistant->post_title;

											// Get the thumbnail URL
											$thumbnail_url = get_the_post_thumbnail_url($assistant->ID, 'thumbnail');

											// Get the excerpt or the content as the description
											$description = $assistant->post_content;

											// Generate the HTML structure
											echo '<div class="row my-3 shadow d-flex align-items-center">';
											echo '<div class="col-2 mx-auto">';
											echo '<input type="radio" data-id="' . $assistant->ID . '" name="wsbp_booking_assistance">';
											echo '</div>';
											echo '<div class="col-4">';
											echo '<img src="' . $thumbnail_url . '" alt="' . $title . '">';
											echo '</div>';
											echo '<div class="col-6">';
											echo '<h4>' . $title . '</h4>';
											echo '<p>' . $description . '</p>';
											echo '</div>';
											echo '</div>';
										}
									} else {
										echo 'No assistants found.';
									}
									?>
									<div id="wsbp_assistant_error_message"></div>
								</div>
							</div>
						</form>
					</div>
					<div class="form_3 data_info" style="display: none;">
						<h2>Your Booking Info</h2>
						<form>
							<div class="form_container">
								<div class="container" id="wsbp_booking_info_show"> </div>
							</div>
						</form>
					</div>
					<div class="form_4 data_info" style="display: none;">
						<h2>Additional Info</h2>
						<form>
							<div class="form_container">
								<div class="multisteps_form__content">
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label for="wsbp_booking_firstName" class="form-label">First Name</label>
												<input type="text" class="form-control" id="wsbp_booking_firstName" name="wsbp_booking_firstName" required>
												<div class="error-message hidden">Please enter your first name.</div>
											</div>
											<div class="mb-3">
												<label for="wsbp_booking_lastName" class="form-label">Last Name</label>
												<input type="text" class="form-control" id="wsbp_booking_lastName" name="wsbp_booking_lastName" required>
												<div class="error-message hidden">Please enter your last name.</div>
											</div>
											<div class="mb-3">
												<label for="wsbp_booking_email" class="form-label">Email</label>
												<input type="email" class="form-control" id="wsbp_booking_email" name="wsbp_booking_email" required>
												<div class="error-message hidden">Please enter a valid email address.</div>
											</div>
											<div class="mb-3">
												<label for="wsbp_booking_phone" class="form-label">Phone</label>
												<input type="tel" class="form-control" id="wsbp_booking_phone" name="wsbp_booking_phone" required>
												<div class="error-message hidden">Please enter your phone number.</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label for="wsbp_booking_address" class="form-label">Address</label>
												<textarea class="form-control" id="wsbp_booking_address" name="wsbp_booking_address" rows="3" required></textarea>
												<div class="error-message hidden">Please enter your address.</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="btns_wrap">
					<div class="common_btns form_1_btns">
						<button type="button" class="btn_next">Next <span class="icon"><span class="icon"><i class="fas fa-long-arrow-alt-right"></i></span></span></button>
					</div>
					<div class="common_btns form_2_btns" style="display: none;">
						<button type="button" class="btn_back"><span class="icon"><i class="fas fa-long-arrow-alt-left"></i></span>Back</button>
						<button type="button" class="btn_next" id="wsbp_booking_info">Next <span class="icon"><i class="fas fa-long-arrow-alt-right"></i></span></button>
					</div>
					<div class="common_btns form_3_btns" style="display: none;">
						<button type="button" class="btn_back"><span class="icon"><i class="fas fa-long-arrow-alt-left"></i></span>Back</button>
						<button type="button" class="btn_next">Next<span class="icon"><i class="fas fa-long-arrow-alt-right"></i></span></button>
					</div>
					<div class="common_btns form_4_btns" style="display: none;">
						<button type="button" class="btn_back"><span class="icon"><i class="fas fa-long-arrow-alt-left"></i></span>Back</button>
						<button type="button" class="btn_done" id="wsbp_book_now">Book Now</button>
					</div>
				</div>
			</div>

			<div class="modal_wrapper wsbp_booking_cross">
							<div class="shadow"></div>
							<div class="success_wrap ">
								<span class="modal_icon"><i class="fas fa-check"></i></span>
								<p>You have successfully completed the process.</p>
								<span class="cross_icon "><i class="fas fa-times"></i></span>
							</div>
			</div>

		</div>

<?php

	}
}
