<?php
    /**
     * acts as a validator to validate all fields of bakers, customers and users being entered into the database.
     */
    class Validation
    {
        //$name_err=$email_err=$address_line1_err=$address_line2_err=$county_err=$postcode_err = "";
        function validateAll($first_name, $surname, $email, $address_line1, $address_line2, $county, $postcode){
            if($this -> validateName($surname) && $this->validateEmail($email) && $this->validateAddressLine1($address_line1) &&
                $this->validateAddressLine2($address_line2) && $this->validateCounty($county) && $this->validatePostcode($postcode)) {
                return true;
            } else {
                return false;
            }
        }

        function validateName($name) {
            $pattern = "/^[a-zA-Z ]*$/";
            if (preg_match($pattern,$name)) {
                return true;
            }\
            else {
                //$name_err = "Either the First Name or the Surname is in wrong format";
                return false;
            }
        }

        function validateEmail($email)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            else {
                //$email_err = "Email is in wrong format";
                return false;
            }
        }

        function validateAddressLine1($addressLine1)
        {
            // $pattern = "/^[a-zA-Z ]*$/";
            // if (preg_match($pattern,$name)) {
            //     return true;
            // }\
            // else {
            //     $address_line1_err = "Address Line 1 is in the wrong format";
            //     return false;
            // };
            return true;
        }

        function validateAddressLine2($addressLine2)
        {
            // $pattern = "/^[a-zA-Z ]*$/";
            // if (preg_match($pattern,$name)) {
            //     return true;
            // }\
            // else {
            //     $address_line2_err = "Address Line 2 is in the wrong format";
            //     return false;
            // };
            return true;
        }

        function validateCounty($county)
        {
            // $pattern = "/^[a-zA-Z ]*$/";
            // if (preg_match($pattern,$name)) {
            //     return true;
            // }\
            // else {
            //     $county_err = "County is in the wrong format";
            //     return false;
            // };
            return true;
        }

        function validatePostcode($postcode)
        {
            $pattern = '/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/';

            if(preg_match($pattern, $postcode)) {
                return true;
            }
            else {
            //    $postcode_err = "Postcode is in the wrong format";
                return false;
            }
        }
    }
 ?>
