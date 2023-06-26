<?php
defined('ABSPATH') || exit;

function fmw_show_whatsapp()
{
    $mm_wa_top_section_text = carbon_get_theme_option('mm_wa_top_section_text');
    $watiosectextcolor = carbon_get_theme_option('mm_wa_top_section_text_color');
    $watiosectbgcolor = carbon_get_theme_option('mm_wa_top_section_background_color');

    // for chat
    $chatbuttonbgcolor = carbon_get_theme_option('mm_wa_chat_btn_background_color');
    $textchatbutton = carbon_get_theme_option('mm_wa_chat_btn_text');
    $textchatbuttoncolor = carbon_get_theme_option('mm_wa_chat_btn_text_color');

    //for call
    $callbuttonbgcolor = carbon_get_theme_option('mm_wa_call_btn_background_color');
    $textcallbutton = carbon_get_theme_option('mm_wa_call_btn_text');
    $textcallbuttoncolor = carbon_get_theme_option('mm_wa_call_btn_text_color');


    $mm_logo_company = carbon_get_theme_option('mm_logo_company');
    if (!empty($mm_logo_company)) {
        $top = '<div id="fmwatop" style="background-color:' . $watiosectbgcolor . '" class="withlogo"><div id="fmwalogo"><img src="' . $mm_logo_company . '" alt="logo"></div><div id="fmwatitle" style="color:' . $watiosectextcolor . '">' . $mm_wa_top_section_text . '</div></div>';
    } else {
        $top = '<div id="fmwatop" style="background-color:' . $watiosectbgcolor . '" class="nologo"><div id="fmwatitle" style="color:' . $watiosectextcolor . '">' . $mm_wa_top_section_text . '</div></div>';
    }
    $mm_wa_toggle_close_background_color = carbon_get_theme_option('mm_wa_toggle_close_background_color');
?>
    <div id="fmwapr" class="active">
        <div id="fmwaclose" class="active fmwatoggle" style="background-color: <?php echo $mm_wa_toggle_close_background_color; ?>;">X</div>
        <div id="fmwaopen" class="inactive fmwatoggle">Chat/Call</div>
        <div id="fmwawr">
            <!-- top section here -->
            <?php echo $top; ?>
            <div id="fmwabot">
                <div class="fmwabotinner">
                    <?php
                    $thewhatsapp = carbon_get_theme_option('mm_multiple_whatsapp');
                    foreach ($thewhatsapp as $wa) {
                        //=========================Scheduling Logic=========================


                        // get status staff work or not
                        $mm_disabled_wa = $wa['mm_disabled_wa'];
                        if ($mm_disabled_wa == true) {
                            $staffstatus = 'disabled';
                        } else {
                            $staffstatus = '';
                        }
                        // get staff name
                        $staffname = $wa['mm_wa_staff_name'];
                        // get staff job
                        $staffjob = $wa['mm_wa_staff_job'];
                        // get staff photo
                        $mm_wa_photo = $wa['mm_wa_photo'];
                        if (empty($mm_wa_photo)) {
                            $file_url = plugin_dir_url(__FILE__) . 'staff.webp';
                            $staffphoto = '<img src="' . $file_url . '" alt="' . $staffname . '">';
                        } else {
                            $staffphoto = $mm_wa_photo;
                            $staffphoto = '<img src="' . $staffphoto . '" alt="' . $staffname . '">';
                        }
                        // get wa staff job
                        $mm_wa_job = $wa['mm_wa_job'];

                        //call only
                        if ($mm_wa_job == 'call') {
                            $callnumb = $wa['mm_phone_numn'];
                            $callnumb = preg_replace('/[^0-9]/', '', $callnumb);
                            $callnumb = preg_replace('/^0/', '+62', $callnumb);
                            $fmwabtns = '<div class="fmwabtns"><div class="fmcallbg" data-call="' . $callnumb . '"  style="background-color:' . $callbuttonbgcolor . '; color:' . $textcallbuttoncolor . '">' . $textcallbutton . '</div></div>';
                        } elseif ($mm_wa_job == 'chat') {
                            // chat only
                            $chatnumb = $wa['mm_wa_numb'];
                            $chatnumb = preg_replace('/[^0-9]/', '', $chatnumb);
                            $chatnumb = preg_replace('/^0/', '62', $chatnumb);
                            $fmwabtns = '<div class="fmwabtns"><div class="fmwabg" data-call="' . $chatnumb . '"  style="background-color:' . $chatbuttonbgcolor . '; color:' . $textcallbuttoncolor . '">' . $textchatbutton . '</div></div>';
                        } elseif ($mm_wa_job == 'call_chat') {
                            // chat and wa
                            // call numb
                            $callnumb = $wa['mm_phone_numn'];
                            $callnumb = preg_replace('/[^0-9]/', '', $callnumb);
                            $callnumb = preg_replace('/^0/', '+62', $callnumb);
                            // wa numb
                            $chatnumb = $wa['mm_wa_numb'];
                            $chatnumb = preg_replace('/[^0-9]/', '', $chatnumb);
                            $chatnumb = preg_replace('/^0/', '62', $chatnumb);
                            $fmwabtns = '<div class="fmwabtns"><div class="fmcallbg" data-call="' . $chatnumb . '"  style="background-color:' . $callbuttonbgcolor . '; color:' . $textcallbuttoncolor . '">' . $textcallbutton . '</div><div class="fmwabg" data-wa="' . $chatnumb . '" style="background-color:' . $chatbuttonbgcolor . '; color:' . $textcallbuttoncolor . '">' . $textchatbutton . '</div></div>';
                        }
                        //=========================Scheduling by day Logic=========================
                        $scheduling_status = $wa['mm_enable_disable_schedule'];
                        if ($scheduling_status == true) {

                            $mm_schedule_wa_by_day = $wa['mm_schedule_wa_by_day'];
                            if ($mm_schedule_wa_by_day == true) {
                                $days = $wa['mm_schedule_wa_by_day']; // this is array
                                $days = implode(',', $days);
                                $current_day = strtolower(date('l'));
                                // if $days contain all then create variable $days with all day
                                if (strpos($days, 'all') !== false) {
                                    $days = 'monday,tuesday,wednesday,thursday,friday,saturday,sunday';
                                } else {
                                    $current_day = $current_day;
                                    $days = $days;
                                }
                            }
                        }


                        //=========================Scheduling by hour logic=========================
                        // $mm_enable_disable_by_hour = $wa['mm_enable_disable_by_hour'];

                        // if ($mm_enable_disable_by_hour == true) {
                        //     $hourschedules = $wa['mm_schedule_wa_hour'];
                        //     $currenttime = date('H.i');
                        //     foreach ($hourschedules as $hs) {
                        //         $starttoend .= $hs['mm_wa_hour_start'] . '-' . $hs['mm_wa_hour_end'] . ', ';
                        //     }
                        //     // $starttoend = rtrim($starttoend, ', ');
                        // } else {
                        //     // wait
                        //     $currenttime = '';
                        //     $starttoend = '';
                        // }

                    ?>
                        <!-- staff item -->
                        <div class="fmwaitem <?php echo $staffstatus; ?>" data-current-day="<?php echo $current_day; ?>" data-schedule-days="<?php echo $days; ?>" data-current-time="<?php echo $currenttime; ?>" data-start-time="<?php echo $starttoend; ?>">
                            <!-- photo or staff left -->
                            <div class="fmwaitemleft">
                                <?php echo $staffphoto; ?>
                            </div>
                            <!-- staff right -->
                            <div class="fmwaitemright">
                                <!-- staff data -->
                                <div class="fmwastaff">
                                    <div class="fmwastaffname"><?php echo $staffname; ?></div>
                                    <div class="fmwastaffjob"><?php echo $staffjob; ?></div>
                                </div>
                                <!-- staff button -->
                                <div class="fmwabtn">
                                    <?php echo $fmwabtns; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
add_action('wp_footer', 'fmw_show_whatsapp', 101);
