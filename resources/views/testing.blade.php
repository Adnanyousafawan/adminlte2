{{--{{ dd($customers)  }}--}}


@foreach ($projects as $project)


    <h2> Project Title: {{ $project->title }}</h2>
    <h3> Project City : {{ $project->city }} </h3>
    <h3> Project Labor : {{ $project->getLaborCountAttribute() }} </h3>
    <h3> Project Assigned to : {{ $contractors[$project->assigned_to - 1]->cont_name}} </h3>
    <h3> Project Owner: {{ $customers[$project->customer_id - 1]->name }}</h3>


@endforeach