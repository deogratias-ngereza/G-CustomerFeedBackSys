<?php
namespace App\Models\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Settings\Php\Settings;


class Database {

    public function __construct($db_connector) {

        $conn_settings = null;
        $conn_settings = $this->getConnectionString($db_connector);


        //initiate the connection to the DB
        $capsule = new Capsule;
        $capsule->addConnection($conn_settings);
        $capsule->addConnection($this->getConnectionString('grand_bulk_sms'), 'db2');
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

    }

    public function getConnectionString($option){
        $conn_settings = null;
        switch ($option) {
            case 'grand_feedback_sys':
                $conn_settings = [ 
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'grand_feedback_sys',
                    'username' => 'grand','port'=>3306,
                    'password' => 'password',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                ];
                break;
            case 'grand_queue_manager':
                $conn_settings = [ 
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'grand_queue_manager',
                    'username' => 'grand','port'=>3306,
                    'password' => 'password',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                ];
                break;
            case 'grand_bulk_sms':
                $conn_settings = [ 
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'grand_bulk_sms',
                    'username' => 'grand','port'=>3306,
                    'password' => 'password',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                ];
                break;
            default:
                # code...
                break;
        }
        return $conn_settings;
    }



}