# smileyFace

---

**Nom de la BD**: bdsmileyface

**Tables**:

Users(idUser, nom, prenom, email, password)

Event(idEvent, nom, date, lieu, departement)

Satisfaction(idSatisfaction, niveauSatisfaction)

-> SatisfactionEmploye
-> SatisfactionEtudiant

---
### Problèmes
-> 1 BD manquantes
SatisfactionEmploye

-> Modifier Satisfaction pour SatisfactionEtudiants

### Rapelles

-> Index.php = liste d'évènement (Nécessite connexion)

->Première page de base sans session = connexion.php

Commandes de bases

 Modifier
 Ajouter
 Supprimer
 Créer_compte (Seulement disponible si connecter pour sécurité)

Un NIP est demander avant chacunes de ces actions

 Afficher -> Renvoie sur une autre page qui affiche les statistiques -->
 Statistiques: employe et etudiants séparé dans la page (ou dans 2 pages différentes)

---
# Remise du projet : 29 septembre