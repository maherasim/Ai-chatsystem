<?php $page = 'signin'; ?> 
@extends('layout.mainlayout')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Genos:wght@400&display=swap" rel="stylesheet">

<style>
body, html {
    height: 100%;
    margin: 0;
    font-family: 'Genos', sans-serif;
}
hr{
border-color: #c0c0c0;
  margin: 10px;
}
.modal-header{
    padding-bottom:0px !important;
}
.login-container {
    display: flex;
    height: 100vh;
    width: 100%;
}

/* LEFT PANEL */
.login-left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(10px);
    padding: 2rem;
}

.login-box {
    max-width: 400px;
    width: 100%;
    text-align: center;
}

.login-box img {
    max-width: 200px;
    margin-bottom: 1.5rem;
}

.login-box h2 {
    font-size: 22px;
    margin-bottom: 2rem;
    font-weight: 400;
}

/* INPUT STYLES */
.input-icon {
    position: relative;
    margin-bottom: 1rem;
}

.input-icon input {
    width: 100%;
    padding: 12px 40px 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
}

.input-icon input:focus {
    border-color: #3d8bff;
    box-shadow: 0 0 5px rgba(61, 139, 255, 0.4);
}

.input-icon img {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    opacity: 0.6;
}
.custom-modal {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    overflow: hidden;
}

.custom-modal .modal-header h5 {
    font-size: 20px;
    font-weight: 600;
}

.sub-header {
    color: #6c757d;
    font-size: 14px;
}

.section-title {
    font-size: 16px;
    font-weight: 600;
}

.submitbtn{
    opacity: 0.3;
}

.accept-btn {
    background: #28a745;
    color: #fff;
    font-size: 16px;
    border-radius: 10px;
    transition: 0.3s;
    border: none;
}
.accept-btn:hover {
    background: #218838;
}

.footer-menu {
    display: flex;
    justify-content: space-around;
    padding: 1rem;
    border-top: 1px solid #ddd;
    background: #f9f9f9;
}
.footer-menu div {
    text-align: center;
    font-size: 13px;
}
.footer-menu img {
    width: 28px;
    margin-bottom: 5px;
}


/* BUTTON STYLE */
.login-box button {
    width: 100%;
    padding: 12px;
    background: #3d8bff;
    border: none;
    color: #fff;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.login-box button:hover {
    background: #2466cc;
}

/* RIGHT PANEL IMAGE */
.login-right {
    flex: 1;
    background: url("{{ URL::asset('/build/img/userlogo.png') }}") no-repeat center center;
    background-size: cover;
}

/* MODAL FOOTER MENU */
.footer-menu {
    display: flex;
    justify-content: space-around;
    padding: 1rem;
    border-top: 1px solid #ddd;
}
.footer-menu div {
    text-align: center;
}
.footer-menu img {
    width: 30px;
    display: block;
    margin: 0 auto 5px;
}
</style>

<div class="login-container">
    <!-- LEFT SIDE -->
    <div class="login-left">
        <div class="login-box">
            <img src="{{URL::asset('/build/img/welogo.svg')}}" alt="Logo">
            <h2 style="font-family: Genos">Let’s build tomorrow</h2>

            <form id="loginForm" action="{{ url('custom-login') }}" method="POST">
                @csrf
                <div class="input-icon">
                    <input type="text" name="user_id" placeholder="User ID" style="background-color:#ECECEC">
                    <img src="{{URL::asset('/build/img/User Circle.svg')}}" alt="">
                </div>
                <div class="input-icon">
                    <input type="email" name="email" placeholder="E-Mail" style="background-color:#ECECEC">
                    <img src="{{URL::asset('/build/img/email_icon.svg')}}" alt="">
                </div>
                <div class="input-icon">
                    <input type="password" name="password" placeholder="Password" style="background-color:#ECECEC">
                    <img src="{{URL::asset('/build/img/password_icon.svg')}}" alt="">
                </div>
                <button type="submit" id="enterBtn" style="background: #5F9CE3; color: white;width:50%">
                    ENTER
                </button>
            </form>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="login-right"></div>
</div>

<style>
    .accept-img{
        cursor:pointer;
        display:flex;
        height:200px;
        align-items: center;
    }
    .foter{
        cursor:pointer;
    }
    .factive{
        font-weight:700;
    }
</style>

<!-- MODAL -->
<!-- MODAL -->
<div class="modal fade" id="policyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content custom-modal">

            <!-- Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" >Hello & Welcome<br>
                    <span id="dev_name"></span>
                </h5>
                
            </div>
            <hr />
         
            <!-- Sub-header -->

           

        <div id="policy_div">
            <div class="px-4">
                <h6 class="fw-semibold mb-3">Policy and Terms</h6>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="modal-body px-4" style="max-height: 250px; overflow-y:auto;">
                        {!! $policyTerm ?? 'No policy available.' !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center pb-3 accept-img accept-policy">
                        <img src="{{URL::asset('/build/img/accept.jpg')}}" alt="Accept Icon" style="width:100px;margin-right:10px;">
                    </div>
                </div>
            </div>
        </div>

        <div id="agreement_div" style="display:none;">
            <div class="px-4">
                <h6 class="fw-semibold mb-3">Agreement</h6>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="modal-body px-4" style="max-height: 250px; overflow-y:auto;">
                        {!! $agreement_text ?? 'No agreement available.' !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center pb-3 accept-img accept-agreement">
                        <img src="{{URL::asset('/build/img/accept.jpg')}}" alt="Accept Icon" style="width:100px;margin-right:10px;">
                    </div>
                </div>
            </div>
        </div>  
        <form onSubmit="return validt();" id="profileForm" action="{{ route('profile.complete') }}" method="POST" enctype="multipart/form-data">
        @csrf 
             <input type="hidden" name="policy" id="policy_accept_val" value="0" />
            <input type="hidden" name="agreement" id="agreement_accept_val" value="0" />

        <div id="profile_div" style="display:none;">
            <div class="px-4">
                <h6 class="fw-semibold ">Update Your Profile</h6>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="modal-body px-4" style="max-height: 250px; overflow-y:auto;">

                    <!-- profile area starts -->
                        <div style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; display: flex; gap: 16px; flex-wrap: wrap; position: relative;">
                <!-- User Type (Top-right) -->
                


                <!-- User Image Upload -->
                <div onclick="document.getElementById('userImgInput').click();" style="flex: 0 0 100px; height: 100px; background-color: #f9fafb; border: 2px dashed #e5e7eb; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative;">
                    <img id="userImgPreview" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; display: none;">
                    <div id="userImgPlaceholder" style="text-align: center; color: #9ca3af; font-size: 24px;">
                        +
                    </div>
                    <input name="image" type="file" id="userImgInput" accept="image/*" style="display: none;" onchange="(function(event){ const input = event.target; const preview = document.getElementById('userImgPreview'); const placeholder = document.getElementById('userImgPlaceholder'); if (input.files &amp;&amp; input.files[0]) { const reader = new FileReader(); reader.onload = function (e) { preview.src = e.target.result;  preview.style.display = 'block';  placeholder.style.display = 'none'; }; reader.readAsDataURL(input.files[0]); } })(event)">
                </div>

                <!-- Info Fields -->
                <div style="flex: 1;margin-top: 10px;">
                    <div style="font-weight: 600; font-size: 15px; color: #2a2b4c;">
                        User Info
                    </div>
                    <div style="font-size: 12px; color: #9ca3af; margin-bottom: 8px;">
                        Add the User info here
                    </div>

                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <select name="country" style="flex: 1; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; background-color: white;">
                            <option value="" selected disabled>Select Country</option>
    <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
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
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
    <option value="Botswana">Botswana</option>
    <option value="Brazil">Brazil</option>
    <option value="Brunei">Brunei</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Cape Verde">Cape Verde</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Costa Rica">Costa Rica</option>
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
    <option value="Estonia">Estonia</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Greece">Greece</option>
    <option value="Grenada">Grenada</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Honduras">Honduras</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Laos">Laos</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libya">Libya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mexico">Mexico</option>
    <option value="Moldova">Moldova</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montenegro">Montenegro</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Namibia">Namibia</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="North Korea">North Korea</option>
    <option value="North Macedonia">North Macedonia</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palestine">Palestine</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Qatar">Qatar</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russia</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    <option value="Saint Lucia">Saint Lucia</option>
    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
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
    <option value="South Korea">South Korea</option>
    <option value="South Sudan">South Sudan</option>
    <option value="Spain">Spain</option>
    <option value="Sri Lanka">Sri Lanka</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Swaziland">Swaziland</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syria</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania</option>
    <option value="Thailand">Thailand</option>
    <option value="Togo">Togo</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Vatican City">Vatican City</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Vietnam</option>
    <option value="Yemen">Yemen</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>
                            
                        </select>
                        <input type="text" placeholder="First and Last Name" required="" name="name" style="flex: 2; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; background-color: white;">
                        
                    </div>
                </div>


            </div>

            <div class="mt-3" style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px">
                <!-- Title -->
                <div style="font-weight: 600; font-size: 15px; color: #2a2b4c;">Password</div>
                <div style="font-size: 12px; color: #9ca3af; margin-bottom: 12px;">Set a New Password</div>

                <!-- Input Row -->
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">

                    <!-- Email Input -->
                    <div style="flex: 1; display: flex; align-items: center; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px;">
                        <span style="color: #9ca3af; margin-right: 8px;">
                            <img src="http://127.0.0.1:8000/build/img/password.svg" alt="" style="width: 20px;">
                        </span>
                        <input name="password" id="password" required="required" type="password" placeholder="Type your password here" style="border: none; outline: none; font-size: 13px; color: #333; flex: 1; background: transparent;">
                    </div>

                    <!-- Confirm Email Input -->
                    <div style="flex: 1; display: flex; align-items: center; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px;">
                        <span style="color: #9ca3af; margin-right: 8px;">
                            <img src="https://admin.onlinesystems.info/build/img/password.svg" alt="" style="width: 20px;">
                        </span>
                        <input type="password" id="repassword" name="password_confirmation" required="required" placeholder="Re enter password here" style="border: none; outline: none; font-size: 13px; color: #333; flex: 1; background: transparent;">
                    </div>

                </div>
            </div>


                    <!-- profile area ends -->
                       
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center pb-3  " style="padding:10px;">

<div onclick="document.getElementById('cardImgInput').click();" style="background-color: #f6f6f9; border-radius: 12px; height: 120px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; cursor: pointer; position: relative; overflow: hidden;">
                <img id="bannerPreview" src="" alt="Banner Preview" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 12px; display: none;">

                <div id="bannerPlaceholder" style="text-align: center; color: #9ca3af; z-index: 1;">
                    <div style="font-size: 28px; font-weight: 400;">+</div>
                    <div style="font-size: 14px; font-weight: 500;">ID Card for front Side</div>
                    <div style="font-size: 12px;">JPG or PNG</div>
                </div>

                <input name="cardImgInput" type="file" id="cardImgInput" accept="image/*" style="display: none;" onchange="(function(event) { const input = event.target; const preview = document.getElementById('bannerPreview'); const placeholder = document.getElementById('bannerPlaceholder'); if (input.files &amp;&amp; input.files[0]) { const reader = new FileReader(); reader.onload = function(e) { preview.src = e.target.result; preview.style.display = 'block'; placeholder.style.display = 'none'; }
                    reader.readAsDataURL(input.files[0]); }
                  })(event)">
            </div>
                    
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>  

            <!-- Accept Button -->
            

            <!-- Footer -->
            <div class="footer-menu footer-icons">
                <div class="foter policy factive">
                    <img src="{{URL::asset('/build/img/policy.png')}}" alt="Policy Icon">
                    <span>Policy & Terms</span>
                    <small>Our Connect.ltd Roles</small>
                </div>
                <div class="foter agreement">
                    <img src="{{URL::asset('/build/img/agreement.png')}}" alt="Agreement Icon">
                    <span>Agreement</span>
                    <small>Our Connect.ltd Agreement</small>
                </div>
                <div class="foter profile">
                    <img src="{{URL::asset('/build/img/profile.png')}}" alt="Profile Icon" style="width:unset;">
                    <span>Your Profile</span>
                    <small>Our Connect.ltd Roles</small>
                </div>

                <div class="foter ">
                    <button  id="outsideSubmitBtn" type="button"  class="btn btn-info submitbtn">Update Profile</button>
                    
                </div>

            </div>
        </div>
    </div>
</div>


<!-- SCRIPT -->
<script>


document.addEventListener("DOMContentLoaded", function () {
    
    const profileForm = document.getElementById("profileForm");
    const policyVal = document.getElementById("policy_accept_val");
    const agreementVal = document.getElementById("agreement_accept_val");

    const agreementImg = document.getElementById("agreementImg");
    const outsideSubmitBtn = document.getElementById("outsideSubmitBtn");

    const userImgInput = document.getElementById("userImgInput");
    const cardImgInput = document.getElementById("cardImgInput");
    const nameInput   = profileForm.querySelector("input[name='name']");
    const emailInput  = profileForm.querySelector("input[name='email']");
    const mobileInput = profileForm.querySelector("input[name='phone']");
    const countrySel  = profileForm.querySelector("select[name='country']");
    
    // ✅ Outside button click
    outsideSubmitBtn.addEventListener("click", function (event) {
        
        event.preventDefault();

        if (policyVal.value !== "1" && agreementVal.value !== "1") {
            return;
        }

        if (policyVal.value !== "1" || agreementVal.value !== "1") {
            alert("Please accept both Policy and Agreement before submitting your profile.");
            return;
        }


        if (!nameInput.value.trim()) {
            alert("Please enter your full name.");
            nameInput.focus();
            return;
        }

     /*
        if (!emailInput.value.trim()) {
            alert("Please enter your email.");
            emailInput.focus();
            return;
        }

       
        if (!mobileInput.value.trim()) {
            alert("Please enter your mobile number.");
            mobileInput.focus();
            return;
        }
*/
        
        if (!countrySel.value) {
            alert("Please select a country.");
            countrySel.focus();
            return;
        }

        
        if (!userImgInput.files.length) {
            alert("Please upload your profile image.");
            return;
        }

        if (cardImgInput && !cardImgInput.files.length) {
            alert("Please upload your card image.");
            return;
        }

        const password = document.getElementById("password").value.trim();
        const repassword = document.getElementById("repassword").value.trim();

        if (!password || !repassword) {
            alert("Please enter and confirm your password.");
            return;
        }

        if (password !== repassword) {
            alert("Passwords do not match. Please re-enter.");
            document.getElementById("repassword").focus();
            return;
        }
        // Submit via normal POST (full page reload)
        profileForm.submit();
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    const enterBtn = document.getElementById("enterBtn");

    const acceptBtn = document.getElementById("acceptPolicy");

    enterBtn.addEventListener("click", function (event) {
        event.preventDefault();

        // AJAX login request
        fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.redirect) {
                window.location.href = data.redirect; // direct login
            } else if (data.require_info) {
                // Show policy & extra info modal
                var myModal = new bootstrap.Modal(document.getElementById('policyModal'));
                myModal.show();
                
                let username = data.user.name;
                document.getElementById("dev_name").innerText = username;


            } else {
                alert(data.message || "Login failed");
            }
        });
    });

    // When user accepts + uploads info
    acceptBtn.addEventListener("click", function () {
        const profileForm = document.getElementById("profileForm");

        fetch(profileForm.action, {
            method: "POST",
            body: new FormData(profileForm),
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.redirect) {
                window.location.href = data.redirect; // login after completion
            } else {
                alert("Please fill all fields correctly");
            }
        });
    });
});

    function validt(){
        return false;
    }

   document.addEventListener('DOMContentLoaded', function () {
    function showDiv(divId) {
        // hide all divs
        document.getElementById('policy_div').style.display = 'none';
        document.getElementById('agreement_div').style.display = 'none';
        document.getElementById('profile_div').style.display = 'none';

        const policyVal_c = document.getElementById("policy_accept_val");
        const agreementVal_c = document.getElementById("agreement_accept_val");


        if (policyVal_c.value == "1" && agreementVal_c.value == "1") {
            let box = document.getElementById("outsideSubmitBtn");
            box.classList.remove("submitbtn")
           
        }

        // show the requested one
        document.getElementById(divId).style.display = 'block';

        // remove active from all footer items
        document.querySelectorAll('.footer-menu .foter').forEach(function(el) {
            el.classList.remove('factive');
        });

        // add active to the matching footer
        if (divId === 'policy_div') {
            document.querySelector('.footer-menu .policy').classList.add('factive');
        } else if (divId === 'agreement_div') {
            document.querySelector('.footer-menu .agreement').classList.add('factive');
        } else if (divId === 'profile_div') {
            document.querySelector('.footer-menu .profile').classList.add('factive');
        }
    }

    // when clicking accept-policy → show agreement
    document.querySelector('.accept-policy').addEventListener('click', function () {
        document.getElementById("policy_accept_val").value = "1";
        showDiv('agreement_div');
    });

    // when clicking accept-agreement → show profile
    document.querySelector('.accept-agreement').addEventListener('click', function () {
        document.getElementById("agreement_accept_val").value = "1";
        showDiv('profile_div');
    });

    // footer clicks
    document.querySelector('.footer-menu .policy').addEventListener('click', function () {
        showDiv('policy_div');
    });

    document.querySelector('.footer-menu .agreement').addEventListener('click', function () {
        showDiv('agreement_div');
    });
    //new changes

    document.querySelector('.footer-menu .profile').addEventListener('click', function () {
        showDiv('profile_div');
    });
});

</script>
@endsection
