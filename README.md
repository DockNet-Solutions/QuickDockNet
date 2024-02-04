# QuickDockNet

# Aperçu
Dans cette phase, nous ajoutons une fonctionnalité permettant aux utilisateurs de réinitialiser leur mot de passe s'ils l'ont oublié. Cela inclut l'ajout d'une nouvelle page "Mot de Passe Oublié" et la mise en place d'un système d'envoi d'e-mails contenant un lien pour définir un nouveau mot de passe.

# Instructions
Clonage du Référentiel :

bash

git clone https://github.com/votre-nom/phase-4.git

voici la commande à exécuter pour démarrer l'application :

bash

sudo docker-compose up -d --build

Assurez-vous d'avoir Docker Compose installé sur votre système. Cette commande va construire les conteneurs Docker et démarrer l'application en arrière-plan.

# Ajout de la Page "Mot de Passe Oublié" :

Ajoutez une nouvelle page permettant aux utilisateurs de réinitialiser leur mot de passe en cas d'oubli.
# Fonctionnalité de Réinitialisation du Mot de Passe :

Lorsque l'utilisateur utilise la page "Mot de Passe Oublié", un e-mail contenant un lien unique est envoyé à l'adresse e-mail associée au compte. Ce lien permet à l'utilisateur de définir un nouveau mot de passe.
# Gestion des Demandes de Changement de Mot de Passe :

Ajoutez une ligne dans la base de données pour chaque demande de changement de mot de passe, contenant un identifiant unique, un token unique pour la sécurité, l'adresse e-mail associée à la demande, la date de création de la demande, et l'identifiant de l'utilisateur.
# Génération du Token Aléatoire :

Utilisez une fonction pour générer un token aléatoire sécurisé à utiliser dans le lien de réinitialisation du mot de passe.
# Test de la Fonctionnalité :

Testez le fonctionnement de la page "Mot de Passe Oublié" en vérifiant que l'e-mail de réinitialisation est envoyé avec succès.
Tests
# Fonctionnement de la Page "Mot de Passe Oublié" :
Testez le fonctionnement de la page d'oubli de mot de passe avec l'envoi d'un lien par e-mail pour définir le nouveau mot de passe.
