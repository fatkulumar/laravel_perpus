<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
        <img width="100px" src="{{ asset('grisa.png') }}" id="output2" alt="" srcset="">

        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
        </div>
        @endif


        <form method="POST" action="{{ route('register.admin.insert') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="role" id="" value="admin">

            <div>
                <x-jet-label value="{{ __('NIP') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="nip" :value="old('nip`')" required autofocus autocomplete="nip" />
            </div>

            <div>
                <x-jet-label value="{{ __('Nama') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="nama" :value="old('nama`')" required autofocus autocomplete="nama" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Nama Instansi') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="nama_instansi" :value="old('nama_instansi')" required autofocus autocomplete="nama_instansi" />
            </div>

            <div class="mt-4">
                <label class="form-control" for="nama_logo">Logo</label>
                <input class="form-control" accept="image/" onchange="loadFile(event)" type="file" name="nama_logo" value="" accept="image/*" required>
            </div>

            <!-- image preview -->
            <div class="mt-4">
                <img src="{{ asset('grisa.png') }}" class="from-control" id="output" height="150" width="150">
            </div>

                <!-- Javascript -->
            <script type="text/javascript">
                var loadFile = function(event) {
                var output = document.getElementById('output');
                var output2 = document.getElementById('output2');
                output.src = URL.createObjectURL(event.target.files[0]);
                output2.src = URL.createObjectURL(event.target.files[0]);
                };
            </script>
            


            <div class="mt-4">
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autofocus autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Confirm Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autofocus autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
