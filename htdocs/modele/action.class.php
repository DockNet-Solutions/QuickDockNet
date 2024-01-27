<?php
namespace modele;

/**
 *
 *   Class permettant l'automatisation de l'appel des fichiers d'actions sur le site web
 *
 *
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

class action {

    /**
     * Invoque le fichier PHP correspondant à l'action si une action est appelé dans les paramètres d'URL
     * Si une action est appelé, le script PHP s'arrète juste après et renvois des informations en JSON pour un
     * traitement en AJAX.
     * @see jsonState
     *
     * @param null
     * @return void
     *
     * @access public
     * @static
     */
    public static function invoke() : void {
        if(isset($_GET['action'])) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            switch($_GET['action']) {
                case 'register':
                    include("actions/register.php");
                    jsonState::call();
                    exit();
                case 'login':
                    include("actions/login.php");
                    jsonState::call();
                    exit();
                case 'changePassword':
                    include("actions/changePassword.php");
                    jsonState::call();
                    exit();
                case 'activateAccount':
                    include("actions/activateAccount.php");
                    exit();
                case 'recoverPassword':
                    include("actions/recoverPassword.php");
                    jsonState::call();
                    exit();
                case 'generateRecoverPassword':
                    include("actions/generateRecoverPassword.php");
                    jsonState::call();
                    exit();
                default:
                    header('Location: index.php?page=404');
            }
        }
    }
}