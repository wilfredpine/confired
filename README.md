# [ConfiRed](https://confired.com) (light & basic PHP MVC Framework)

Developed by Wilfred V. Pine © 2020

Version: 1.4.0


## System Configuration

### suit/dev

* config.php - configure environment, base_url

```php
define('ENVIRONMENT', 'development');
//define('ENVIRONMENT', 'production');
define('BASE_URL', 'https://confired.com/');
//define('BASE_URL', 'http://localhost/confired/');
```

* db.php - database configuration

```php
define('DBHOST','localhost');
define('DBNAME','confired');
define('DBUSER','root');
define('DBPASS','');
define('CHARSET','utf8');
define('DBPORT',':3306');
```

* map.php - set routing configuration

```php
// Default controller to load
define('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_METHOD', 'index');

// roouting
Map::site(['Login'=>'Access']);
Map::site(['Logging-in'=>'Access/signing_in']);
Map::site(['Category-list/@any'=>'Category/index/$1']);
```

* startup.php - load services on startup

```php
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
```

## System Controller

### contructor

* if not added to startup

```php
$this->callLibraries(['form']);
$this->callLibraries(['session']);
```
* use Object

```php
$this->form = new Form;
$this->session = new Session;
```

### methods

-POST

* use Object

```php
$this->form->post('username');
$this->session->push(['username'=>'Juan']);
```
 or

* use Static functions associated with the class

```php
Form::post('username');
Session::push(['username'=>'Juan']);
```

* Passing data with model

```php
$data['users'] = $this->access_model->users();
```

* Clean Data before post if not using Form Library

```php
cleanData($_POST['username']);
```

* CSRF

```php
/* generate */
echo CSRFToken();
/* validate */
if(CSRFProtect(cleanData($_POST['token'])))
{
    
}
```

* View

```php
$this->preview('home',$data);
```

* Header Location / redirect

```php
transmit('Access');
```

## System Model

### visit: [phpdelusions](https://phpdelusions.net/pdo)

```php
public function users($id){
    $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);
    return ($query->rowcount() ? $query->fetch() : false);
}
```

## System View

* Sanitize Data

```php
echo Sanitize($data['column']);
```

* External CSS / JS

```php
// require style.css
callCSS(array('style'));
// require custom.js
callJS(array('custom'));
```

* Active page

```php
// active('Home');
<li class="<?php active('Home'); ?>"><a href="">Home</a></li>
```

* Alerts / Notification

```php
notify(); // suit/glob/Notification.php
```

## Create Global functions

* suit/glob/filename.php

```php
// set the functions on startup
// suit/dev/startup.php
define('FUNCTIONS', array('setting','notification','filename'));
```

## Session

```php
Session::pull('username')
Session::push(['name'=>'data','username'=>$username])
```

## License
[MIT](https://github.com/wilfredpine/confired/blob/main/LICENSE)
