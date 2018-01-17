<?php
    /**
     * acts as a validator to validate all fields of bakers, customers and users being entered into the database.
     */
    class Validation
    {
        function validateEmail($email)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            else {
                return false;
            }
        }

        function validateAddressLine1($addressLine1)
        {

        }

        function validateAddressLine2($addressLine2)
        {

        }

        function validatePostcode($postcode)
        {
            $pattern = '^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$'

            if(preg_match($pattern, $postcode) -> true) {
                return true;
            }
            else {
                return false;
            }
        }

        function validateCountry($country)
        {

        }

 ?>
