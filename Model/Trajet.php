<?php

class Trajet{
    private $id;
    private $startAgencyId;
    private $endAgencyId;
    private $departureDate;
    private $arrivalDate;
    private $totalSeats;
    private $availableSeats;
    private $personContactId;

    
    // id
    public function getId(){
        return $this ->id;
    }

    public function setId($id){
        $this->id=$id;
    }

    //startAgencyId
    public function getStartAgencyId() {
    return $this->startAgencyId;
    }

    public function setStartAgencyId($startAgencyId) {
    $this->startAgencyId = $startAgencyId;
    }

    // endAgencyId
    public function getEndAgencyId() {
        return $this->endAgencyId;
    }

    public function setEndAgencyId($endAgencyId) {
        $this->endAgencyId = $endAgencyId;
    }

    // departureDate
    public function getDepartureDate() {
        return $this->departureDate;
    }

    public function setDepartureDate($departureDate) {
        $this->departureDate = $departureDate;
    }

    // arrivalDate
    public function getArrivalDate() {
        return $this->arrivalDate;
    }

    public function setArrivalDate($arrivalDate) {
        $this->arrivalDate = $arrivalDate;
    }

    // totalSeats
    public function getTotalSeats() {
        return $this->totalSeats;
    }

    public function setTotalSeats($totalSeats) {
        $this->totalSeats = $totalSeats;
    }

    // availableSeats
    public function getAvailableSeats() {
        return $this->availableSeats;
    }

    public function setAvailableSeats($availableSeats) {
        $this->availableSeats = $availableSeats;
    }

    // personContactId
    public function getPersonContactId() {
        return $this->personContactId;
    }

    public function setPersonContactId($personContactId) {
        $this->personContactId = $personContactId;
    }

}


?>