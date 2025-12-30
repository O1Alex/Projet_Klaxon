<?php

require_once __DIR__. '/../Config/database.php';
require_once '../Model/Trajet.php';

class TrajetController{

    //Liste des trajets
    public function getAllTrajets(){
        $sql="SELECT * FROM trajets";
        $db=Config::Connexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();
            $trajets=$query->fetchAll();
            return $trajets;
        }
        catch(PDOException $e){
            echo "Erreur".$e->getMessage();
        }
    }

    //Supprimer un trajet
    public function deleteTrajet($id){
        $sql="DELETE FROM trajets WHERE id=:id";
        $db=Config::Connexion();
        try{
            $query=$db->prepare($sql);
            $query->execute([
                'id'=>$id
            ]);
        }
        catch(PDOException $e){
            echo "Erreur".$e->getMessage();
        }
    }

    //Trajets disponibles (par ordre croissant et si place disponible)
    public function getDisponibleTrajet(){
        $sql="SELECT t.*,
        a1.city_name as start_city,
        a2.city_name as end_city
        FROM trajets t
        JOIN agences a1 ON t.start_agency_id=a1.id
        JOIN agences a2 ON t.end_agency_id=a2.id
        WHERE t.available_seats>0
        AND t.departure_date>NOW()
        ORDER BY t.departure_date ASC";
        $db=Config::Connexion();
        
        try{
            $query=$db->prepare($sql);
            $query->execute();
            $liste=$query->fetchAll();
            return $liste;
        }
        catch(PDOException $e){
        echo "Erreur".$e->getMessage();
        }
    }

    //Récupérer les détails d'un trajet
    public function getDetailsTrajet($id){
        $sql="SELECT t.*,
        a1.city_name as start_city,
        a2.city_name as end_city,
        u.first_name,
        u.last_name,
        u.email,
        u.phone
        FROM trajets t
        JOIN agences a1 ON t.start_agency_id=a1.id
        JOIN agences a2 ON t.end_agency_id=a2.id
        JOIN users u ON t.person_contact_id=u.id
        WHERE t.id=:id";
        $db=Config::Connexion();
        try{
            $query=$db->prepare($sql);
            $query->execute([
                'id'=>$id
            ]);
            $trajet=$query->fetch();
            return $trajet;
        }
        catch(PDOException $e){
        echo "Erreur".$e->getMessage();
        }        
    }


    //Créer un trajet
    public function createTrajet($trajet){
        $errors=$this->validateTrajet($trajet);
        if(!empty($errors)){
            return $erreur= ['success'=>false,'errors'=>$errors];
        
        }
    $sql="INSERT INTO trajets (start_agency_id, end_agency_id,departure_date,
    arrival_date,total_seats, available_seats, person_contact_id) 
    VALUES(:start_agency_id,:end_agency_id,:departure_date,:arrival_date,:total_seats,
    :available_seats,:person_contact_id)";
    $db=Config::Connexion();
    
        try{
            $query=$db->prepare($sql);
            $query->execute([
                'start_agency_id'=>$trajet->getStartAgencyId(),
                'end_agency_id'=>$trajet->getEndAgencyId(),
                'departure_date'=>$trajet->getDepartureDate(),
                'arrival_date'=>$trajet->getArrivalDate(),
                'total_seats'=>$trajet->getTotalSeats(),
                'available_seats'=>$trajet->getAvailableSeats(),
                'person_contact_id'=>$trajet->getPersonContactId()
            ]);
            return ['success'=>true,'message'=>'Trajet crée avec succés'];
        }
        catch(PDOException $e){
            echo "Erreur".$e->getMessage();
        }
    }

    //Valider le trajet
    public function validateTrajet($trajet){
        $errors=[];
        if($trajet->getStartAgencyId()==$trajet->getEndAgencyId()){
            $errors[]="L'agence de départ ne doit pas etre la meme que l'agence d'arrivé";
        }
        if(strtotime($trajet->getDepartureDate())>=strtotime($trajet->getArrivalDate())){
            $errors[]="L'heure de départ ne doit pas dépasser l'heure de l'arrivé";
        }
        if($trajet->getTotalSeats()<$trajet->getAvailableSeats()){
            $errors[]="Le nombre de place disponible ne doit pas dépasser le nombre total des places";
        }
        if ($trajet->getTotalSeats()<0){
            $errors[]="Le nombre total des places ne doit pas etre inférieur à 0";
        }

    return $errors;

    }

    //Modifier un trajet
    public function updateTrajet($trajet,$id){
        
        //Validation
        $errors=$this->validateTrajet($trajet);
        if(!empty($errors)){
            return ['success'=>false,'errors'=>$errors];
        }

        $sql="Update trajets SET start_agency_id=:start_agency_id,
        end_agency_id=:end_agency_id,
        departure_date=:departure_date,
        arrival_date=:arrival_date,
        total_seats=:total_seats,
        available_seats=:available_seats,
        person_contact_id=:person_contact_id
        WHERE id=:id";
        $db=Config::Connexion();
        
        try{
            $query=$db->prepare($sql);
            $query->execute([
            'id'=>$id,
            'start_agency_id'=>$trajet->getStartAgencyId(),
            'end_agency_id'=>$trajet->getEndAgencyId(),
            'departure_date'=>$trajet->getDepartureDate(),
            'arrival_date'=>$trajet->getArrivalDate(),
            'total_seats'=>$trajet->getTotalSeats(),
            'available_seats'=>$trajet->getAvailableSeats(),
            'person_contact_id'=>$trajet->getPersonContactId() 
            ]);
            return ['success'=>true,'message'=>'Le trajet a été modifé avec succés'];

        }
        catch(PDOException $e){
        echo "Erreur".$e->getMessage();
        }
    }

    //Verification utilisateur = auteur du trajet
    public function isAuthor($idUser,$idTrajet){
        $sql="SELECT COUNT(*) FROM trajets WHERE 
        id=:idTrajet
        And person_contact_id=:idUser";
        $db=Config::Connexion();
        try{
            $query=$db->prepare($sql);
            $query->execute([
                'idTrajet'=>$idTrajet,
                'idUser'=>$idUser

            ]);
            return $query->fetchColumn()>0;
        }
        catch(PDOException $e){
        echo "Erreur".$e->getMessage();
        }
    }

    //Modification du trajet de l'utilisateur
    public function updateUserTrajet($trajet,$idUser,$idTrajet){
        if(!$this->isAuthor($idUser,$idTrajet)){
            return ["success"=>false,'message'=>["Vous n'etes pas l'auteur du trajet"]];
        }
        return $this->updateTrajet($trajet,$idTrajet);
    }

    //Suppression du trajet de l'utilisateur
    public function deleteUserTrajet($trajetId,$userId){
        if(!$this->isAuthor($userId,$trajetId)){
            return ["success"=>false,"errors"=>["Vous n'etes pas l'auteur du trajet"]];
        }
    $this->deleteTrajet($trajetId);
    return ['success'=>true, "message"=>"Trajet supprimé avec succées"];

    }
}

?>