# Kuru’s Shop (Merlin-E6)

Une plateforme e-commerce légère permettant de consulter un catalogue de voitures de luxe, de gérer un panier, et d’accéder à des espaces utilisateur et administrateur.

---

## 📋 Table des matières

1. [Fonctionnalités](#fonctionnalités)  
2. [Prérequis](#prérequis)  
3. [Installation & démarrage](#installation--démarrage)  
4. [Structure du projet](#structure-du-projet)  
5. [Usage](#usage)  
6. [Technologies](#technologies)  
7. [Sécurité & bonnes pratiques](#sécurité--bonnes-pratiques)  
8. [Auteur & support](#auteur--support)  

---

## 🚀 Fonctionnalités

- **Catalogue interactif**  
  - Grille responsive avec filtres (marque, type de carburant, prix)  
  - Carte produit : image, nom, prix, bouton “Ajouter au panier” aligné en bas  
- **Gestion du panier**  
  - Ajout / suppression d’articles  
  - Vue d’ensemble et passage de commande  
- **Espace utilisateur**  
  - Inscription / connexion  
  - Modification du profil (nom, email, mot de passe)  
- **Espace administrateur**  
  - Dashboard global (utilisateurs, produits, commandes)  
  - Création, édition et suppression de contenus (produits, commandes, etc.)  
- **Layout commun**  
  - Navbar et footer dynamiques selon le statut (invité, connecté, admin)  
  - Arrière-plan graphique multi-dégradés  

---

## ⚙️ Prérequis

- Environnement PHP ≥ 7.4 + extension PDO  
- MySQL / MariaDB  
- Serveur local (Wamp64, XAMPP…)  
- Navigateur moderne (Chrome, Firefox, Edge, Safari…)  

---

## 📥 Installation & démarrage

1. **Cloner le dépôt**  
   ```bash
   git clone https://github.com/kuru05/E6-Leger.git
   cd E6-Leger
