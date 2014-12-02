<?php

/*

Template Name:	        Contact

@name			        Contact Template
@since			        1.0.0
@author			        Pavel Richter <pavel@grandpixels.com>
@copyright		        Copyright (c) 2014, Grand Pixels

*/

// Sidebar
if (gp_option('gp_contact_sidebar') == 'left') {
    $sidebar = gp_option('gp_contact_sidebar');
} else {
    $sidebar = 'left';
}

// Content Class
if (is_active_sidebar('widget-area-contact')) {
    $content_class = 'content-sidebar content-sidebar-' . $sidebar;
} else {
    $content_class = 'content one-entire';
}

// Error Messages
$contact_name_error = __('Please fill your name.', 'gp');
$contact_email_error = __('Please fill your email address.', 'gp');
$contact_email_invalid_error = __('Please fill the valid email address.', 'gp');
$contact_message_error = __('Please fill your message.', 'gp');
$contact_captcha_error = __('Please fill the valid captcha.', 'gp');

// Subject
if (gp_option('gp_form_contact_subject')) {
    $subject = gp_option('gp_form_contact_subject');
} else {
    $subject = __('Contact Form', 'gp');
}

// reCaptcha
$gp_recaptcha = gp_option('gp_form_recaptcha');
$gp_recaptcha_public_key = gp_option('gp_form_recaptcha_public_key');
$gp_recaptcha_private_key = gp_option('gp_form_recaptcha_private_key');

// If WP-reCAPTCHA Plugin Active
if (!is_plugin_active('wp-recaptcha/wp-recaptcha.php') && !class_exists('reCAPTCHA')) {
    get_template_part('forms/lib', 'recaptcha');
}

if (isset($_POST['contact_submitted'])) {

    // Name Validation
    if (trim($_POST['contact_name']) === '') {
        $error_message['contact_name_error'] = $contact_name_error;
        $has_contact_error = true;
    } else {
        $name_field = trim($_POST['contact_name']);
    }

    // Phone Validation
    $phone_field = trim($_POST['contact_phone']);

    // Email Validation
    if (trim($_POST['contact_email']) === '') {
        $error_message['contact_email_error'] = $contact_email_error;
        $has_contact_error = true;
    } else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['contact_email']))) {
        $error_message['contact_email_invalid_error'] = $contact_email_invalid_error;
        $has_contact_error = true;
    } else {
        $email_field = trim($_POST['contact_email']);
    }

    // Message Validation
    if (trim($_POST['contact_message']) === '') {
        $error_message['contact_message_error'] = $contact_message_error;
        $has_contact_error = true;
    } else {
        if (function_exists('stripslashes')) {
            $message_field = stripslashes(trim($_POST['contact_message']));
        } else {
            $message_field = trim($_POST['contact_message']);
        }
    }

    // reCaptcha Validation
    if ($gp_recaptcha == 'true' && !empty($gp_recaptcha_public_key) && !empty($gp_recaptcha_private_key)) {
        $resp = recaptcha_check_answer(
            $gp_recaptcha_private_key,
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]
        );

        if (!$resp->is_valid) {
            $error = $resp->error;
            $has_captcha_error = true;
            $error_message['contact_captcha_error'] = $contact_captcha_error;
        }
    }

    // Recipient
    $to = array(
        gp_option('gp_form_contact_email'),
        $email_field
    );

    if (!isset($to) || ($to == '')) {
        $to = array(
            gp_option('admin_email'),
            $email_field
        );
    }

    if (!isset($has_contact_error) && !isset($has_captcha_error)) {

        $name_title = __('Name:', 'gp');
        $phone_title = __('Phone:', 'gp');
        $email_title = __('Email:', 'gp');
        $message_title = __('Message:', 'gp');

        // Email Template
        $body = "

		<html>
		<body style='font-family:Arial, Verdana, Tahoma, sans-serif;margin:0;padding:0;font-size:12px;color:#50505a;'>
		
			<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f5fa'>
				
				<tr>
					<td style='background:#f5f5fa;' align='center'>
						
						<table width='600' border='0' cellspacing='0' cellpadding='0' bgcolor='#ffffff' style='padding:15px 30px 30px 30px; margin:30px 0;'>
				
							<tr>
								<th colspan='2' style='text-align: left;'><h1 style='font-size:22px;padding-bottom:10px;'>$subject</h1></th>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$name_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$name_field
								</td>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$phone_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$phone_field
								</td>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$email_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$email_field
								</td>
							</tr>
							
							<tr style='border-bottom:1px solid #f5f5fa;'> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$message_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$message_field
								</td>
							</tr>
							
						</table>
						
					</td>
				</tr>
			
			</table>
		
		</body>
		</html>
		
		";

        $headers = array('From: ' . $name_field . ' <' . $email_field . '>', 'Content-Type: text/html', 'Reply-To:' . $email_field);
        $h = implode("\r\n", $headers) . "\r\n";

        wp_mail($to, $subject, $body, $h);
        $has_contact_sent = true;

    }
}

get_header();
?>

<?php get_template_part('title'); ?>

    <?php gp_start('div', 'canvas'); ?>

        <div class="grid">

            <?php
                if ($sidebar == 'left') {
                    if (is_active_sidebar('widget-area-contact')) {
                        get_sidebar('contact');
                    }
                }
            ?>

            <div class="content <?php echo $content_class; ?>" role="main">

            <?php
                // Loop
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        ?>

                        <?php if (!empty($post->post_content)) { ?>

                            <div class="content-page one-entire">
                                <?php the_content(); ?>
                            </div><!-- END // content-page -->

                        <?php } ?>

                        <?php if (isset($has_contact_sent) && $has_contact_sent == true) { ?>

                            <div class="alert success">
                                <h5>
                                    <?php _e('Thank you. Email has been sent. We will contact you as soon as possible.', 'gp'); ?>
                                </h5>
                                <span class="close">&times;</span>
                            </div><!-- END // alert -->

                        <?php } else { ?>

                            <?php if (isset($has_contact_error)) { ?>

                                <div class="alert error">
                                    <h5>
                                        <?php _e('Sorry, an error occurred, email hasn\'t been sent.', 'gp'); ?>
                                    </h5>
                                    <span class="close">&times;</span>
                                </div><!-- END // alert -->

                            <?php } else if (isset($has_captcha_error)) { ?>

                                <div class="alert error">
                                    <h5>
                                        <?php _e('Please fill the valid captcha.', 'gp'); ?>
                                    </h5>
                                    <span class="close">&times;</span>
                                </div><!-- END // alert -->

                            <?php } ?>

                            <form action="<?php the_permalink(); ?>" id="form-contact" class="form" method="post">

                                <fieldset>

                                    <h2><?php _e('Contact form', 'gp'); ?></h2>

                                    <div class="grid">

                                        <div class="input-block one-third">

                                            <label for="contact_name"><?php _e('Name', 'gp'); ?> <span
                                                    class="required-star">*</span></label>

                                            <input name="contact_name" id="contact_name"
                                                   class="required<?php if (isset($error_message['contact_name_error'])) { ?> error<?php } ?>"
                                                   type="text" value="<?php if (isset($_POST['contact_name'])) {
                                                echo $_POST['contact_name'];
                                            } ?>"/>

                                            <?php if (isset($error_message['contact_name_error'])) { ?>

                                                <label for="contact_name"
                                                       class="error"><?php echo $error_message['contact_name_error']; ?></label>

                                            <?php } ?>

                                        </div>
                                        <!-- END // input-block -->

                                        <div class="input-block one-third">

                                            <label for="contact_phone"><?php _e('Phone', 'gp'); ?></label>

                                            <input name="contact_phone" id="contact_phone"  class="<?php if (isset($error_message['contact_phone_error'])) { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['contact_phone'])) { echo $_POST['contact_phone']; } ?>" />

                                            <?php if (isset($error_message['contact_phone_error'])) { ?>
                                                <label for="contact_phone" class="error"><?php echo $error_message['contact_phone_error'] ?></label>
                                            <?php } ?>

                                        </div>
                                        <!-- END // input-block -->

                                        <div class="input-block one-third">

                                            <label for="contact_email"><?php _e('Email', 'gp'); ?> <span
                                                    class="required-star">*</span></label>

                                            <input name="contact_email" id="contact_email"
                                                   class="required email<?php if (isset($error_message['contact_email_error']) || isset($error_message['contact_email_invalid_error'])) { ?> error<?php } ?>"
                                                   type="text" value="<?php if (isset($_POST['contact_email'])) {
                                                echo $_POST['contact_email'];
                                            } ?>"/>

                                            <?php if (isset($error_message['contact_email_error'])) { ?>

                                                <label for="contact_email"
                                                       class="error"><?php echo $error_message['contact_email_error']; ?></label>

                                            <?php } ?>

                                            <?php if (isset($error_message['contact_email_invalid_error'])) { ?>

                                                <label for="contact_email"
                                                       class="error"><?php echo $error_message['contact_email_invalid_error']; ?></label>

                                            <?php } ?>

                                        </div>
                                        <!-- END // input-block -->

                                        <div class="textarea-block one-entire clearfix">

                                            <label for="contact_message"><?php _e('Message', 'gp'); ?> <span
                                                    class="required-star">*</span></label>

                                            <textarea name="contact_message" id="contact_message"
                                                      class="required<?php if (isset($error_message['contact_message_error'])) { ?> error<?php } ?>"
                                                      cols="110" rows="5"><?php if (isset($_POST['contact_message'])) {
                                                    if (function_exists('stripslashes')) {
                                                        echo stripslashes($_POST['contact_message']);
                                                    } else {
                                                        echo $_POST['contact_message'];
                                                    }
                                                } ?></textarea>

                                            <?php if (isset($error_message['contact_message_error'])) { ?>

                                                <label for="contact_message"
                                                       class="error"><?php echo $error_message['contact_message_error']; ?></label>

                                            <?php } ?>

                                        </div>
                                        <!-- END // input-block -->

                                    </div>
                                    <!-- END // grid -->

                                    <?php if ($gp_recaptcha == 'true' && !empty($gp_recaptcha_public_key) && !empty($gp_recaptcha_private_key)) { ?>

                                        <script type="text/javascript">
                                            var RecaptchaOptions = {
                                                theme: 'custom',
                                                custom_theme_widget: 'widget_recaptcha'
                                            };
                                        </script>

                                        <div
                                            class="input-captcha input-block one-third<?php if (isset($error_message['contact_captcha_error'])) { ?> error<?php } ?>">

                                            <div id="widget_recaptcha" style="display: none;">

                                                <div id="recaptcha_image" class="clearfix"></div>
                                                <div class="recaptcha_only_if_incorrect_sol"
                                                     style="color:red"><?php _e('Incorrect please try again', 'gp'); ?></div>

                                                <label for="recaptcha_response_field"
                                                       class="recaptcha_only_if_image"><?php _e('Enter the words above:', 'gp'); ?></label>
                                                <label for="recaptcha_response_field"
                                                       class="recaptcha_only_if_audio"><?php _e('Enter the numbers you hear:', 'gp'); ?></label>

                                                <input type="text" id="recaptcha_response_field" name="recaptcha_response_field"
                                                       class="required<?php if (isset($error_message['contact_captcha_error'])) { ?> error<?php } ?>"/>

                                                <?php if (isset($error_message['contact_captcha_error'])) { ?>

                                                    <label for="recaptcha_response_field"
                                                           class="error"><?php echo $error_message['contact_captcha_error']; ?></label>

                                                <?php } ?>

                                                <div class="rc-icon reload">
                                                    <a href="javascript:Recaptcha.reload()"
                                                       title="<?php _e('Get another CAPTCHA', 'gp'); ?>"><?php _e('Get another CAPTCHA', 'gp'); ?></a>
                                                </div>

                                                <div class="rc-icon switch-audio recaptcha_only_if_image">
                                                    <a href="javascript:Recaptcha.switch_type('audio')"
                                                       title="<?php _e('Get an audio CAPTCHA', 'gp'); ?>"><?php _e('Get an audio CAPTCHA', 'gp'); ?></a>
                                                </div>

                                                <div class="rc-icon switch-text recaptcha_only_if_audio">
                                                    <a href="javascript:Recaptcha.switch_type('image')"
                                                       title="<?php _e('Get an image CAPTCHA', 'gp'); ?>"><?php _e('Get an image CAPTCHA', 'gp'); ?></a>
                                                </div>

                                                <div class="rc-icon help"><a href="javascript:Recaptcha.showhelp()"
                                                                             title="<?php _e('Help', 'gp'); ?>"><?php _e('Help', 'gp'); ?></a>
                                                </div>

                                            </div>

                                            <script type="text/javascript"
                                                    src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $gp_recaptcha_public_key; ?>"></script>

                                            <noscript>
                                                <iframe
                                                    src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $gp_recaptcha_public_key; ?>"
                                                    height="300" width="500" frameborder="0"></iframe>
                                                <br/>
                                                <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
                                                <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
                                            </noscript>

                                        </div>

                                    <?php } ?>

                                    <div class="buttons one-entire clearfix">

                                        <input type="hidden" name="contact_submitted" id="contact_submitted" value="true"/>

                                        <button type="submit" name="button-submit" class="button">
                                            <?php _e('Send email', 'gp'); ?>
                                        </button>

                                        <div class="required-star-info float-right"><span
                                                class="required-star">*</span> <?php _e('Required fields', 'gp'); ?></div>

                                    </div><!-- END // buttons -->

                                </fieldset>

                            </form>

                        <?php } ?>

                    <?php
                    } //while
                } //if
                wp_reset_query();
            ?>

            </div><!-- END // content -->

            <?php
                if ($sidebar == 'right') {
                    if (is_active_sidebar('widget-area-contact')) {
                        get_sidebar('contact');
                    }
                }
            ?>

        </div><!-- END // grid -->

    <?php gp_end('div', 'canvas'); ?>

<?php
get_footer();