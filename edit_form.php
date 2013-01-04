<?php

class block_verlocity_edit_form extends block_edit_form{
    protected function specific_definition($mform){
        $mform->addElement('header', 'configheader', get_string('blocksettings','block'));
        $mform->addElement('date_selector', 'config_startdate', get_string('startdate','block_verlocity'));
        $mform->addElement('date_selector', 'config_enddate', get_string('enddate','block_verlocity'));
        
    }
}