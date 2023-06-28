<div>
    <form wire:submit.prevent="register" >
        <div>
            <label class="font-medium">
                Name
            </label>
            <input
                wire:model="name"
                type="text"
                required
                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
            />
            @error('name')
            <p class="text-red-500 mt-1">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label class="font-medium">
                Email
            </label>
            <input
                wire:model="email"
                type="email"
                required
                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
            />
            @error('email')
            <p class="text-red-500 mt-1">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label class="font-medium">
                Password
            </label>
            <input
                wire:model="password"
                type="password"
                required
                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
            />
            @error('password')
            <p class="text-red-500 mt-1">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label class="font-medium">
                Confirm Password
            </label>
            <input
                wire:model="password_confirmation"
                type="password"
                required
                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
            />

        </div>
        <button
            class="w-full px-4 mt-4 py-2 text-white font-medium bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-600 rounded-lg duration-150"
        >
            Create account
        </button>
    </form>

</div>
