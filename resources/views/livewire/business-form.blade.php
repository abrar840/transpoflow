<div>
    @vite("resources/css/style.css")
<form wire:submit.prevent="submit">
<section class="companyform-section">
    <div class="companyform-container">
        <div class="companyform-form">
            <h3>Enter Company Information</h3>
            <br>
          
                <!-- Full Name -->


                @error('email') <span class="error">{{ $message }}</span> @enderror

                  <div class="inpu-container">
                    <label for="">theme :</label>
                    {{$theme}}
                  </div>

                <div class="input-container">
                    <label for="">Company Name :</label>
                    <input type="text" class="input-field" placeholder="" required wire:model='name'>
                    @error('name') <span class="error">{{$message}}</span> @enderror

                   
                </div>

                <!-- Email Address -->
                <div class="input-container">
                    <label for="companyType">Company Type :</label>
                    <select id="companyType" class="input-field" required wire:model="type">
                   
                        <option value=""  selected>Select Company Type</option>
                        <option value="fleet" style="color: black;">Fleet Company</option>
                        <option value="shuttle" style="color: black;">Shuttle Company</option>
                        <option value="transport" style="color: black;">Transport Company</option>
                    </select>
                    @error('type') <span class="errror">{{$message}}</span> @enderror
                 
                </div>

                <!-- addres -->
                <div class="input-container">
                    <label for="">Company Address :</label>
                    
                <input type="text" class="input-field" placeholder="" required wire:model='address'>
                 @error('address') <span class="error">{{$message}}</span> @enderror
                 
            </div>

                {{-- <!-- email -->
                <div class="input-container password-container">
                    <label for="company-email">Company email :</label>
                    <input type="tel" id="company-email" class="input-field" placeholder="" required wire:model='email'>
                    @error('email') <span class="error">{{$message}}</span>
                    @enderror
                </div> --}}
              

                <!-- services -->
                <label>Services</label>
                <div class="input-container checkbox-container">
                    <div class="checkbox-group">
                        {{-- <label><input type="checkbox" value="admin-panel"> Admin Panel</label>
                        <label><input type="checkbox" value="transport-management"> Transport Management System</label>
                        <label><input type="checkbox" value="fleet-management"> Fleet Management System</label>
                        <label><input type="checkbox" value="ticket-management"> Ticket Management System</label>
                        <label><input type="checkbox" value="cargo-management"> Cargo Management System</label>
                        <label><input type="checkbox" value="customer-support"> Customer Support</label> --}}
                         @foreach ($availableSerivces as $service)
                         <label for="">
                            <input type="checkbox" wire:model='services' value='{{$service->id}}'>
                            {{$service->name}}
                        </label>
                         @endforeach
                         
                   
                   
                   
                   
                   
                   
                   
                    </div>

                </div>

                {{-- <!-- Phone Number -->
                <div class="input-container">
                    <label>Select Color Palette</label>
                    <div class="radio-group">
                        <label class="color-option">
                            <input type="radio" name="colorPalette" value="palette-1" required>
                            <div class="color-sample color-1"></div>
                            <div class="color-sample color-2"></div>
                            <div class="color-sample color-3"></div>
                        </label>
                        <label class="color-option">
                            <input type="radio" name="colorPalette" value="palette-2">
                            <div class="color-sample color-4"></div>
                            <div class="color-sample color-5"></div>
                            <div class="color-sample color-6"></div>
                        </label>
                    </div>
                </div> --}}

                <!-- logo -->
                <div class="input-container">
                    <label for="companyLogo">Company Logo (Optional)</label>
                    <input type="file" class="input-field" id="companyLogo" accept="image/*" wire:model='logo'>
                    @error('logo') <span class="error">{{$message}}</span> @enderror
                 
                </div>




                <div class="input-container">
                    <label for="adminUsername">Admin Username</label>
                    <input type="text" class="input-field" id="adminUsername" required wire:model='admin_username'>
                    @error('admin_username') <span class="error">{{$message}}</span> @enderror
                 
                </div>

                <div class="input-container">
                    <label for="numEmployees">Number of Employees</label>
                    <select id="numEmployees" class="input-field" required wire:model="num_employees">
                        <option value="" disabled selected>Select Number of Employees</option>
                        <option value="<5" style="color: black;">Less than 5</option>
                        <option value="5-20" style="color: black;">5 to 20</option>
                        <option value="20-100" style="color: black;">20 to 100</option>
                        <option value="100-250" style="color: black;">100 to 250</option>
                        <option value=">250" style="color: black;">More than 250</option>
                        @error('num_employes') <span class="error">{{$message}}</span> @enderror
                       
                    </select>
                </div>

                {{-- <div class="input-container">
                    <label for="adminPassword">Admin Password</label>
                    <input type="password" class="input-field" id="adminPassword" required>
                </div> --}}


                <div style="text-align: center; margin-top: 20px;">
                    <button type="submit" class="btn-submit">Start Creating My Website</button>
                </div>
        

        </div>
    </div>
</section>
</form>

 <!-- Success Message -->
 @if (session()->has('success'))
 <div class="success">
     {{ session('success') }}
 </div>
@endif

</div>