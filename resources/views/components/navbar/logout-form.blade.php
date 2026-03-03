<h3 class="text-gray-500 text-lg"> {{ Auth::user()['username'] }} </h3>
<form action="/logout" method="POST">
    @csrf
    <button type="submit" class="text-sm font-medium text-gray-500 hover:text-gray-900 underline">Log Out</button>
</form>
