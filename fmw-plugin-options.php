<?php
defined('ABSPATH') || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'fmw_register_fields');
function fmw_register_fields()
{
    Container::make('theme_options', 'FMW Options')
        ->add_fields([
            Field::make('checkbox', 'mm_multiple_whatsapp_status', 'Enable/Disable')
                ->set_default_value(false),
            Field::make('complex', 'mm_multiple_whatsapp', 'Multiple Whatsapp')
                ->set_conditional_logic([
                    [
                        'field' => 'mm_multiple_whatsapp_status',
                        'value' => true,
                    ],
                ])
                ->add_fields('mm_multiple_whatsapp_fields', 'Staff', [
                    Field::make('checkbox', 'mm_disabled_wa', 'Disable Staff')
                        ->set_default_value(false)
                        ->set_help_text('Check this box to disable this staff'),
                    Field::make('select', 'mm_wa_job', 'Jobs')
                        ->add_options([
                            'call' => 'Call',
                            'chat' => 'Chat',
                            'call_chat' => 'Call & Chat',
                        ])
                        ->set_help_text('Select the job of this staff')
                        ->set_default_value('call_chat'),
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
                    Field::make('image', 'mm_wa_photo', 'Photo')
                        ->set_width(33)
                        ->set_help_text('Upload the photo of this staff if empty will use default photo from plugin')
                        ->set_value_type('url'),
                    Field::make('text', 'mm_wa_staff_name', 'Nama Staff')
                        ->set_width(33)
                        ->set_help_text('Enter the name of this staff e,g John Doe'),
                    Field::make('text', 'mm_wa_staff_job', 'Jabatan Staff')
                        ->set_width(33)
                        ->set_help_text('Enter the job of this staff e.g Customer Service'),

                ])
                ->set_layout('tabbed-horizontal'),
        ]);
}
