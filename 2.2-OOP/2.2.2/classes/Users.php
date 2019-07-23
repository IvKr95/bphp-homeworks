<?php

class Users extends JsonDataArray
{
    public function displaySortedList()
    {
        $data = $this->newQuery()->orderBy('name')->getObjs();

        echo '<ul>';
        foreach ($data as $obj) 
        {   
            echo 
            "<li>
                <b>$obj->name</b>
                <p>e-mail: $obj->email</p>
                <p>rate: $obj->rate</p>
            </li>"; 
        };
        echo '</ul>';
    }
}