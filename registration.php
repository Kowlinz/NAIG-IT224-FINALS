<?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: contact.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Naig</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="icon" type="image/png" href="colinIcon.png">
</head>

<body>
    <div class="container mt-3">
        <?php 
        // validate the submit button
        if (isset($_POST["Register"])){
            $LastName = $_POST["LastName"];
            $FirstName = $_POST["FirstName"];
            $email = $_POST["Email"];
            $password = $_POST["password"];
            $RepeatPassword = $_POST["repeat_password"];
            $lotBlock = $_POST["lot_block"];
            $street = $_POST["street"];
            $phaseSubdivision = $_POST["phase_subdivision"];
            $barangay = $_POST["barangay"];
            $city = $_POST["city"];
            $province = $_POST["province"];
            $country = $_POST["Country"];
            $contactNumber = $_POST["phone"];
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();
        // validate if all fields are empty
            if (empty($LastName) OR empty ($FirstName) OR empty ($email) OR empty ($password) OR empty ($RepeatPassword)) {
                array_push($errors, "All fields are required"); 
            }
        // validate if the email is not validated 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
        // password should not be less than 8 
            if (strlen($password)<8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
        // check if password is the same 
            if(!$password = $RepeatPassword){
                array_push($errors, "Password does not match");
            }

            require_once "database.php"; // email validation
            $sql = "SELECT * FROM naiguser WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errors, "Email Already Exist!");
            }

            if (count($errors)>0){
                foreach($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                require_once "database.php";
                $sql = "INSERT INTO naiguser (Last_Name, First_Name, email, password, lot_block, street, phase_subdivision, barangay, city, province, Country, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn); // initializes a statement and returns an object suitable for mysqli_stmt_prepare()
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                
                if ($preparestmt) {
                    mysqli_stmt_bind_param($stmt, "ssssssssssss", $LastName, $FirstName, $email, $passwordHash, $lotBlock, $street, $phaseSubdivision, $barangay, $city, $province, $country, $contactNumber);
                    mysqli_stmt_execute($stmt);
                    echo "<div class = 'alert alert-success'> You are registered succesfully! </div>";
                } else {
                    die("Something went wrong!");
                }
            }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="row jumbotron box8">

                <h5><a href="index.php">Cancel</a></h5>

                <div class="col-sm-12 mx-t3 mb-4">
                    <h2 class="text-center text-info"><b>REGISTER</b></h2>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="LastName">Last Name:</label>
                    <input type="text" class="form-control" name="LastName" placeholder="Enter your Last Name" required>
                </div> 

                <div class="col-sm-6 form-group">
                    <label for="FirstName">First Name:</label>
                    <input type="text" class="form-control" name="FirstName" placeholder="Enter your First Name" required>
                </div> 

                <div class="col-sm-6 form-group">
                    <label for="lot_block">Lot/Block/House Number:</label>
                    <input type="text" class="form-control" name="lot_block" placeholder="Lot/Block/House Number (ex. Lot 69, Block 96)">
                </div> 

                <div class="col-sm-6 form-group">
                    <label for="street">Street:</label>
                    <input type="text" class="form-control" name="street" placeholder="Street (ex. Champaca St.)">
                </div> 

                <div class="col-sm-6 form-group">
                    <label for="phase_subdivision">Phase/Subdivision:</label>
                    <input type="text" class="form-control" name="phase_subdivision" placeholder="Phase/Subdivision (ex. Maligaya Park Subd.)">
                </div>

                <div class="col-sm-6 form-group">
                    <label for="barangay">Barangay:</label>
                    <select class="form-control custom-select browser-default" name="barangay" placeholder="Barangay" required>
                        <option value="Select" selected>Select a Barangay</option>
                        <option value="Alicia">Alicia</option>
                        <option value="Amihan">Amihan</option>
                        <option value="ApilonioSamson">Apolonio Samson</option>
                        <option value="Bagbag">Bagbag</option>
                        <option value="BagongLipunanngCrame">Bagong Lipunan ng Crame</option>
                        <option value="BagongPagasa">Bagong Pag-asa</option>
                        <option value="BagongSilangan">Bagong Silangan</option>
                        <option value="Bagumbayan">Bagumbayan</option>
                        <option value="BahayToro">Bahay Toro</option>
                        <option value="Balingasa">Balingasa</option>
                        <option value="BalonBato">Balon Bato</option>
                        <option value="BatasanHills">Batasan Hills</option>
                        <option value="Bayanihan">Bayanihan</option>
                        <option value="BlueRidgeA">Blue Ridge A</option>
                        <option value="BlueRidgeB">Blue Ridge B</option>
                        <option value="Botocan">Botocan</option>
                        <option value="Bungad">Bungad</option>
                        <option value="Culiat">Culiat</option>
                        <option value="Damar">Damar</option>
                        <option value="Damayan">Damayan</option>
                        <option value="DamayangLagi">Damayang Lagi</option>
                        <option value="DelMonte">Del Monte</option>
                        <option value="DioquinoZobel">Dioquino Zobel</option>
                        <option value="DoñaAurora">Doña Aurora</option>
                        <option value="DoñaImelda">Doña Imelda</option>
                        <option value="DoñaJosefa">Doña Josefa</option>
                        <option value="DuyanDuyan">Duyan-Duyan</option>
                        <option value="EastKamias">East Kamias</option>
                        <option value="EscopaI">Escopa I</option>
                        <option value="EscopaII">Escopa II</option>
                        <option value="EscopaIII">Escopa III</option>
                        <option value="EscopaIV">Escopa IV</option>
                        <option value="E.Rodriguez">E. Rodriguez</option>
                        <option value="Fairview">Fairview</option>
                        <option value="Gulod">Gulod</option>
                        <option value="GreaterLagro">Greater Lagro</option>
                        <option value="HolySpirit">Holy Spirit</option>
                        <option value="Horseshoe">Horseshoe</option>
                        <option value="ImmaculateConcepcion">Immaculate Concepcion</option>
                        <option value="Kalusugan">Kalusugan</option>
                        <option value="Kaunlaran">Kaunlaran</option>
                        <option value="Kamuning">Kamuning</option>
                        <option value="Kalusugan">Kalusugan</option>
                        <option value="Katipunan">Katipunan</option>
                        <option value="Kamuning">Kamuning</option>
                        <option value="Kalusugan">Kalusugan</option>
                        <option value="Katipunan">Katipunan</option>
                        <option value="Kamuning">Kamuning</option>
                        <option value="Kalusugan">Kalusugan</option>
                        <option value="Katipunan">Katipunan</option>
                        <option value="Kamuning">Kamuning</option>
                        <option value="KristongHari">Kristong Hari</option>
                        <option value="KrusNaLigas">Krus Na Ligas</option>
                        <option value="LagingHanda">Laging Handa</option>
                        <option value="Libis">Libis</option>
                        <option value="LoyolaHeights">Loyola Heights</option>
                        <option value="Lourdes">Lourdes</option>
                        <option value="Magsaysay">Ramon Magsaysay</option>
                        <option value="Maharlika">Maharlika</option>
                        <option value="Malaya">Malaya</option>
                        <option value="Mangga">Mangga</option>
                        <option value="Mangga">Mangga</option>
                        <option value="Manresa">Manresa</option>
                        <option value="Mariblo">Mariblo</option>
                        <option value="Marilag">Marilag</option>
                        <option value="Mariana">Mariana</option>
                        <option value="Mariana">Mariana</option>
                        <option value="Masagana">Masagana</option>
                        <option value="Masambong">Masambong</option>
                        <option value="MatandangBalara">Matandang Balara</option>
                        <option value="Milagrosa">Milagrosa</option>
                        <option value="NagkaisangNayon">Nagkaisang Nayon</option>
                        <option value="NayongKanluran">Nayong Kanluran</option>
                        <option value="NewEra">New Era</option>
                        <option value="NovalichesProper">Novaliches Proper</option>
                        <option value="NSAmoranto">N.S Amoranto</option>
                        <option value="OldCapitolSite">Old Capitol Site</option>
                        <option value="Obrero">Obrero</option>
                        <option value="PabahayangPag-ibig">Pag-ibig sa Nayon</option>
                        <option value="Paltok">Paltok</option>
                        <option value="Paligsahan">Paligsahan</option>
                        <option value="Pansol">Pansol</option>
                        <option value="PaangBundok">Paang Bundok</option>
                        <option value="PasongPutikProper">Pasong Putik Proper</option>
                        <option value="Payatas">Payatas</option>
                        <option value="Pinyahan">Pinyahan</option>
                        <option value="Phil-Am">Phil-Am</option>
                        <option value="Pobocan">Damar</option>
                        <option value="Project6">Project 6</option>
                        <option value="Quirino2-A">Quirino 2-A</option>
                        <option value="Quirino2-B">Quirino 2-B</option>
                        <option value="Quirino2-C">Quirino 2-C</option>
                        <option value="Quirino3-A">Quirino 3-A</option>
                        <option value="ClaroQuirino3-B">Claro (Quirino 3-B)</option>
                        <option value="RamonMagsaysay">Ramon Magsaysay</option>
                        <option value="Roxas">Roxas</option>
                        <option value="SacredHeart">Sacred Heart</option>
                        <option value="Sagandaan">Sangandaan</option>
                        <option value="Salvacion">Salvacion</option>
                        <option value="SanAgustin">San Agustin</option>
                        <option value="SanAntonio">San Antonio</option>
                        <option value="SanBartolome">San Bartolome</option>
                        <option value="SanIsidroGalas">San Isidro Galas</option>
                        <option value="SanIsidroLabrador">San Isidro Labrador</option>
                        <option value="SanJose">San Jose</option>
                        <option value="SanJuan">San Juan</option>
                        <option value="SanMartinDePorres">San Martin De Porres</option>
                        <option value="SanRoque">San Roque</option>
                        <option value="Santol">Santol</option>
                        <option value="Sauyo">Sauyo</option>
                        <option value="Socorro">Socorro</option>
                        <option value="SouthTriangle">South Triangle</option>
                        <option value="Sauyo">Sauyo</option>
                        <option value="SikatunaVillage">Sikatuna Village</option>
                        <option value="Silangan">Silangan</option>
                        <option value="Sta.Cruz">Sta. Cruz</option>
                        <option value="Sta.Lucia">Sta. Lucia</option>
                        <option value="Sta.Monica">Sta. Monica</option>
                        <option value="Sta.Teresita">Sta. Teresita</option>
                        <option value="Sto.Cristo">Sto. Cristo</option>
                        <option value="Sto.Domingo">Sto. Domingo</option>
                        <option value="Sto.Niño">Sto. Niño</option>
                        <option value="Talayan">Talayan</option>
                        <option value="Talipapa">Talipapa</option>
                        <option value="TeachersVillageEast">Teachers Village East</option>
                        <option value="TeachersVillageWest">Teachers Village West</option>
                        <option value="TandangSora">Tandang Sora</option>
                        <option value="Tatalon">Tatalon</option>
                        <option value="Teresa">St. Teresa</option>
                        <option value="UgongNorte">Ugong Norte</option>
                        <option value="UnangSigaw">Unang Sigaw</option>
                        <option value="UPCampus">UP Campus</option>
                        <option value="UPVillage">UP Village</option>
                        <option value="Valencia">Valencia</option>
                        <option value="Vasra">Vasra</option>
                        <option value="VeteransVillage">Veterans Village</option>
                        <option value="VillaMariaClara">Villa Maria Clara</option>
                        <option value="WestKamias">West Kamias</option>
                        <option value="WestTriangle">West Triangle</option>
                        <option value="WhitePlains">White Plains</option>
                    </select>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="City">City:</label>
                    <select class="form-control custom-select browser-default" name="city" placeholder="City" required>
                        <option value="Caloocan">Caloocan City</option>
                        <option value="LasPiñas">Las Piñas City</option>
                        <option value="Makati">Makati City</option>
                        <option value="Malabon">Malabon City</option>
                        <option value="Mandaluyong">Mandaluyong City</option>
                        <option value="Manila">Manila City</option>
                        <option value="Marikina">Marikina City</option>
                        <option value="Muntinlupa">Muntinlupa City</option>
                        <option value="Navotas">Navotas City</option>
                        <option value="Parañaque">Parañaque City</option>
                        <option value="Pasay">Pasay City</option>
                        <option value="Pasig">Pasig City</option>
                        <option value="Quezon City" selected>Quezon City</option>
                        <option value="SanJuan">San Juan City</option>
                        <option value="Taguig">Taguig City</option>
                        <option value="Valenzuela">Valenzuela City</option>
                    </select>
                </div>                

                <div class="col-sm-6 form-group">
                    <label for="Region">Province:</label>
                    <select class="form-control custom-select browser-default" name="province" placeholder="Province" required>
                        <option value="Region I">Region I - Ilocos Region</option>
                        <option value="Region II">Region II - Cagayan Valley</option>
                        <option value="Region III">Region III - Central Luzon</option>
                        <option value="Region IV-A">Region IV-A - CALABARZON</option>
                        <option value="MIMAROPA">MIMAROPA - Region</option>
                        <option value="Region V">Region V - Bicol Region</option>
                        <option value="Region VI">Region VI - Western Visayas</option>
                        <option value="Region VII">Region VII - Central Visayas</option>
                        <option value="Region VIII">Region VIII - Eastern Visayas</option>
                        <option value="Region IX">Region IX - Zamboanga Peninsula</option>
                        <option value="Region X">Region X - Northern Mindanao</option>
                        <option value="Region XI">Region XI - Davao Region</option>
                        <option value="Region XII">Region XII - SOCCSKSARGEN</option>
                        <option value="Region XIII">Region XIII - Caraga</option>
                        <option value="NCR" selected>NCR - National Capital Region</option>
                        <option value="CAR">CAR - Cordillera Administrative Region</option>
                        <option value="BARMM">BARMM - Bangsamoro Autonomous Region in Muslim Mindanao</option>
                    </select>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="Country">Country:</label>
                    <select class="form-control custom-select browser-default" name="Country" placeholder="Country:">
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines" selected>Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>

                <div class="col-sm-3 form-group">
                    <label for="cod">Country code</label>
                    <select class="form-control browser-default custom-select">
                        <option data-countryCode="US" value="1">USA (+1)</option>
                        <option data-countryCode="GB" value="44">UK (+44)</option>
                        <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                        <option data-countryCode="AD" value="376">Andorra (+376)</option>
                        <option data-countryCode="AO" value="244">Angola (+244)</option>
                        <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                        <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                        <option data-countryCode="AR" value="54">Argentina (+54)</option>
                        <option data-countryCode="AM" value="374">Armenia (+374)</option>
                        <option data-countryCode="AW" value="297">Aruba (+297)</option>
                        <option data-countryCode="AU" value="61">Australia (+61)</option>
                        <option data-countryCode="AT" value="43">Austria (+43)</option>
                        <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                        <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                        <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                        <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                        <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                        <option data-countryCode="BY" value="375">Belarus (+375)</option>
                        <option data-countryCode="BE" value="32">Belgium (+32)</option>
                        <option data-countryCode="BZ" value="501">Belize (+501)</option>
                        <option data-countryCode="BJ" value="229">Benin (+229)</option>
                        <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                        <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                        <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                        <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                        <option data-countryCode="BW" value="267">Botswana (+267)</option>
                        <option data-countryCode="BR" value="55">Brazil (+55)</option>
                        <option data-countryCode="BN" value="673">Brunei (+673)</option>
                        <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                        <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                        <option data-countryCode="BI" value="257">Burundi (+257)</option>
                        <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                        <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                        <option data-countryCode="CA" value="1">Canada (+1)</option>
                        <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                        <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                        <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                        <option data-countryCode="CL" value="56">Chile (+56)</option>
                        <option data-countryCode="CN" value="86">China (+86)</option>
                        <option data-countryCode="CO" value="57">Colombia (+57)</option>
                        <option data-countryCode="KM" value="269">Comoros (+269)</option>
                        <option data-countryCode="CG" value="242">Congo (+242)</option>
                        <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                        <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                        <option data-countryCode="HR" value="385">Croatia (+385)</option>
                        <option data-countryCode="CU" value="53">Cuba (+53)</option>
                        <option data-countryCode="CY" value="90">Cyprus - North (+90)</option>
                        <option data-countryCode="CY" value="357">Cyprus - South (+357)</option>
                        <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
                        <option data-countryCode="DK" value="45">Denmark (+45)</option>
                        <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                        <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                        <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                        <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                        <option data-countryCode="EG" value="20">Egypt (+20)</option>
                        <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                        <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                        <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                        <option data-countryCode="EE" value="372">Estonia (+372)</option>
                        <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                        <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                        <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                        <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                        <option data-countryCode="FI" value="358">Finland (+358)</option>
                        <option data-countryCode="FR" value="33">France (+33)</option>
                        <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                        <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                        <option data-countryCode="GA" value="241">Gabon (+241)</option>
                        <option data-countryCode="GM" value="220">Gambia (+220)</option>
                        <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                        <option data-countryCode="DE" value="49">Germany (+49)</option>
                        <option data-countryCode="GH" value="233">Ghana (+233)</option>
                        <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                        <option data-countryCode="GR" value="30">Greece (+30)</option>
                        <option data-countryCode="GL" value="299">Greenland (+299)</option>
                        <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                        <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                        <option data-countryCode="GU" value="671">Guam (+671)</option>
                        <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                        <option data-countryCode="GN" value="224">Guinea (+224)</option>
                        <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                        <option data-countryCode="GY" value="592">Guyana (+592)</option>
                        <option data-countryCode="HT" value="509">Haiti (+509)</option>
                        <option data-countryCode="HN" value="504">Honduras (+504)</option>
                        <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                        <option data-countryCode="HU" value="36">Hungary (+36)</option>
                        <option data-countryCode="IS" value="354">Iceland (+354)</option>
                        <option data-countryCode="IN" value="91">India (+91)</option>
                        <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                        <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                        <option data-countryCode="IR" value="98">Iran (+98)</option>
                        <option data-countryCode="IE" value="353">Ireland (+353)</option>
                        <option data-countryCode="IL" value="972">Israel (+972)</option>
                        <option data-countryCode="IT" value="39">Italy (+39)</option>
                        <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                        <option data-countryCode="JP" value="81">Japan (+81)</option>
                        <option data-countryCode="JO" value="962">Jordan (+962)</option>
                        <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                        <option data-countryCode="KE" value="254">Kenya (+254)</option>
                        <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                        <option data-countryCode="KP" value="850">Korea - North (+850)</option>
                        <option data-countryCode="KR" value="82">Korea - South (+82)</option>
                        <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                        <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                        <option data-countryCode="LA" value="856">Laos (+856)</option>
                        <option data-countryCode="LV" value="371">Latvia (+371)</option>
                        <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                        <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                        <option data-countryCode="LR" value="231">Liberia (+231)</option>
                        <option data-countryCode="LY" value="218">Libya (+218)</option>
                        <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                        <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                        <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                        <option data-countryCode="MO" value="853">Macao (+853)</option>
                        <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                        <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                        <option data-countryCode="MW" value="265">Malawi (+265)</option>
                        <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                        <option data-countryCode="MV" value="960">Maldives (+960)</option>
                        <option data-countryCode="ML" value="223">Mali (+223)</option>
                        <option data-countryCode="MT" value="356">Malta (+356)</option>
                        <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                        <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                        <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                        <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                        <option data-countryCode="MX" value="52">Mexico (+52)</option>
                        <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                        <option data-countryCode="MD" value="373">Moldova (+373)</option>
                        <option data-countryCode="MC" value="377">Monaco (+377)</option>
                        <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                        <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                        <option data-countryCode="MA" value="212">Morocco (+212)</option>
                        <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                        <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                        <option data-countryCode="NA" value="264">Namibia (+264)</option>
                        <option data-countryCode="NR" value="674">Nauru (+674)</option>
                        <option data-countryCode="NP" value="977">Nepal (+977)</option>
                        <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                        <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                        <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                        <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                        <option data-countryCode="NE" value="227">Niger (+227)</option>
                        <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                        <option data-countryCode="NU" value="683">Niue (+683)</option>
                        <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                        <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                        <option data-countryCode="NO" value="47">Norway (+47)</option>
                        <option data-countryCode="OM" value="968">Oman (+968)</option>
                        <option data-countryCode="PK" value="92">Pakistan (+92)</option>
                        <option data-countryCode="PW" value="680">Palau (+680)</option>
                        <option data-countryCode="PA" value="507">Panama (+507)</option>
                        <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                        <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                        <option data-countryCode="PE" value="51">Peru (+51)</option>
                        <option data-countryCode="PH" value="63" selected>Philippines (+63)</option>
                        <option data-countryCode="PL" value="48">Poland (+48)</option>
                        <option data-countryCode="PT" value="351">Portugal (+351)</option>
                        <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                        <option data-countryCode="QA" value="974">Qatar (+974)</option>
                        <option data-countryCode="RE" value="262">Reunion (+262)</option>
                        <option data-countryCode="RO" value="40">Romania (+40)</option>
                        <option data-countryCode="RU" value="7">Russia (+7)</option>
                        <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                        <option data-countryCode="SM" value="378">San Marino (+378)</option>
                        <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                        <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                        <option data-countryCode="SN" value="221">Senegal (+221)</option>
                        <option data-countryCode="CS" value="381">Serbia (+381)</option>
                        <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                        <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                        <option data-countryCode="SG" value="65">Singapore (+65)</option>
                        <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                        <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                        <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                        <option data-countryCode="SO" value="252">Somalia (+252)</option>
                        <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                        <option data-countryCode="ES" value="34">Spain (+34)</option>
                        <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                        <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                        <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                        <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                        <option data-countryCode="SR" value="597">Suriname (+597)</option>
                        <option data-countryCode="SD" value="249">Sudan (+249)</option>
                        <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                        <option data-countryCode="SE" value="46">Sweden (+46)</option>
                        <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                        <option data-countryCode="SY" value="963">Syria (+963)</option>
                        <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                        <option data-countryCode="TJ" value="992">Tajikistan (+992)</option>
                        <option data-countryCode="TH" value="66">Thailand (+66)</option>
                        <option data-countryCode="TG" value="228">Togo (+228)</option>
                        <option data-countryCode="TO" value="676">Tonga (+676)</option>
                        <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                        <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                        <option data-countryCode="TR" value="90">Turkey (+90)</option>
                        <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                        <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                        <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                        <option data-countryCode="UG" value="256">Uganda (+256)</option>
                        <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                        <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                        <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                        <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option>
                        <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                        <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                        <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                        <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                        <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option>
                        <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option>
                        <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                        <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                        <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                        <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                        <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                    </select>
                </div>

                <div class="col-sm-3 form-group">
                    <label for="tel">Phone:</label>
                    <input type="tel" name="phone" class="form-control" id="tel" placeholder="Enter Your Contact Number" required>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="Email">Email:</label>
                    <input type="email" class="form-control" name="Email" placeholder="Enter your Email" required>
                </div>

                <div class= "col-sm-3 form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Input Password: " required> 
                </div> 

                <div class="col-sm-3 form-group">
                    <label for="repeat_password">Repeat Password:</label>
                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:" required>
                </div> 

                <div class="col-sm-12">
                    <p class="d-inline">Already registered? <a href="login.php"> Login here</a>
                </div> 

                <div class="col-sm-12 form-group mb-0">
                    <input type= "submit" class="btn btn-primary float-right" name="Register" value="Register ">
                </div>

            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>