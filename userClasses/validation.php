<?php
    /**
     * acts as a validator to validate all fields of bakers, customers and users being entered into the database.
     */
    class Validation
    {
        function validateEmail($email)
        {
            $pattern = '';
            preg_match($pattern, $email, $matches);

            if($matches -> true)
        }
    }

 ?>
