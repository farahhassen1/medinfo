<?php

class Prescription
{
    private ?int $id = null;
    private string $doctorName;
    private string $websiteName;
    private string $patientName;
    private string $prescriptionDate;
    private string $prescriptionText;
    private string $doctorStamp;
    private ?int $idtype = null;

    public function __construct(
        $id=null,
        $doctorName,
        $websiteName,
        $patientName,
        $prescriptionDate,
        $prescriptionText,
        $doctorStamp,
        $idtype=null
    ) {
        $this->id = $id;
        $this->doctorName = $doctorName;
        $this->websiteName = $websiteName;
        $this->patientName = $patientName;
        $this->prescriptionDate = $prescriptionDate;
        $this->prescriptionText = $prescriptionText;
        $this->doctorStamp = $doctorStamp;
        $this->idtype = $idtype;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoctorName(): string
    {
        return $this->doctorName;
    }

    public function setDoctorName(string $doctorName): self
    {
        $this->doctorName = $doctorName;
        return $this;
    }

    public function getWebsiteName(): string
    {
        return $this->websiteName;
    }

    public function setWebsiteName(string $websiteName): self
    {
        $this->websiteName = $websiteName;
        return $this;
    }

    public function getPatientName(): string
    {
        return $this->patientName;
    }

    public function setPatientName(string $patientName): self
    {
        $this->patientName = $patientName;
        return $this;
    }

    public function getPrescriptionDate(): string
    {
        return $this->prescriptionDate;
    }

    public function setPrescriptionDate(string $prescriptionDate): self
    {
        $this->prescriptionDate = $prescriptionDate;
        return $this;
    }

    public function getPrescriptionText(): string
    {
        return $this->prescriptionText;
    }

    public function setPrescriptionText(string $prescriptionText): self
    {
        $this->prescriptionText = $prescriptionText;
        return $this;
    }

    public function getDoctorStamp(): string
    {
        return $this->doctorStamp;
    }

    public function setDoctorStamp(string $doctorStamp): self
    {
        $this->doctorStamp = $doctorStamp;
        return $this;
    }
    public function getidtype(): int
    {
        return $this->idtype;
    }

    public function setidtype(int $idtype): self
    {
        $this->idtype = $idtype;
        return $this;
    }
}
?>