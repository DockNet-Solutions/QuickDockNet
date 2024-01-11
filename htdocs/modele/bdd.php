<?php

namespace modele;

use ErrorException;
use PDOException;
use PDO;
use Exception;

/**
 *
 *   Class faisant le pont entre la base de donnée et le PHP
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * @license     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

class bdd {

    /**
     * @var PDO instance de la base de donnée
     * @access private
     * @static
     */
    private static $bdd;

    /**
     * Initialise l'instance de la base de donnée
     *
     * @param null
     * @return void
     *
     * @access public
     * @static
     *
     */
    public static function auth() : void {
        try{
            self::$bdd = new PDO('mysql:host='.data::$bddAdresse.';dbname='.data::$bddName.';port='.data::$bddPort, data::$bddUser, data::$bddPassword);
        }catch(PDOException $ex){
            throw new ErrorException("Impossible de se connecter à la base de donné: ".$ex->getMessage(), 1);
            exit();
        }
    }

    /**
     * Renvois l'instance de la base de donnée
     *
     * @param null
     * @return PDO instance
     *
     * @access public
     * @static
     *
     */
    public static function getBdd() : PDO{
        if(isset(self::$bdd)) {
            return self::$bdd;
        } else {
            throw new Exception("bdd.class.php: opération invalide: bdd non initialisé");
        }
    }

    
}