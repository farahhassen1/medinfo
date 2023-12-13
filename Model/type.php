<?php

class typep
{
    private ?int $idtype = null;
    private string $typeName;
    private string $typedescription;

    public function __construct(
        $idtype=null,
        $typeName,
        $typedescription,
    ) {
        $this->idtype = $idtype;
        $this->typeName = $typeName;
        $this->typedescription = $typedescription;
    }

    public function getId(): ?int
    {
        return $this->idtype;
    }

    public function gettypeName(): string
    {
        return $this->typeName;
    }

    public function settypeName(string $typeName): self
    {
        $this->typeName = $typeName;
        return $this;
    }

    public function gettypedescription(): string
    {
        return $this->typedescription;
    }

    public function settypedescription(string $typedescription): self
    {
        $this->typedescription = $typedescription;
        return $this;
    }

}
?>