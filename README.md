# QuickDockNet

Ce référentiel contient la mise en œuvre de la Phase 1 du projet. L'objectif de cette phase est de configurer la fonctionnalité d'enregistrement des utilisateurs et de l'intégrer à une base de données MySQL nommée docknet. Nous utilisons PDO (PHP Data Objects) pour la connectivité à la base de données.

Instructions
Clonez le référentiel sur votre machine locale :

bash
Copy code
git clone https://github.com/votre-nom/phase-1.git
Importez le fichier SQL base.sql dans votre base de données MySQL docknet. Ce fichier contient la structure de la table users.

Assurez-vous que votre environnement serveur respecte les exigences suivantes :

PHP installé (version 7.0 ou supérieure recommandée)
MySQL installé
Extension PDO activée dans PHP
Configurez la connexion à la base de données dans config.php. Fournissez les identifiants nécessaires tels que le nom d'hôte, le nom de la base de données, le nom d'utilisateur et le mot de passe.

voici la commande à exécuter pour démarrer l'application :

bash
sudo docker-compose up -d --build
Assurez-vous d'avoir Docker Compose installé sur votre système. Cette commande va construire les conteneurs Docker et démarrer l'application en arrière-plan.

Accédez à localhost/register pour accéder à la page d'inscription au compte.

Testez le processus d'inscription :

Essayez de vous inscrire avec un mot de passe de moins de 8 caractères. Assurez-vous que le message d'erreur "Formulaire incomplet" est affiché.
Inscrivez-vous avec un mot de passe contenant 8 caractères mais sans au moins une lettre majuscule et un chiffre. Vérifiez que le message d'erreur approprié est affiché.
Inscrivez-vous avec un mot de passe répondant à toutes les exigences. Confirmez que le message "Inscription réussie" est affiché et que le compte est stocké dans la base de données.
