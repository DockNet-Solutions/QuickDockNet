# QuickDockNet

Dans cette phase, nous ajoutons la fonctionnalité de connexion avec une page "Login" et intégrons un serveur SMTP pour l'envoi d'e-mails. Nous utilisons un nom de domaine personnel sur OVH avec une offre e-mail pour utiliser le serveur SMTP fourni par celui-ci. Côté PHP, nous utilisons la librairie PHPMailer.

# Installation Locale

Clonage du Référentiel :

```bash
git clone https://github.com/votre-nom/phase-2.git
```

Commande à exécuter pour démarrer l'application :

```bash
sudo docker-compose up -d --build
```

Assurez-vous d'avoir `Docker Compose` installé sur votre système. Cette commande va construire les conteneurs Docker et démarrer l'application en arrière-plan.

# Configuration de l'Environnement SMTP :

Utilisez un nom de domaine personnel sur OVH avec une offre e-mail pour configurer le serveur SMTP.

Configurez les paramètres SMTP dans `config.php`. Fournissez l'adresse SMTP, le nom d'utilisateur, le mot de passe et le port SMTP.

# Utilisation de PHPMailer :

Utilisez la librairie `PHPMailer` pour envoyer des e-mails de confirmation lors de la création de compte.

# Ajout de la Page de Connexion :

Ajoutez une page `Login` pour permettre aux utilisateurs de se connecter à leur compte.

# Test de la Connexion :

Utilisez la page de connexion pour vous connecter avec le compte créé lors de la phase précédente.

# Réception du Mail de Confirmation de Création de Compte :

Lors de la création du compte, un e-mail de confirmation doit être envoyé à l'adresse e-mail utilisée. Vérifiez la réception de cet e-mail.

# Connexion Utilisant la Page Login :

Utilisez la page de connexion pour vous connecter avec le compte créé précédemment.
