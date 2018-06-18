<div class="search">
    <form method="get" action="/search_results">
        @csrf
        <input type="text" name="search" placeholder="Search for Polls">
        <input type="submit" value="Search">
    </form>
</div>