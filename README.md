# QuickDockNet

# Aperçu
Dans cette phase, nous renforçons les exigences de mot de passe, ajoutons la fonctionnalité d'activation de compte par e-mail, et permettons aux utilisateurs de changer leur mot de passe en tapant l'ancien. De plus, nous ajoutons un lien dans l'e-mail de confirmation permettant d'activer le compte. Nous utilisons toujours un serveur SMTP pour l'envoi d'e-mails.

# Instructions
Clonage du Référentiel :

bash

git clone https://github.com/votre-nom/phase-3.git

voici la commande à exécuter pour démarrer l'application :

bash

sudo docker-compose up -d --build

Assurez-vous d'avoir Docker Compose installé sur votre système. Cette commande va construire les conteneurs Docker et démarrer l'application en arrière-plan.

# Mise à Jour des Exigences de Mot de Passe :

Les nouveaux mots de passe doivent avoir au moins 12 caractères, incluant au moins une lettre majuscule, un chiffre, et un caractère spécial.

# Activation de Compte par E-mail :

Lorsque toutes les exigences pour la création de compte sont remplies, un e-mail de confirmation est envoyé à l'utilisateur, l'invitant à activer son compte. L'e-mail contient un lien d'activation.

# Page de Changement de Mot de Passe :

Ajoutez une page permettant aux utilisateurs de changer leur mot de passe en tapant l'ancien.

# Test des Fonctionnalités :

Testez la création de compte avec des mots de passe répondant aux nouvelles exigences.
Vérifiez la réception de l'e-mail de confirmation d'activation de compte.
Utilisez la page de connexion pour vous connecter et vérifiez la possibilité de changer votre mot de passe en tapant l'ancien.
Tests

# Réception de l'E-mail de Confirmation d'Activation de Compte :

Vérifiez que lors de la création du compte, un e-mail de confirmation est envoyé à l'adresse e-mail utilisée.

# Changement de Mot de Passe :

Testez la fonctionnalité de changement de mot de passe en tapant l'ancien.
