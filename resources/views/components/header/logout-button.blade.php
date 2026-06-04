<form method="POST" action="{{ route('logout') }}" class="flex items-center">
    @csrf
    <button type="submit" class="text-white/90 hover:text-white text-sm font-semibold px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
        Logout
    </button>
</form>

