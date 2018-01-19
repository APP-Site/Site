<?php

function tableau_bord() { //revoie le tableau de bord
  session_start();
  $code=htmlspecialchars($_SESSION['code']);

  require ('modeles/modele_site.php');
  $pieces = select_piece($code); // sélectionne toute les pieces qui portent le code de l'utilisateur
  require ('vues/vue_ajout_suppression.php');
}

function supprimer_piece($piece){
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  require ('modeles/modele_site.php');
  delete_piece($piece, $code);
  delete_capteur($piece, $code);
  header ('Location: index.php?action=tableau_bord');
}

function rajout_piece($piece) {
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  require ('modeles/modele_site.php');
  insert_piece($piece, $code);
  header ('Location: index.php?action=tableau_bord');
}

function ajout_1() {
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  require ('modeles/modele_site.php');
  $types = select_type();
  $pieces = select_piece($code); // sélectionne toute les pieces qui portent le code de l'utilisateur
  require ('vues/vue_ajout_1.php');
}

function ajout_type($capteur) {
  session_start();
  require ('modeles/modele_site.php');
  $id_capteur = id_type($capteur);
  $_SESSION['capteur'] = $id_capteur; // garder en mémoire le type de capteur sélecctionné
  header ('Location: index.php?action=ajout_2');
}

function ajout_2() {
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  require ('modeles/modele_site.php');
  $pieces_ajout = select_piece($code); // affiche les pieces du client pour ajouter un capteur
  $pieces = select_piece($code); // affiche les pieces du client pour visualisation du tableau de bord
  require ('vues/vue_ajout_2.php');
}

function ajout_piece($piece) {
  session_start();
  $_SESSION['piece'] = $piece; // garder en mémoire le choix de la pièce
  header ('Location: index.php?action=validation_ajout');
}

function validation_ajout(){
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  require ('modeles/modele_site.php');
  $pieces = select_piece($code); // affiche les pieces du client pour visualisation du tableau de bord
  require ('vues/vue_ajout_validation.php');
}

function validation_capteur(){
  session_start();
  $id_capteur = $_SESSION['capteur'];
  $piece = $_SESSION['piece'];
  $code = $_SESSION['code'];
  require ('modeles/modele_site.php');
  ajout_capteur($id_capteur, $piece, $code);
  header ('Location: index.php?action=tableau_bord');
}

function annulation_capteur(){
  session_start();
  unset($_SESSION['capteur'], $_SESSION['piece']);
  header ('Location: index.php?action=tableau_bord');
}

function precedent_capteur(){
  session_start();
  unset($_SESSION['piece']);
  header ('Location: index.php?action=ajout_2');
}

function suppression_1(){
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  require ('modeles/modele_site.php');
  $pieces_ajout = select_piece($code); // affiche les pieces du client pour supprimer un capteur
  $pieces = select_piece($code); // affiche les pieces du client pour visualisation du tableau de bord
  require ('vues/vue_suppression_1.php');
}

function sup_piece($piece){
  session_start();
  $_SESSION['piece'] = $piece;
  header('Location: index.php?action=suppression_2');
}

function suppression_2(){
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  $piece=htmlspecialchars($_SESSION['piece']);
  require ('modeles/modele_site.php');
  $pieces = select_piece($code);
  $types = type($piece, $code);
  require ('vues/vue_suppression_2.php');
}

function sup_type($capteur){
  session_start();
  require('modeles/modele_site.php');
  $id_capteur = id_type($capteur);
  $_SESSION['capteur'] = $id_capteur;
  header('Location: index.php?action=validation_suppression');
}

function validation_suppression(){
  session_start();
  $code=htmlspecialchars($_SESSION['code']);
  require ('modeles/modele_site.php');
  $pieces = select_piece($code); // affiche les pieces du client pour visualisation du tableau de bord
  require ('vues/vue_suppression_validation.php');
}

function valider_sup(){
  session_start();
  $id_capteur = $_SESSION['capteur'];
  $piece = $_SESSION['piece'];
  $code = $_SESSION['code'];
  require ('modeles/modele_site.php');
  suppression_capteur($id_capteur, $piece, $code);
  header ('Location: index.php?action=tableau_bord');
}

function precedent_sup(){
  session_start();
  unset($_SESSION['capteur']);
  header ('Location: index.php?action=suppression_2');
}
