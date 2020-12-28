<?php
    ob_start();
    if(isset($_POST['register_user']))
    {
        require 'CurrencyExchange.php';
        $register=new CurrencyExchange();
        $isCreated=$register->registerUser($_POST['name'],$_POST['email'],$_POST['password'],$_POST['phone'],$_POST['address'],$_POST['city'],$_POST['state'],$_POST['zipcode'],$_POST['country']);
        if($isCreated)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin:0!important">
            <strong>User Registration Successfully</strong><br>Email Verification Link has been sent to your registered email address!!Verify your email.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:0!important">
            <strong>User Registration Error</strong><br>Email or Mobile Number is already exists!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/intlTelInput.css?v=<?php echo time()?>">
    <link href="assets/css/user-register.css?v=<?php echo time()?>" rel="stylesheet" type="text/css">
</head>
<body>
    <?php require_once 'partials/header.php'?>
    <div class="container my-4">
        <form class="w-50" style="margin: 0 auto;" id="register" method="POST" action="user-register.php">
            <div class="form-group">
                <label for="Name">Full Name*</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Full Name">
                <span id="name_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label for="email_address">Email Address*</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                <span id="email_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" name="password" id="pass" class="form-control" placeholder="Password">
                <span id="password_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label for="Phone">Phone*</label><br>
                <input type="tel" placeholder="" id="telephone" class="form-control" name="phone">
                <span class="hide" id="valid-msg">✓ Valid</span>
                <span class="hide" id="error-msg"></span>
                <span id="phone_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label for="Address">Address*</label>
                <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
                <span id="address_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label for="City">City*</label>
                <input name="city" class="form-control" placeholder="City" id="city">
                <span id="city_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label for="State">State*</label>
                <input name="state" class="form-control" placeholder="State" id="state">
                <span id="state_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label for="Zip code">Zip Code*</label>
                <input name="zipcode" class="form-control" placeholder="ZipCode/Pincode" id="zipcode">
                <span id="zipcode_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <label>Select Country*</label>
                <select id="country" name="country" class="form-control">
                    <option value="0">Select Country</option>
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
                    <option value="Philippines">Philippines</option>
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
                <span id="country_error_msg" class="error_msg"></span>
            </div>   
            <div class="form-group">
                <input type="submit" value="Register" class="btn btn-success" name="register_user">
            </div>
        </form> 
    </div>
    <?php require_once 'partials/footer.php'?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="assets/js/international dial/intlTelInput.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
         let phone_error=false;
        var phone=document.querySelector('#telephone'),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");
            var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
            var intl = window.intlTelInput(phone, {
                utilsScript: "assets/js/international dial/utils.js"
            });
        window.intlTelInput(phone,{
            allowDropdown:true,
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io?token=4a428a5a4368e1", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
            utilsScript: "assets/js/international dial/utils.js",
        });

        var reset = function() {
        phone.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
        };

                
        // Validate on blur event
        phone.addEventListener('blur', function() {
            reset();
            if(phone.value.trim()){
                if(intl.isValidNumber()){
                    validMsg.classList.remove("hide");
                }else{
                    phone_error=true;
                    phone.classList.add("error");
                    var errorCode = intl.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        });

        // Reset on keyup/change event
        phone.addEventListener('change', reset);
        phone.addEventListener('keyup', reset);

    // start of input validation
    $(document).ready(function()
    {   
        $('#name_error_msg').hide();
        $('#email_error_msg').hide();
        $('#password_error_msg').hide();
        $('#phone_error_msg').hide();
        $('#address_error_msg').hide();
        $('#city_error_msg').hide();
        $('#state_error_msg').hide();
        $('#zipcode_error_msg').hide();
        $('#country_error_msg').hide();
        
        let name_error=false;
        let email_error=false;
        let password_error=false;
        let address_error=false;
        let city_error=false;
        let state_error=false;
        let zipcode_error=false;
        let country_error=false;

        $('#name').focusout(function(){
            checkName();
        });

        $('#email').focusout(function()
        {
            checkEmail();
        });

        $('#pass').focusout(function()
        {
            checkPass();
        });

        $('#telephone').focusout(function()
        {   
            checkMobile();
        });

        $('#address').focusout(function()
        {
            checkAddress();
        });

        $('#city').focusout(function () { 
            checkCity();
         });

        $('#state').focusout(function () { 
            checkState();
         });

        $('#zipcode').focusout(function () { 
            checkZip();
         });

        $('#country').focusout(function()
        {
            checkCountry();
        });
        function checkName()
        {
            var pattern = /^[a-zA-Z ]*$/;
            let name=$('#name').val();
            let namelength=name.length;
            if(namelength>1)
            {
                if(pattern.test(name) && name!='')
                {
                    $('#name_error_msg').hide();
                    $('#name').css("border-bottom","2px solid #34F458");
                }
                else
                {
                    $("#name_error_msg").html("Should contain only Characters");
                    $('#name_error_msg').show();
                    $("#name").css("border-bottom","2px solid #F90A0A");
                    name_error = true;

                }
            }
            else
            {
                    $("#name_error_msg").html("Name can not be empty!");
                    $('#name_error_msg').show();
                    $("#name").css("border-bottom","2px solid #F90A0A");
                    name_error = true;
            }
        }

        function checkEmail()
        {
            let pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            let email=$('#email').val();
            if(pattern.test(email) && email!='')
            {
                $('#email_error_msg').hide();
                $('#email').css("border-bottom","2px solid #34F458"); 
            }
            else
            {
                $("#email_error_msg").html("Email pattern does not match!");
                $('#email_error_msg').show();
                $("#email").css("border-bottom","2px solid #F90A0A");
                email_error = true;
            }
        }

        function checkPass()
        {
            let pattern=/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
            let pass=$('#pass').val();
            let passlenght=$('#pass').val().length;
            if(pattern.test(pass) && pass!='' && passlenght>=8)
            {
                $('#password_error_msg').hide();
                $('#pass').css("border-bottom","2px solid #34F458"); 
            }
            else
            {
                $("#password_error_msg").html("<ul><li>Must be at least 8 characters</li><li>At least 1 number, 1 lowercase, 1 uppercase letter</li><li>At least 1 special character from @#$%&</li></ul>");
                $('#password_error_msg').show();
                $("#pass").css("border-bottom","2px solid #F90A0A");
                password_error = true;
            }
        }

        function checkMobile()
        {
            let pattern=/[0-9]/;
            let phone=$('#telephone').val();
            if(pattern.test(phone) && phone!='')
            {
                $('#phone_error_msg').hide();
                $('#telephone').css("border-bottom","2px solid #34F458"); 
            }
            else
            {
                $("#phone_error_msg").html("Phone number must be digit and can not be empty!");
                $('#phone_error_msg').show();
                $("#telephone").css("border-bottom","2px solid #F90A0A");
                phone_error = true;
            }
        }

        function checkAddress()
        {
            let address=$('#address').val();
            if(address!='')
            {
                $('#address_error_msg').hide();
                $('#address').css("border-bottom","2px solid #34F458");  
            }
            else
            {
                $("#address_error_msg").html("Address Field can not be empty");
                $('#address_error_msg').show();
                $("#address").css("border-bottom","2px solid #F90A0A");
                address_error = true;
            }
        }

        function checkCity() 
        {
            let city=$('#city').val();
            if(city!='')
            {
                $('#city_error_msg').hide();
                $('#city').css("border-bottom","2px solid #34F458");  
            }
            else
            {
                $("#city_error_msg").html("City Field can not be empty");
                $('#city_error_msg').show();
                $("#city").css("border-bottom","2px solid #F90A0A");
                city_error = true;
            }      
        }

        function checkState() {
           let state=$('#state').val();
           if(state!='')
           {
                $('#state_error_msg').hide();
                $('#state').css("border-bottom","2px solid #34F458");
           }
           else
           {
                $("#state_error_msg").html("State Field can not be empty");
                $('#state_error_msg').show();
                $("#state").css("border-bottom","2px solid #F90A0A");
                state_error = true;
           }
        }

        function checkZip() {
            let zip=$('#zipcode').val();
            let pattern=/[0-9]/;
            let ziplength=$('#zipcode').val().length;
            if(pattern.test(zip) && zip!='' && ziplength>=6)
            {
                $('#zipcode_error_msg').hide();
                $('#zipcode').css("border-bottom","2px solid #34F458");
            }
            else
            {
                $("#zipcode_error_msg").html("Zipcode Field can not be empty and must be more than 6 digits");
                $('#zipcode_error_msg').show();
                $("#zipcode").css("border-bottom","2px solid #F90A0A");
                zipcode_error = true;
            }       
        }

        function checkCountry()
        {
            let country=$('#country').val();
            if(country!=0)
            {
                $('#country_error_msg').hide();
                $('#country').css("border-bottom","2px solid #34F458");  
            }
            else
            {
                $("#country_error_msg").html("Please Select a country");
                $('#country_error_msg').show();
                $("#country").css("border-bottom","2px solid #F90A0A");
                country_error = true;
            }
        }

        $('#register').submit(function()
        {
            name_error=false;
            email_error=false;
            password_error=false;
            phone_error=false;
            address_error=false;
            city_error=false;
            state_error=false;
            zipcode_error=false;
            country_error=false;

            checkName();
            checkEmail();
            checkPass();
            checkMobile();
            checkAddress();
            checkCity();
            checkState();
            checkZip();
            checkCountry();
            
            if(name_error===false && email_error===false && password_error===false && phone_error===false && address_error===false && city_error===false && state_error===false && zipcode_error===false && country_error===false)
            {
                return true;
            }
            else
            {
                alert("All fields are required!!");
                return false;
            }
        });

    });
    </script>
    <?php ob_flush();?>
</body>
</html>
