# QuickDockNet

# Aperçu
Dans cette phase, nous introduisons une mesure de sécurité supplémentaire en ajoutant un captcha à la page de connexion. Cela permet de réduire les risques liés aux attaques par force brute ou aux attaques automatisées. Nous utilisons le projet PureCaptcha de l'OWASP pour implémenter le captcha.

# Instructions
Clonage du Référentiel :

bash

git clone https://github.com/votre-nom/phase-5.git

voici la commande à exécuter pour démarrer l'application :

bash

sudo docker-compose up -d --build

Assurez-vous d'avoir Docker Compose installé sur votre système. Cette commande va construire les conteneurs Docker et démarrer l'application en arrière-plan.
# Ajout du Captcha à la Page de Connexion :

Implémentez le captcha sur la page de connexion pour empêcher les attaques automatisées.
# Test du Fonctionnement du Captcha :

# Assurez-vous que le captcha fonctionne correctement en vérifiant les scénarios suivants :

Lorsque le captcha n'est pas complété, le message d'erreur "Formulaire incomplet" est affiché.

Lorsque le captcha est incorrect, le message d'erreur "Captcha incorrect" est affiché.

Si le captcha n'est pas correct ou n'est pas rempli, la connexion au compte ne doit pas être effectuée.

# Test du Fonctionnement du Captcha :
Vérifiez que le captcha fonctionne correctement :

Lorsque le captcha est réussi, aucun message d'erreur ne doit être affiché.

Lorsque le captcha n'est pas complété ou est incorrect, les messages d'erreur appropriés doivent être affichés.
