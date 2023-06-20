<?php
defined('ABSPATH') || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'fmw_register_fields');
function fmw_register_fields()
{
    Container::make('theme_options', 'FMW Options')
        ->add_fields([
            //=========================Enable or disable plugin=========================
            Field::make('checkbox', 'mm_multiple_whatsapp_status', 'Enable/Disable')
                ->set_default_value(false),

            //=========================upload custom logo (optional for user)=========================
            Field::make('separator', 'stylingsep', 'Top Section')
                ->set_classes('cbseparator'),


            // logo company
            Field::make('image', 'mm_logo_company', 'Logo Perusahaan')
                ->set_help_text('Optional you can Upload your company logo here or leave it blank if you dont want to use logo. logo will show at the top of the whatsapp chat box. Ukuran logo yang disarankan 50px x 50px')
                ->set_value_type('url')
                ->set_conditional_logic([
                    [
                        'field' => 'mm_multiple_whatsapp_status',
                        'value' => true,
                    ],
                ]),

            Field::make('text', 'mm_wa_top_section_text', 'Top Section Text')
                ->set_width(33)
                ->set_default_value('Hubungi Kami')
                ->set_help_text('Change the text of the top section e,g: Hubungi Kami, Chat Kami, Contact Us, etc'),

            // background color for top section
            Field::make('color', 'mm_wa_top_section_background_color', 'Background Color')
                ->set_width(33)
                ->set_default_value('#016400')
                ->set_help_text('Change the background color of the top section'),

            // text color for top section
            Field::make('color', 'mm_wa_top_section_text_color', 'Text Color')
                ->set_width(33)
                ->set_default_value('#ffffff')
                ->set_help_text('Change the text color of the top section'),

            // Toggle Open Chat Text
            Field::make('text', 'mm_wa_toggle_open_chat_text', 'Toggle Open Chat Text')
                ->set_width(33)
                ->set_default_value('Chat/Call'),

            // background color for close chat button
            Field::make('color', 'mm_wa_toggle_close_background_color', 'Toggle Close Chat Background Color')
                ->set_width(33)
                ->set_default_value('#8B0207')
                ->set_help_text('Change the background color of the toggle close chat button'),


            //=========================Whatsapp staff input=========================

            Field::make('separator', 'whatsappitemsep', 'Staff Whatsapp')
                ->set_classes('cbseparator'),
            Field::make('complex', 'mm_multiple_whatsapp', 'Multiple Whatsapp')
                ->set_conditional_logic([
                    [
                        'field' => 'mm_multiple_whatsapp_status',
                        'value' => true,
                    ],
                ])
                ->add_fields('mm_multiple_whatsapp_fields', 'Staff', [

                    //=========================enable/disable staff=========================
                    Field::make('checkbox', 'mm_disabled_wa', 'Disable Staff')
                        ->set_default_value(false)
                        ->set_help_text('Check this box to disable this staff'),

                    //=========================Enable or disable schedule seperator=========================
                    Field::make('separator', 'schedulesep', 'Schedule')
                        ->set_classes('cbseparator'),
                    //=========================Enable or disable schedule=========================
                    Field::make('checkbox', 'mm_enable_disable_schedule', 'Enabling or disabling schedule')
                        ->set_default_value(false)
                        ->set_help_text('Check this box to enable or disable schedule for this staff'),

                    //=========================enabling disabling by day=========================
                    Field::make('checkbox', 'mm_enable_disable_by_day', 'Enabling or disabling schedule by day')
                        ->set_default_value(false)
                        ->set_help_text('Check this box to enable or disable schedule for this staff')
                        ->set_conditional_logic([
                            [
                                'field' => 'mm_enable_disable_schedule',
                                'value' => true,
                            ],
                        ]),

                    //=========================Scheduling Staff by day=========================
                    Field::make('multiselect', 'mm_schedule_wa_by_day', 'Enabling staff by day')
                        ->set_help_text('Only staff that enabled on selected day will show on the website')
                        ->add_options([
                            'all' => 'All Days',
                            'monday' => 'Monday',
                            'tuesday' => 'Tuesday',
                            'wednesday' => 'Wednesday',
                            'thursday' => 'Thursday',
                            'friday' => 'Friday',
                            'saturday' => 'Saturday',
                            'sunday' => 'Sunday',
                        ])
                        ->set_default_value(['all'])
                        ->set_conditional_logic([
                            [
                                'field' => 'mm_enable_disable_by_day',
                                'value' => true,
                            ],
                        ]),
                    //=========================enabling disabling by hour=========================
                    // Field::make('checkbox', 'mm_enable_disable_by_hour', 'Enabling or disabling schedule by hour')
                    //     ->set_default_value(false)
                    //     ->set_help_text('Check this box to enable or disable schedule for this staff')
                    //     ->set_conditional_logic([
                    //         [
                    //             'field' => 'mm_enable_disable_schedule',
                    //             'value' => true,
                    //         ],
                    //     ]),

                    //=========================Scheduling staff by hour=========================
                    // Field::make('complex', 'mm_schedule_wa_hour', 'Staff working hour')
                    //     ->set_max(5)
                    //     ->set_help_text('Set the working hour of this staff')
                    //     ->add_fields('mm_schedule_wa_hour_fields', 'Disable Staff Scheduling', [
                    //         Field::make('text', 'mm_wa_hour_start', 'Start Disable Staff on')
                    //             ->set_attribute('type', 'number')
                    //             ->set_width(50)
                    //             ->set_help_text('Set disable to staff from e,g 01.00 or 02.00 or 02.30 or 03.30 or 10.00 or 10.30'),
                    //         Field::make('text', 'mm_wa_hour_end', 'To')
                    //             ->set_attribute('type', 'number')
                    //             ->set_width(50)
                    //             ->set_help_text('Until this time e,g 01.00 or 02.00 or 02.30 or 03.30 or 10.00 or 10.30'),
                    //     ])
                    //     ->set_conditional_logic([
                    //         [
                    //             'field' => 'mm_enable_disable_by_hour',
                    //             'value' => true,
                    //         ],
                    //     ]),


                    //=========================Seperator whatsapp staff=========================
                    Field::make('separator', 'datastafsep', 'Staff Data')
                        ->set_classes('cbseparator'),


                    //=========================select staff job=========================
                    Field::make('select', 'mm_wa_job', 'Jobs')
                        ->add_options([
                            'call' => 'Call',
                            'chat' => 'Chat',
                            'call_chat' => 'Call & Chat',
                        ])
                        ->set_help_text('Select the job of this staff')
                        ->set_default_value('call_chat'),

                    //=========================insert whatsapp number=========================

                    Field::make('text', 'mm_wa_numb', 'Nomor Whatsapp')
                        ->set_width(50)
                        ->set_help_text('Enter the whatsapp number of this staff e.g 0813-9891-2341')
                        ->set_conditional_logic([
                            'relation' => 'OR',
                            [
                                'field' => 'mm_wa_job',
                                'value' => 'chat',
                            ],
                            [
                                'field' => 'mm_wa_job',
                                'value' => 'call_chat',
                            ],
                        ]),

                    //=========================inser phone number=========================

                    Field::make('text', 'mm_phone_numn', 'Nomor Telepon')
                        ->set_width(50)
                        ->set_help_text('Enter the whatsapp number of this staff e.g 0813-9891-2341')
                        ->set_conditional_logic([
                            'relation' => 'OR',
                            [
                                'field' => 'mm_wa_job',
                                'value' => 'call',
                            ],
                            [
                                'field' => 'mm_wa_job',
                                'value' => 'call_chat',
                            ],
                        ]),

                    //=========================optional upload photo=========================

                    Field::make('image', 'mm_wa_photo', 'Photo')
                        ->set_width(33)
                        ->set_help_text('Upload the photo of this staff if empty will use default photo from plugin')
                        ->set_value_type('url'),

                    //=========================insert staff name=========================
                    Field::make('text', 'mm_wa_staff_name', 'Nama Staff')
                        ->set_width(33)
                        ->set_help_text('Enter the name of this staff e,g John Doe'),

                    //=========================insert staff job=========================
                    Field::make('text', 'mm_wa_staff_job', 'Jabatan Staff')
                        ->set_width(33)
                        ->set_help_text('Enter the job of this staff e.g Customer Service'),

                ])
                ->set_layout('tabbed-horizontal'),
        ]);
}
