<?php

namespace Betalabs\LaravelHelper\Services\Engine\Client;


use Betalabs\LaravelHelper\Services\App\Telephone\Telephone;
use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;

class Creator extends AbstractCreator
{
    /**
     * @var \Betalabs\LaravelHelper\Services\App\Telephone\Telephone
     */
    private $telephone;
    /**
     * @var int
     */
    private $legalPersonality;
    /**
     * @var string
     */
    private $name1;
    /**
     * @var string
     */
    private $name2;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $document1;
    /**
     * @var string
     */
    private $document2;
    /**
     * @var string
     */
    private $dateOfBirth;
    /**
     * @var string
     */
    private $gender;
    /**
     * @var array
     */
    private $additionalData;

    /**
     * @param Telephone $telephone
     * @return Creator
     */
    public function setTelephone(Telephone $telephone): Creator
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @param int $legalPersonality
     * @return Creator
     */
    public function setLegalPersonality(int $legalPersonality): Creator
    {
        $this->legalPersonality = $legalPersonality;
        return $this;
    }

    /**
     * @param string $name1
     * @return Creator
     */
    public function setName1(string $name1): Creator
    {
        $this->name1 = $name1;
        return $this;
    }

    /**
     * @param string $name2
     * @return Creator
     */
    public function setName2(string $name2): Creator
    {
        $this->name2 = $name2;
        return $this;
    }

    /**
     * @param string $email
     * @return Creator
     */
    public function setEmail(string $email): Creator
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $document1
     * @return Creator
     */
    public function setDocument1(string $document1): Creator
    {
        $this->document1 = $document1;
        return $this;
    }

    /**
     * @param string $document2
     * @return Creator
     */
    public function setDocument2(string $document2): Creator
    {
        $this->document2 = $document2;
        return $this;
    }

    /**
     * @param string $dateOfBirth
     * @return Creator
     */
    public function setDateOfBirth(string $dateOfBirth): Creator
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @param mixed $gender
     * @return Creator
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param array $additionalData
     * @return Creator
     */
    public function setAdditionalData(array $additionalData): Creator
    {
        $this->additionalData = $additionalData;
        return $this;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->data = array_merge(
            [
                'legal_personality' => $this->legalPersonality,
                'name1' => $this->name1,
                'name2' => $this->name2,
                'email' => $this->email,
                'document1' => $this->document1,
                'document2' => $this->document2,
                'date_of_birth' => $this->dateOfBirth,
                'telephone' => [
                    'ddd' => $this->telephone->getDdd(),
                    'number' => $this->telephone->getNumber()
                ],
            ],
            $this->additionalData
        );
        if(isset($this->gender)) {
            $this->data['gender'] = $this->gender;
        }
        return parent::create();
    }


}