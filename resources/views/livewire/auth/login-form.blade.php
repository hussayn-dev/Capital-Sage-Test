<div>
    <form wire:submit.prevent="login" class="mt-8 space-y-5">
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
            @if (session()->has('error'))
                <p class="text-red-500 ml-5 text-center">{{ session('error') }}</p>
            @endif
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
        </div>
        <button
            type="submit"
            class="w-full px-4 py-2 text-white font-medium bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-600 rounded-lg duration-150"
        >
            Sign in
        </button>
    </form>
</div>
