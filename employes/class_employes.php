<?php

    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 14-Sep-15
     * Time: 3:43 PM
     */
    abstract class class_employes
    {
        protected $code_emp;
        protected $titre_emp;
        protected $nom_emp;
        protected $prenoms_emp;
        protected $fonction_emp;
        protected $departement_emp;
        protected $email_emp;
        protected $mdp;
        protected $tel_emp;
        protected $etat_connecte;
        protected $connexion;

        abstract protected function enregistrement();
        abstract protected function recuperation();
        abstract protected function modification($code);
        abstract protected function suppression($code);
    }

    class employes extends class_employes
    {
        /**
         * Initialisation d'un objet sans paramètres
         */

        function __construct()
        {
            $this->code_emp = "";
            $this->titre_emp = "";
            $this->nom_emp = "";
            $this->prenoms_emp = "";
            $this->fonction_emp = "";
            $this->departement_emp = "";
            $this->email_emp = "";
            $this->mdp = "ncare";
            $this->tel_emp = "";
            $this->etat_connecte = "0";
        }

        /**
         * Initialisation d'un objet à partir de plusieurs paramètres
         *
         * @param $code_emp
         * @param $nom_emp
         * @param $prenoms_emp
         * @param $fonction_emp
         * @param $departement_emp
         * @param $email_emp
         * @param $mdp
         * @param $tel_emp
         * @param $etat_connecte
         */
        function __construct1($code_emp, $nom_emp, $prenoms_emp, $fonction_emp, $departement_emp, $email_emp, $mdp, $tel_emp, $etat_connecte)
        {
            $this->code_emp = $code_emp;
            $this->nom_emp = $nom_emp;
            $this->prenoms_emp = $prenoms_emp;
            $this->fonction_emp = $fonction_emp;
            $this->departement_emp = $departement_emp;
            $this->email_emp = $email_emp;
            $this->mdp = $mdp;
            $this->tel_emp = $tel_emp;
            $this->etat_connecte = $etat_connecte;
        }

        function recuperation()
        {
            $this->titre_emp = htmlspecialchars($_POST['titre_emp'], ENT_QUOTES);
            $this->nom_emp = htmlspecialchars($_POST['nom_emp'], ENT_QUOTES);
            $this->prenoms_emp = htmlspecialchars($_POST['prenoms_emp'], ENT_QUOTES);
            $this->fonction_emp = htmlspecialchars($_POST['fonction_emp'], ENT_QUOTES);
            $this->departement_emp = htmlspecialchars($_POST['departement_emp'], ENT_QUOTES);
            $this->email_emp = htmlspecialchars($_POST['email_emp'], ENT_QUOTES);
            $this->tel_emp = htmlspecialchars($_POST['tel_emp'], ENT_QUOTES);

            return TRUE;
        }

        function afficher()
        {
            echo $this->titre_emp; echo '<br>';
            echo $this->nom_emp; echo '<br>';
            echo $this->prenoms_emp; echo '<br>';
            echo $this->fonction_emp; echo '<br>';
            echo $this->departement_emp; echo '<br>';
            echo $this->email_emp; echo '<br>';
            echo $this->tel_emp; echo '<br>';
        }

        function motdepasse($mdp) {
            $this->mdp = $mdp;
        }

        function enregistrement()
        {
            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            //On vérifie s'il y a un en registrement dans la base de données
            $req = "SELECT code_emp FROM employes ORDER BY code_emp DESC LIMIT 1";
            $resultat = $connexion->query($req);

            if ($resultat->num_rows > 0) {
                $ligne = $resultat->fetch_all(MYSQL_ASSOC);

                //reccuperation du code
                $code_emp = "";
                foreach ($ligne as $data) {
                    $code_emp = stripslashes($data['code_emp']);
                }

                //extraction des 4 derniers chiffres
                $code_emp = substr($code_emp, -4);

                //incrementation du nombre
                $code_emp += 1;
                //echo $resultat;
            } else {
                //s'il n'existe pas d'enregistrements dans la base de données
                $code_emp = 1;
            }
            $b = "EMP";
            $dat = date("Y");
            $dat = substr($dat, -2);
            $format = '%04d';
            $resultat = $dat . "" . $b . "" . sprintf($format, $code_emp);

            //on affecte au code le resultat
            $this->code_emp = $resultat;

            $sql = "INSERT INTO employes (code_emp, titre_emp, nom_emp, prenoms_emp, fonction_emp, departement_emp, email_emp, mdp, tel_emp)
                    VALUES ('$this->code_emp', '$this->titre_emp', '$this->nom_emp', '$this->prenoms_emp', '$this->fonction_emp', '$this->departement_emp', '$this->email_emp', '$this->mdp', '$this->tel_emp')";

            //exécution de la requête SQL:
//            $result = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
            if ($result = mysqli_query($connexion, $sql)) {
                return TRUE;
            } else
                return FALSE;
        }

        function modification($code)
        {
            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            $sql = "UPDATE employes SET
            titre_emp = '" . $this->titre_emp . "',
            nom_emp = '" . $this->nom_emp . "',
            prenoms_emp = '" . $this->prenoms_emp . "',
            fonction_emp = '" . $this->fonction_emp . "',
            departement_emp = '" . $this->departement_emp . "',
            email_emp = '" . $this->email_emp . "',
            tel_emp = '" . $this->tel_emp . "'
            WHERE code_emp = '" . $code . "'";

            if ($result = mysqli_query($connexion, $sql))
                return TRUE;
            else
                return FALSE;
        }

        function suppression($code) {
            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            $sql = "DELETE FROM employes WHERE code_emp = '" . $code . "'"; //print_r($sql);

            if ($result = mysqli_query($connexion, $sql))
                return TRUE;
            else
                return FALSE;
        }
    }