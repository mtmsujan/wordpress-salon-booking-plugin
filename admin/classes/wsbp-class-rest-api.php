<?php

/**
 * Rest API
 *
 */
class WSBP_Booking_Form_REST_API
{

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'wsbp_register_routes'));
        add_action('rest_api_init', array($this, 'wsbp_register_booking_available_available'));
        add_action('rest_api_init', array($this, 'wsbp_register_booking_info'));
    }

    /**
     * Register the REST API routes for the plugin.
     */
    public function wsbp_register_routes()
    {
        register_rest_route('wsbp/v1', '/createbookings', array(
            'methods' => 'POST',
            'callback' => array($this, 'wsbp_create_booking'),
        ));
    }
    /**
     * Register the REST API routes for available available booking time.
     */
    public function wsbp_register_booking_available_available()
    {
        register_rest_route('wsbp/v1', '/booking/(?P<date>\d{4}-\d{2}-\d{2})', array(
            'methods' => 'GET',
            'callback' => array($this, 'wsbp_get_available_booking_times'),
        ));
    }

    /**
     * Register the REST API routes for Booking info.
     */
    public function wsbp_register_booking_info()
    {
        register_rest_route('wsbp/v1', '/bookinginfo/(?P<id>\d+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'wsbp_booking_info'),
        ));
    }


    /**
     * Create a new booking.
     */
    public function wsbp_create_booking($request)
    {
        $params = $request->get_params();

        $booking_data = array(
            'post_type' => 'wsbp-bookings',
            'post_title' => sanitize_text_field($params['wsbp_booking_first_name']) . ' ' . sanitize_text_field($params['wsbp_booking_last_name']),
            'post_status' => 'publish',
            'meta_input' => array(
                'wsbp_booking_first_name' => sanitize_text_field($params['wsbp_booking_first_name']),
                'wsbp_booking_last_name' => sanitize_text_field($params['wsbp_booking_last_name']),
                'wsbp_booking_email' => sanitize_email($params['wsbp_booking_email']),
                'wsbp_booking_phone' => sanitize_text_field($params['wsbp_booking_phone']),
                'wsbp_booking_address' => sanitize_text_field($params['wsbp_booking_address']),
                'wsbp_booking_date' => sanitize_text_field($params['wsbp_booking_date']),
                'wsbp_booking_time' => sanitize_text_field($params['wsbp_booking_time']),
                'wsbp_booking_duration' => sanitize_text_field($params['wsbp_booking_duration']),
                'wsbp_booking_services' => sanitize_text_field($params['wsbp_booking_services']),
                'wsbp_booking_assistants' => sanitize_text_field($params['wsbp_booking_assistants']),
                'wsbp_num_of_person' => sanitize_text_field($params['wsbp_num_of_person']),
                'wsbp_booking_status' => sanitize_text_field($params['wsbp_booking_status']),
                'wsbp_booking_price' => sanitize_text_field($params['wsbp_booking_price']),
            ),
        );

        $booking_id = wp_insert_post($booking_data);

        if (is_wp_error($booking_id)) {
            return new WP_Error('rest_booking_failed', esc_html__('Failed to create booking.', 'wsbp'), array('status' => 500));
        }

        // Send email to the user
        $to = $params['wsbp_booking_email'];
        $subject = 'Booking Confirmation';
        $message = 'Your booking has been created successfully.';
        $message .= '<br><br>';
        $message .= '<strong>Booking Details:</strong><br>';
        $message .= 'Name: ' . $params['wsbp_booking_first_name'] . $params['wsbp_booking_last_name'] . '<br>';
        $message .= 'Email: ' . $params['wsbp_booking_email'] . '<br>';
        $message .= 'Phone: ' . $params['wsbp_booking_phone'] . '<br>';
        $message .= 'Address: ' . $params['wsbp_booking_address'] . '<br>';
        $message .= 'Date: ' . $params['wsbp_booking_date'] . '<br>';
        $message .= 'Time: ' . $params['wsbp_booking_time'] . '<br>';
        $message .= 'Duration: ' . $params['wsbp_booking_duration'] . '<br>';
        $message .= 'Services: ' . $params['wsbp_booking_services'] . '<br>';
        $message .= 'Assistants: ' . $params['wsbp_booking_assistants'] . '<br>';
        $message .= 'Number of Persons: ' . $params['wsbp_num_of_person'] . '<br>';
        $message .= 'Price: ' . $params['wsbp_booking_price'] . '<br>';

        // Get the site name dynamically
        $site_name = get_bloginfo('name');

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $site_name . ' <wordpress@salon.com>',
        );

        wp_mail($to, $subject, $message, $headers);


        if ($sent) {
            $email = 'email sent successfully';
        } else {
            $email = 'email sent faild';
        }

        $response = array(
            'id' => $booking_id,
            'message' => esc_html__('Booking created successfully.', 'wsbp'),
            'email' => $email,
        );
        return rest_ensure_response($response);
    }

    /**
     * Get Available Booking Time
     */
    public function wsbp_get_available_booking_times($request)
    {
        $date = $request->get_param('date');

        // Query bookings for selected date
        $bookings = get_posts(array(
            'post_type' => 'wsbp-bookings',
            'post_status' => 'publish',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'wsbp_booking_date',
                    'value' => $date,
                    'compare' => '=',
                ),
            ),
        ));

        // Calculate end time for each booking
        $booking_end_times = array();
        foreach ($bookings as $booking) {
            $duration = get_post_meta($booking->ID, 'wsbp_booking_duration', true);
            $start_time = get_post_meta($booking->ID, 'wsbp_booking_time', true);
            $end_time = date('H:i', strtotime($start_time . '+' . $duration . ' minutes'));
            $booking_end_times[] = $end_time;

            // Add intermediate end times
            $intermediate_end_time = $end_time;
            while (strtotime($start_time) < strtotime($intermediate_end_time)) {
                $intermediate_end_time = date('H:i', strtotime($intermediate_end_time . ' -15 minutes'));
                $booking_end_times[] = $intermediate_end_time;
            }
        }

        // Generate array of all possible booking times for selected date
        $shop_start_time = esc_attr(get_option('wsbp_shop_start_time', '00:00:00'));
        $shop_end_time = esc_attr(get_option('wsbp_shop_end_time', '23:59:59'));
        $all_booking_times = array();
        $start_time = strtotime($shop_start_time);
        $end_time = strtotime($shop_end_time);
        while ($start_time < $end_time) {
            $all_booking_times[] = date('H:i', $start_time);
            $start_time = strtotime('+15 minutes', $start_time);
        }

        // get the difference between $all_booking_times and $booking_times
        $available_times = array_diff($all_booking_times, $booking_end_times);


        // output the available times
        $all_available_times = [];
        foreach ($available_times as $time) {
            $all_available_times[] = $time;
        }
        // Return remaining booking times as JSON response
        return $all_available_times;
    }

    /**
     * Create a new booking.
     */
    public function wsbp_booking_info($request)
    {
        $service_id = $request->get_param('id');
        $service = get_post($service_id);
        $service_name = $service->post_title;
        $service_img = get_the_post_thumbnail_url($service->ID, 'thumbnail');
        $service_des =  get_post_meta($service_id, 'wsbp_services_short_des', true);
        $duration = get_post_meta($service_id, 'wsbp_services_duration', true);
        $per_person = get_post_meta($service_id, 'wsbp_num_of_person', true);
        $price = get_post_meta($service_id, 'wsbp_services_price', true);
        $total_price = $price;
        return [
            'service_name' => $service_name,
            'service_des' => $service_des,
            'service_img' => $service_img,
            'duration' => $duration,
            'price' => $total_price,
        ];
    }
}

// Instantiate the class and register the REST API routes.
$wsbp_booking_form_rest_api = new WSBP_Booking_Form_REST_API();
