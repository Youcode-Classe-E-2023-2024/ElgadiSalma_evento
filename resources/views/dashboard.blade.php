<div>
<h1>salmaaaa</h1>
<a class="flex items-center hover:text-gray-200" href="#">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-white no-underline flex items-center hover:bg-grey-dark border border-gray-100 rounded-xl">Log out</button>
    </form>
</a>             
</div>
