<table class="table table-striped table-hover table-responsive-lg">
    <thead>
    <tr>
        @foreach($headers as $header)
            <th> {{ $header }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
     {{$slot}}
    </tbody>
</table>
