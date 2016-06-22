<?php

/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 05/11/2015
 * Time: 15:55
 */
abstract class class_demandes
{
    public $code_dbs;
    public $code_emp;
    public $date_dbs;
    public $objets_dbs;
    public $statut;

    abstract protected function enregistrement();

    abstract protected function recuperation($code);

    /*abstract protected function modification($code);*/

    abstract protected function suppression($code);
}

class demandes extends class_demandes
{
    function __construct()
    {
        $this->code_dbs = "";
        $this->code_emp = "";
        $this->date_dbs = date("Y/m/d");
        $this->objets_dbs = "";
        $this->statut = "non satisfaite";
    }

    function recuperation($code_emp)
    {
        $this->code_dbs = htmlspecialchars($_POST['code_dbs'], ENT_QUOTES);
        $this->code_emp = $code_emp;
        $this->objets_dbs = htmlspecialchars($_POST['objets_dbs'], ENT_QUOTES);

        return TRUE;
    }

    function afficher()
    {
        echo $this->code_dbs;
        echo '<br>';
        echo $this->code_emp;
        echo '<br>';
        echo $this->date_dbs;
        echo '<br>';
        echo $this->objets_dbs;
        echo '<br>';
        echo $this->statut;
        echo '<br>';
    }

    function enregistrement()
    {
        $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

        if ($connexion->connect_error)
            die($connexion->connect_error);

        $sql = "INSERT INTO demandes (code_dbs, code_emp, date_dbs, objets_dbs, statut)
	            VALUES ('$this->code_dbs', '$this->code_emp', '$this->date_dbs', '$this->objets_dbs', '$this->statut')"; //print_r($sql);

        if ($result = mysqli_query($connexion, $sql))
            return TRUE;
        else
            return FALSE;
    }

    /*function modification($code)
    {

    }*/

    function suppression($code)
    {
        $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

        if ($connexion->connect_error)
            die($connexion->connect_error);

        $sql = "DELETE FROM demandes WHERE code_dbs = '" . $code . "'";

        if ($result = mysqli_query($connexion, $sql))
            return TRUE;
        else
            return FALSE;
    }
}

class details_demandes extends demandes
{
    protected $code_dd;
    protected $nature_dd;
    protected $libelle_dd;
    protected $qte_dd;
    protected $observations_dd;

    function recuperation_details($code_dbs, $i)
    {
        $this->code_dbs = $code_dbs;
        $this->nature_dd = htmlspecialchars($_POST['nature'][$i], ENT_QUOTES);
        $this->libelle_dd = htmlspecialchars($_POST['libelle'][$i], ENT_QUOTES);
        $this->qte_dd = htmlspecialchars($_POST['qte'][$i], ENT_QUOTES);
        $this->observations_dd = htmlspecialchars($_POST['obv'][$i], ENT_QUOTES);

        return TRUE;
    }

    function afficher_details()
    {
        echo $this->code_dd;
        echo '<br>';
        echo $this->code_dbs;
        echo '<br>';
        echo $this->nature_dd;
        echo '<br>';
        echo $this->libelle_dd;
        echo '<br>';
        echo $this->qte_dd;
        echo '<br>';
        echo $this->observations_dd;
        echo '<br>';
    }

    function enregistrement()
    {
        $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

        if ($connexion->connect_error)
            die($connexion->connect_error);

        $req = "SELECT code_dd FROM details_demande ORDER BY code_dd DESC LIMIT 1";
        $res = $connexion->query($req);

        if ($res->num_rows > 0) {
            $ligne = $res->fetch_all(MYSQL_ASSOC);

            //reccuperation du code
            $code_dd = "";
            foreach ($ligne as $data) {
                $code_dd = stripslashes($data['code_dd']);
            }

            //extraction des 4 derniers chiffres
            $code_dd = substr($code_dd, -4);

            //incrementation du nombre
            $code_dd += 1;
        } else {
            //s'il n'existe pas d'enregistrements dans la base de données
            $code_dd = 1;
        }

        $b = "DD";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $resultat = $dat . "" . $b . "" . sprintf($format, $code_dd);
        //on affecte au code le resultat
        $this->code_dd = $resultat;

        $sql = "INSERT INTO details_demande (code_dd, nature_dd, code_dbs, libelle_dd, qte_dd, observations_dd)
	                    VALUES ('$this->code_dd', '$this->nature_dd', '$this->code_dbs', '$this->libelle_dd', '$this->qte_dd', '$this->observations_dd')";
//        print_r($sql);

        //exécution de la requète REQ:
        if ($result = mysqli_query($connexion, $sql)) {
            return TRUE;
        } else
            return FALSE;
    }
}