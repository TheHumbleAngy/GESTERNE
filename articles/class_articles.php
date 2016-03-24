<?php

    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 30/11/2015
     * Time: 11:34
     */
    abstract class class_articles
    {
        public $code_art;
        public $designation_art;
        public $date_art;
        public $code_grp;
        public $description_art;
        public $stock_art;
        public $niveau_reappro_art;
        public $niveau_cible_art;

        abstract protected function recuperation();

        abstract protected function enregistrement();

        abstract protected function modification($code);

        abstract protected function suppression($code);
    }

    class articles extends class_articles
    {
        function recuperation()
        {
            $this->code_art = htmlspecialchars($_POST['code_art'], ENT_QUOTES);
            $this->stock_art = htmlspecialchars($_POST['stock_art'], ENT_QUOTES);
            $this->designation_art = htmlspecialchars($_POST['designation_art'], ENT_QUOTES);
            $this->date_art = date("Y/m/d");
            $this->code_grp = htmlspecialchars($_POST['code_grp'], ENT_QUOTES);
            $this->description_art = htmlspecialchars($_POST['description_art'], ENT_QUOTES);
            $this->niveau_cible_art = htmlspecialchars($_POST['niveau_cible_art'], ENT_QUOTES);
            $this->niveau_reappro_art = htmlspecialchars($_POST['niveau_reappro_art'], ENT_QUOTES);

            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');
            $this->designation_art = mysqli_real_escape_string($connexion, $this->designation_art);
            $this->description_art = mysqli_real_escape_string($connexion, $this->description_art);

            return TRUE;
        }

        function enregistrement()
        {
            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            $this->designation_art = mysqli_real_escape_string($connexion, $this->designation_art);
            $this->designation_art = utf8_decode($this->designation_art);

            $sql = "INSERT INTO articles (code_art, code_grp, designation_art, date_art, description_art, niveau_reappro_art, niveau_cible_art, stock_art)
                     VALUES ('$this->code_art', '$this->code_grp', '$this->designation_art', '$this->date_art', '$this->description_art', '$this->niveau_reappro_art', '$this->niveau_cible_art', '$this->stock_art')";

//            print_r($sql);
            if ($result = mysqli_query($connexion, $sql))
                return TRUE;
            else
                return FALSE;
        }

        function modification($code)
        {
            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            $sql = "UPDATE articles SET
                stock_art = '" . $this->stock_art . "',
                code_grp = '" . $this->code_grp . "',
                designation_art = '" . $this->designation_art . "',
                description_art = '" . $this->description_art . "',
                niveau_reappro_art = '" . $this->niveau_reappro_art . "',
                niveau_cible_art = '" . $this->niveau_cible_art . "'
                WHERE code_art = '" . $code . "'"; //print_r($sql);

            if ($result = mysqli_query($connexion, $sql))
                return TRUE;
            else
                return FALSE;
        }

        function suppression($code)
        {
            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            $sql = "DELETE FROM articles WHERE code_art = '" . $code . "'"; //print_r($sql);

            if ($result = mysqli_query($connexion, $sql))
                return TRUE;
            else
                return FALSE;
        }
    }

    abstract class mouvements extends class_articles
    {
//    public $code_mvt;   //code du mouvement
        public $date_mvt;   //date du mouvement en stock
        public $code_emp;   //code de l'employé
        public $type_mvt;   //type du mouvement
    }

    class entrees_articles extends mouvements
    {
        function recuperation()
        {
            $this->type_mvt = htmlspecialchars($_POST['type_mvt'], ENT_QUOTES);
            $this->date_mvt = date('Y-m-j');

            return TRUE;
        }

        function enregistrement()
        {
            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            $this->code_emp = $_SESSION['user_id']; //print_r($this->code_emp);

            //Enregistrement du mouvement d'entree en stock
            $req = "SELECT num_entr FROM entrees_stock ORDER BY num_entr DESC LIMIT 1"; //print_r($req);
            $res = $connexion->query($req);

            if ($res->num_rows > 0) {
                $ligne = $res->fetch_all(MYSQL_ASSOC);

                //reccuperation du code
                $num_entr = "";
                foreach ($ligne as $data) {
                    $num_entr = stripslashes($data['num_entr']);
                }

                //extraction des 4 derniers chiffres
                $num_entr = substr($num_entr, -4);

                //incrementation du nombre
                $num_entr += 1;
            } else {
                //s'il n'existe pas d'enregistrements dans la base de données
                $num_entr = 1;
            }

            $b = "ENT";
            $dat = date("Y");
            $dat = substr($dat, -2);
            $format = '%04d';
            $resultat = $dat . "" . $b . "" . sprintf($format, $num_entr);

            //on affecte au code le resultat
            $num_entr = $resultat;

            $sql = "INSERT INTO entrees_stock (num_entr, date_entr, code_emp)
                VALUES ('$num_entr', '$this->date_mvt', '$this->code_emp')"; //print_r($sql); echo '<br><br>';

            if ($result = mysqli_query($connexion, $sql)) {

                //Saisie des détails
                $nbr = $_POST['nbr']; //echo $nbr;
                for ($i = 0; $i < $nbr; $i++) {
                    $req = "SELECT num_dentr FROM details_entree ORDER BY num_dentr DESC LIMIT 1"; //print_r($req); echo $i . '<br>';
                    $res = $connexion->query($req);

                    if ($res->num_rows > 0) {
                        $ligne = $res->fetch_all(MYSQL_ASSOC);

                        //reccuperation du code
                        $code_de = "";
                        foreach ($ligne as $data) {
                            $code_de = stripslashes($data['num_dentr']);
                        }

                        //extraction des 4 derniers chiffres
                        $code_de = substr($code_de, -4);

                        //incrementation du nombre
                        $code_de += 1;
                    } else {
                        //s'il n'existe pas d'enregistrements dans la base de données
                        $code_de = 1;
                    }

                    $b = "DE";
                    $dat = date("Y");
                    $dat = substr($dat, -2);
                    $format = '%04d';
                    $resultat = $dat . "" . $b . "" . sprintf($format, $code_de);

                    //on affecte au code le resultat
                    $num_dentr = $resultat;

                    //Recuperation du code l'article en cours, celui pour lequel l'entree d'article est encours de saisie
                    $libelle = addslashes($_POST['libelle'][$i]);

                    $sql = sprintf("SELECT code_art, stock_art FROM articles WHERE designation_art = '%s'", $libelle); //print_r($sql); echo $i . '<br>';
                    $res = $connexion->query($sql);
                    $code_art = "";
                    $stock_art = "";
                    if ($res->num_rows > 0) {
                        $ligne = $res->fetch_all(MYSQL_ASSOC);
                        foreach ($ligne as $row) {
                            $code_art = $row['code_art'];
                            $stock_art = $row['stock_art'];
                        }
                    }

                    //Recuperation de la quantite
                    $qte = $_POST['qte'][$i];
                    $rem = htmlspecialchars($_POST['cmt'][$i], ENT_QUOTES);
                    $stock_art += $qte;

                    //Enregistrement du detail d'entree
                    $sql = "INSERT INTO details_entree (num_dentr, num_entr, qte_dentr, code_art, rem_entr)
                    VALUES ('$num_dentr', '$num_entr', '$qte', '$code_art', '$rem')"; //print_r($sql);

                    /*$result = mysqli_query($connexion, $sql);
                    print_r($result);*/
                    if ($result = mysqli_query($connexion, $sql)) {
                        //Mise à jour de la quantité de l'article en cours
                        $sql = "UPDATE articles SET stock_art = $stock_art WHERE code_art = '" . $code_art . "'";
                        mysqli_query($connexion, $sql);
                    }
                }

                return TRUE;
//            return !$test ? TRUE : FALSE;
            } else
                return FALSE;
        }

        protected function modification($code)
        {

        }

        protected function suppression($code)
        {

        }
    }

    class sorties_articles extends mouvements
    {
        function recuperation()
        {
            $this->type_mvt = htmlspecialchars($_POST['type_mvt'], ENT_QUOTES);
            $this->date_mvt = date('Y-m-j');

            return TRUE;
        }

        function enregistrement()
        {

            $connexion = new mysqli('localhost', 'angy', 'ncare', 'gestion');

            if ($connexion->connect_error)
                die($connexion->connect_error);

            $this->code_emp = $_SESSION['user_id']; //print_r($this->code_emp);

            //Enregistrement du mouvement d'entree en stock
            $req = "SELECT num_sort FROM sorties_stock ORDER BY num_sort DESC LIMIT 1"; //print_r($req);
            $res = $connexion->query($req);

            if ($res->num_rows > 0) {
                $ligne = $res->fetch_all(MYSQL_ASSOC);

                //reccuperation du code
                $num_sort = "";
                foreach ($ligne as $data) {
                    $num_sort = stripslashes($data['num_sort']);
                }

                //extraction des 4 derniers chiffres
                $num_sort = substr($num_sort, -4);

                //incrementation du nombre
                $num_sort += 1;
            } else {
                //s'il n'existe pas d'enregistrements dans la base de données
                $num_sort = 1;
            }

            $b = "SOR";
            $dat = date("Y");
            $dat = substr($dat, -2);
            $format = '%04d';
            $resultat = $dat . "" . $b . "" . sprintf($format, $num_sort);

            //on affecte au code le resultat
            $num_sort = $resultat;

            $sql = "INSERT INTO sorties_stock (num_sort, date_sort, code_emp)
                VALUES ('$num_sort', '$this->date_mvt', '$this->code_emp')"; //print_r($sql); echo '<br><br>';

            if ($result = mysqli_query($connexion, $sql)) {

                //Saisie des détails
                $nbr = $_POST['nbr']; //echo $nbr;

                for ($i = 0; $i < $nbr; $i++) {
                    $req = "SELECT num_dsort FROM details_sortie ORDER BY num_dsort DESC LIMIT 1"; //print_r($req); echo $i . '<br>';
                    $res = $connexion->query($req);

                    if ($res->num_rows > 0) {
                        $ligne = $res->fetch_all(MYSQL_ASSOC);

                        //reccuperation du code
                        $code_ds = "";
                        foreach ($ligne as $data) {
                            $code_ds = stripslashes($data['num_dsort']);
                        }

                        //extraction des 4 derniers chiffres
                        $code_ds = substr($code_ds, -4);

                        //incrementation du nombre
                        $code_ds += 1;
                    } else {
                        //s'il n'existe pas d'enregistrements dans la base de données
                        $code_ds = 1;
                    }

                    $b = "DS";
                    $dat = date("Y");
                    $dat = substr($dat, -2);
                    $format = '%04d';
                    $resultat = $dat . "" . $b . "" . sprintf($format, $code_ds);

                    //on affecte au code le resultat
                    $num_dsort = $resultat;

                    //Recuperation du code l'article en cours, celui pour lequel l'entree d'article est encours de saisie
                    $libelle = addslashes($_POST['libelle'][$i]);

                    $sql = sprintf("SELECT code_art, stock_art FROM articles WHERE designation_art = '%s'", $libelle); //print_r($sql); echo $i . '<br>';
                    $res = $connexion->query($sql);
                    $code_art = "";
                    $stock_art = "";
                    if ($res->num_rows > 0) {
                        $ligne = $res->fetch_all(MYSQL_ASSOC);
                        foreach ($ligne as $row) {
                            $code_art = $row['code_art'];
                            $stock_art = $row['stock_art'];
                        }
                    }

                    //Recuperation de la quantite
                    $qte = $_POST['qte'][$i];
                    $rem = htmlspecialchars($_POST['cmt'][$i], ENT_QUOTES);
                    $stock_art -= $qte;

                    //Enregistrement du detail d'entree
                    $sql = "INSERT INTO details_sortie (num_dsort, num_sort, qte_dsort, code_art, rem_sort)
                    VALUES ('$num_dsort', '$num_sort', '$qte', '$code_art', '$rem')"; //print_r($sql);

                    /*$result = mysqli_query($connexion, $sql);
                    print_r($result);*/
                    if ($result = mysqli_query($connexion, $sql)) {
                        //Mise à jour de la quantité de l'article en cours
                        $sql = "UPDATE articles SET stock_art = $stock_art WHERE code_art = '" . $code_art . "'";
                        mysqli_query($connexion, $sql);
                    }
                }

                return TRUE;
//            return !$test ? TRUE : FALSE;
            } else
                return FALSE;
        }

        protected function modification($code)
        {

        }

        protected function suppression($code)
        {

        }
    }