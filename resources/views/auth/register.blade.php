<x-guest-layout>
 

    <form id="phoneForm" method="post" action="{{ route('register') }}"  enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

              <!--Image -->
        <div class="mt-3">
          <x-input-label for="image" :value="__('Image')" />
          <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required autocomplete="userphoto" />
          <x-input-error :messages="$errors->get('photo')" class="mt-2" />
      </div>

             <!-- phone -->
             <div class="input_lab">
              <x-input-label for="name" :value="__('Phone')" />
              <x-text-input id="phone" class="block mt-1 w-full input_phone"  type="text" name="phone" :value="old('phone')" required autofocus autocomplete="name" />
              <x-text-input id="country_code"  type="hidden" name="country_code" :value="old('country_code')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('phone')" class="mt-2" />
          </div>

        <!-- Email Address -->
        <div class="mt-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-3" x-data="{ role: '' }">
          <x-input-label for="Role" :value="__('Role')" />
      
          <!-- Select Input for Role -->
          <select id="role" x-model="role" class="block mt-1 w-full" name="role" required>
              <option value="" disabled selected>Select a Role</option>
              <option value="admin">admin</option>
              <option value="login-user">login-user</option>
          </select>
      
          <x-input-error :messages="$errors->get('role')" class="mt-2" />
      </div>


      
    

        <div class="flex items-center justify-start mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>


    <script>

        const input = document.querySelector("#phone");
        const button = document.querySelector("#btn");
        const errorMsg = document.querySelector("#error-msg");
        const validMsg = document.querySelector("#valid-msg");
        
        // // here, the index maps to the error code returned from getValidationError - see readme
        const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
        
        // initialise plugin
        const iti = window.intlTelInput(input, {
          initialCountry: "us",
          utilsScript: "/intl-tel-input/js/utils.js?1725646185594"
        });
 document.getElementById('phoneForm').addEventListener('submit', function(event){
  event.preventDefault();

        const phoneNumber=iti.getNumber();


        const countryData=iti.getSelectedCountryData();
        const countryCode=countryData.dialCode;

       
        document.getElementById('country_code').value=countryCode;
   

        this.submit();
      });
     
        
        const reset = () => {
          input.classList.remove("error");
          errorMsg.innerHTML = "";
          errorMsg.classList.add("hide");
          validMsg.classList.add("hide");
        };
        
        const showError = (msg) => {
          input.classList.add("error");
          errorMsg.innerHTML = msg;
          errorMsg.classList.remove("hide");
        };
        
        // on click button: validate
        button.addEventListener('click', () => {
          reset();
          if (!input.value.trim()) {
            showError("Required");
          } else if (iti.isValidNumber()) {
            validMsg.classList.remove("hide");
          } else {
            const errorCode = iti.getValidationError();
            const msg = errorMap[errorCode] || "Invalid number";
            showError(msg);
          }
        });
        
        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
        
        
            </script>


            
</x-guest-layout>
