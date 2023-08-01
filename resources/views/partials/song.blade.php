<div class="p-6 text-gray-900 dark:text-gray-100">
    {{ $song->name }}
    {{ 'Duration = ' . $song->duration}}
    {{'views ='}}
    {{'PLAY'}}
    <a href=""> {{'Add to Favorite/ Remove from favorite'}}</a>
    {{'by ' . $song->artist->name}}
</div>
