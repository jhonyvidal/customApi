<?php

add_action(
	'wp_enqueue_scripts',
	function () {

            wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true);

            wp_register_script(
                'TRMScript',
                wptrm_plugin_url( 'includes/js/script.js' ),
                array (),
                '1.0',
                true
            );

            wp_localize_script('TRMScript','ajaxConsultaApi',
                ['url'=>content_url('/plugins/customApi/includes/ConsultaController.php')]
            );

            wp_register_style(
                'TRMStyle',
                wptrm_plugin_url( 'includes/css/styles.css' ),
                array(),
                '1.0',
                'all'
            );

          
            
            wp_enqueue_style( 'TRMStyle' );
            wp_enqueue_script( 'TRMScript' );

        },
        10, 0
    );



    
