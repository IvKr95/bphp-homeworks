<?php

class Person
{

    protected $name,
              $surname,
              $patronymic,
              $gender;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = -1;
    const GENDER_UNDEFINED = 0;
    const MALE_ENDINGS = ['вич', 'ьич', 'тич', 'глы'];
    const FEMALE_ENDINGS = ['вна', 'чна', 'шна', 'ызы'];

    public function __construct(string $name = '', string $surname = '', ?string $patronymic = '')
    {
        $this->name = $name; 
        $this->surname = $surname;
        
        if ($patronymic) {
            $this->patronymic = $patronymic;
            $this->setGender();
        };
    }

    protected function setGender(): void
    {
        $patronymicEnding = mb_substr($this->patronymic, -3);

        if (in_array($patronymicEnding, self::MALE_ENDINGS)) { 
            $this->gender = self::GENDER_MALE;
        } elseif (in_array($patronymicEnding, self::FEMALE_ENDINGS)) { 
            $this->gender = self::GENDER_FEMALE; 
        } else { 
            $this->gender = self::GENDER_UNDEFINED;
        };
    }

    public function getFio(): string
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic . ' ';
    }

    public function getGender(): string
    {
        if ($this->gender === self::GENDER_MALE) { 
            return 'male';
        } elseif ($this->gender === self::GENDER_FEMALE) { 
            return 'female';
        } else { 
            return 'undefined';
        };
    }

    public function getGenderSymbol(): string
    {
        if ($this->gender === self::GENDER_MALE) { 
            return '♂';
        } elseif ($this->gender === self::GENDER_FEMALE) { 
            return '♀';
        } else { 
            return '😎';
        };
    }
}