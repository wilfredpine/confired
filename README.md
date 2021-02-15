ConfiRed (light & basic PHP MVC Framework)
Developed by Wilfred V. Pine © 2020
Version: 1.4.0

System Configuration
    suit/dev
        config.php - configure environment, base_url
        db.php - database configuration info
        map.php - set routing configuration
            // Default controller to load
            define('DEFAULT_CONTROLLER', 'Home');
            define('DEFAULT_METHOD', 'index');
            //
            Map::site(['Login'=>'Access']);
            Map::site(['Logging-in'=>'Access/signing_in']);
            Map::site(['Category-list/@any'=>'Category/index/$1']);
        startup.php - load services on startup
            // Models
            define('MODELS', array('access'));
            // Helpers
            define('HELPERS', array('page_url','session'));
            // Addons
            define('ADD_ON', array());
            // Libraries
            define('LIBRARIES', array('protection','form'));
            // Function
            define('FUNCTIONS', array('setting','notification','filename'));

System Controller
    contruct
        #if not added to startup
            $this->callLibraries(['form']);
            $this->callLibraries(['session']);

        /* 1. use Object */

            $this->form = new Form;
            $this->session = new Session;

            ex: $this->form->post('username');
                $this->session->push(['username'=>'Juan']);

        /* 2. Static functions associated with the class */

            ex: Form::post('username');
                Session::push(['username'=>'Juan']);

    Passing data with model
        $data['users'] = $this->access_model->users();

    Clean Data before post
        cleanData($_POST['username']);

    CSRF
        // generate
        CSRFToken();
        // validate
        if(CSRFProtect(cleanData($_POST['token'])))

    GUI
        $this->preview('home',$data);

    Header Location
        transmit('Access');

System Model
    public function users($id){
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }
    visit: https://phpdelusions.net/pdo

System View
    Sanitize Data
        echo Sanitize($data['column']);

    External CSS / JS
        // require style.css
        callCSS(array('style'));
        // require custom.js
        callJS(array('custom'));

    Active page
        // active('Home');
        <li class="<?php active('Home'); ?>"><a href="">Home</a></li>

    Notification
        notify(); // suit/glob/Notification.php

Create Global functions
    suit/glob/filename.php
    // set the functions on startup
        // suit/dev/startup.php
            define('FUNCTIONS', array('setting','notification','filename'));

Session
    Session::pull('username')
    Session::push(['name'=>'data','username'=>$username])

