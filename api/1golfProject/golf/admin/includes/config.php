<?php
include_once("functions.php");
$objDatabase = new Functions;
/**
 * REDIRECTS TO ANOTHER PAGE
 * */
function redirect($url) {
    if (headers_sent()) {
        echo "<script language=\"Javascript\">window.location.href='$url';</script>";
        exit;
    } else {
        session_write_close();
        header("Location:$url");
        exits;
    }
}

/**
 * CHECK FIELD
 * */
function check($field) {
    $field = strip_tags($field); //remove tags
    $field = trim($field); //remove whitespaces at begining and end
    $field = stripslashes($field); //removes slashes
    $field = mysql_real_escape_string($field); //sql queries
    return $field;
}

// To find the extension of the given $filename
function getExtension($fileName) {
    $ext = explode(".", $fileName);
    $fileExt = $ext[sizeof($ext) - 1];
    return $fileExt;
}

function showPre($arr) {
    $dis = sprintf("<div id='show' style='border:1px solid green;color:green;background:#99CCCC;font-weight:bold'><pre>");
    echo $dis;
    print_r($arr);
    echo "</pre></div>";
}

function generateCountrySelect($country="") {
    $countrylist = array(
        "Afghanistan" => "Afghanistan",
        "Albania" => "Albania",
        "Algeria" => "Algeria",
        "Algeria" => "Algeria",
        "Algeria" => "Algeria",
        "Antigua and Barbuda" => "Antigua and Barbuda",
        "Argentina" => "Argentina",
        "Armenia" => "Armenia",
        "Australia" => "Australia",
        "Austria" => "Austria",
        "Azerbaijan" => "Azerbaijan",
        "Bahamas" => "Bahamas",
        "Bahrain" => "Bahrain",
        "Bangladesh" => "Bangladesh",
        "Barbados" => "Barbados",
        "Belarus" => "Belarus",
        "Belgium" => "Belgium",
        "Belize" => "Belize",
        "Benin" => "Benin",
        "Bhutan" => "Bhutan",
        "Bolivia" => "Bolivia",
        "Bosnia and Herzegovina" => "Bosnia and Herzegovina",
        "Botswana" => "Botswana",
        "Brazil" => "Brazil",
        "Brunei" => "Brunei",
        "Bulgaria" => "Bulgaria",
        "Burkina Faso" => "Burkina Faso",
        "Burundi" => "Burundi",
        "Cambodia" => "Cambodia",
        "Cameroon" => "Cameroon",
        "Canada" => "Canada",
        "Cape Verde" => "Cape Verde",
        "Central African Republic" => "Central African Republic",
        "Chad" => "Chad",
        "Chile" => "Chile",
        "China" => "China",
        "Colombi" => "Colombi",
        "Comoros" => "Comoros",
        "Congo (Brazzaville)" => "Congo (Brazzaville)",
        "Congo" => "Congo",
        "Costa Rica" => "Costa Rica",
        "Cote d'Ivoire" => "Cote d'Ivoire",
        "Croatia" => "Croatia",
        "Cuba" => "Cuba",
        "Cyprus" => "Cyprus",
        "Czech Republic" => "Czech Republic",
        "Denmark" => "Denmark",
        "Djibouti" => "Djibouti",
        "Dominica" => "Dominica",
        "Dominican Republic" => "Dominican Republic",
        "East Timor (Timor Timur)" => "East Timor (Timor Timur)",
        "Ecuador" => "Ecuador",
        "Egypt" => "Egypt",
        "El Salvador" => "El Salvador",
        "Equatorial Guinea" => "Equatorial Guinea",
        "Eritrea" => "Eritrea",
        "Estonia" => "Estonia",
        "Ethiopia" => "Ethiopia",
        "Fiji" => "Fiji",
        "Finland" => "Finland",
        "France" => "France",
        "Gabon" => "Gabon",
        "Gambia, The" => "Gambia, The",
        "Georgia" => "Georgia",
        "Germany" => "Germany",
        "Ghana" => "Ghana",
        "Greece" => "Greece",
        "Grenada" => "Grenada",
        "Guatemala" => "Guatemala",
        "Guinea" => "Guinea",
        "Guinea-Bissau" => "Guinea-Bissau",
        "Guyana" => "Guyana",
        "Haiti" => "Haiti",
        "Honduras" => "Honduras",
        "Hungary" => "Hungary",
        "Iceland" => "Iceland",
        "India" => "India",
        "Indonesia" => "Indonesia",
        "Iran" => "Iran",
        "Iraq" => "Iraq",
        "Ireland" => "Ireland",
        "Israel" => "Israel",
        "Italy" => "Italy",
        "Jamaica" => "Jamaica",
        "Japan" => "Japan",
        "Jordan" => "Jordan",
        "Kazakhstan" => "Kazakhstan",
        "Kenya" => "Kenya",
        "Kiribati" => "Kiribati",
        "Korea, North" => "Korea, North",
        "Korea, South" => "Korea, South",
        "Kuwait" => "Kuwait",
        "Kyrgyzstan" => "Kyrgyzstan",
        "Laos" => "Laos",
        "Latvia" => "Latvia",
        "Lebanon" => "Lebanon",
        "Lesotho" => "Lesotho",
        "Liberia" => "Liberia",
        "Libya" => "Libya",
        "Liechtenstein" => "Liechtenstein",
        "Lithuania" => "Lithuania",
        "Luxembourg" => "Luxembourg",
        "Macedonia" => "Macedonia",
        "Madagascar" => "Madagascar",
        "Malawi" => "Malawi",
        "Malaysia" => "Malaysia",
        "Maldives" => "Maldives",
        "Mali" => "Mali",
        "Malta" => "Malta",
        "Marshall Islands" => "Marshall Islands",
        "Mauritania" => "Mauritania",
        "Mauritius" => "Mauritius",
        "Mexico" => "Mexico",
        "Micronesia" => "Micronesia",
        "Moldova" => "Moldova",
        "Monaco" => "Monaco",
        "Mongolia" => "Mongolia",
        "Morocco" => "Morocco",
        "Mozambique" => "Mozambique",
        "Myanmar" => "Myanmar",
        "Namibia" => "Namibia",
        "Nauru" => "Nauru",
        "Nepal" => "Nepal",
        "Netherlands" => "Netherlands",
        "New Zealand" => "New Zealand",
        "Nicaragua" => "Nicaragua",
        "Niger" => "Niger",
        "Nigeria" => "Nigeria",
        "Norway" => "Norway",
        "Oman" => "Oman",
        "Pakistan" => "Pakistan",
        "Palau" => "Palau",
        "Panama" => "Panama",
        "Papua New Guinea" => "Papua New Guinea",
        "Paraguay" => "Paraguay",
        "Peru" => "Peru",
        "Philippines" => "Philippines",
        "Poland" => "Poland",
        "Portugal" => "Portugal",
        "Qatar" => "Qatar",
        "Romania" => "Romania",
        "Russia" => "Russia",
        "Rwanda" => "Rwanda",
        "Saint Kitts and Nevis" => "Saint Kitts and Nevis",
        "Saint Lucia" => "Saint Lucia",
        "Saint Vincent" => "Saint Vincent",
        "Samoa" => "Samoa",
        "San Marino" => "San Marino",
        "Sao Tome and Principe" => "Sao Tome and Principe",
        "Saudi Arabia" => "Saudi Arabia",
        "Senegal" => "Senegal",
        "Serbia and Montenegro" => "Serbia and Montenegro",
        "Seychelles" => "Seychelles",
        "Sierra Leone" => "Sierra Leone",
        "Singapore" => "Singapore",
        "Slovakia" => "Slovakia",
        "Slovenia" => "Slovenia",
        "Solomon Islands" => "Solomon Islands",
        "Somalia" => "Somalia",
        "South Africa" => "South Africa",
        "Spain" => "Spain",
        "Sri Lanka" => "Sri Lanka",
        "Sudan" => "Sudan",
        "Suriname" => "Suriname",
        "Swaziland" => "Swaziland",
        "Sweden" => "Sweden",
        "Switzerland" => "Switzerland",
        "Syria" => "Syria",
        "Taiwan" => "Taiwan",
        "Tajikistan" => "Tajikistan",
        "Tanzania" => "Tanzania",
        "Thailand" => "Thailand",
        "Togo" => "Togo",
        "Tonga" => "Tonga",
        "Trinidad and Tobago" => "Trinidad and Tobago",
        "Tunisia" => "Tunisia",
        "Turkey" => "Turkey",
        "Turkmenistan" => "Turkmenistan",
        "Tuvalu" => "Tuvalu",
        "Uganda" => "Uganda",
        "Ukraine" => "Ukraine",
        "United Arab Emirates" => "United Arab Emirates",
        "United Kingdom" => "United Kingdom",
        "United States" => "United States",
        "Uruguay" => "Uruguay",
        "Uzbekistan" => "Uzbekistan",
        "Vanuatu" => "Vanuatu",
        "Vatican City" => "Vatican City",
        "Venezuela" => "Venezuela",
        "Vietnam" => "Vietnam",
        "Yemen" => "Yemen",
        "Zambia" => "Zambia",
        "Zimbabwe" => "Zimbabwe"
    );
    $countrySel = '<select name="country" id="country" style="width:200px;">'; // start building select box and store in variable $countrySel
    $countrySel.='<option value="">---Select Country---</option>';
    foreach ($countrylist as $key => $val) {   // use $countryList array to generate dynamic options for country selectbox
        $sel=($country==$key)?'selected="selected"':''; // if user has selected the specific country that mark it as selected and store in $sel variable
        $countrySel.=sprintf('<option %s value="%s">%s</option>',$sel, $key, $val); // generate option
    }
    $countrySel.='</select>';
    return $countrySel; //return generated select box html code
}
?>