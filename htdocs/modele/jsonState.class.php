<?php 

namespace modele;

/**
 *
 *   Class faisant le pont entre PHP et l'AJAX
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

class jsonState {

    /**
     * @var array Contient toutes les informations à print en JSON
     * @access private
     * @static
     */
    private static $return = [];

    /**
     * Print les informations à renvoyer en JSON sur la page
     *
     * @param null
     * @return void
     *
     * @access public
     * @static
     */
	public static function call() : void {
        header('Content-Type: application/json; charset=utf-8');
	    echo json_encode(self::$return);
	}

    /**
     * Ajouter une entré dans la liste des informations à renvoyer
     *
     * @param String $key
     * @param String $value
     * @return void
     *
     * @access public
     * @static
     */
	public static function returnJson($key, $value) : void {
	    self::$return[$key] = $value;
	}

    /**
     *  Ajouter une entré traiter en notification coté client
     *
     * @param String $status error/warning/success
     * @param String $header Titre de la notification
     * @param String $message Message de la notification
     * @return void
     */
	public static function returnNotif($status, $header, $message = "") : void {
	    self::returnJson("toastr", true);
	    self::returnJson("status", $status);
	    self::returnJson("header", $header);
	    self::returnJson("message", $message);
	}
}