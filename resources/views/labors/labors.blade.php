<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/images">
    {{--
    <link rel="stylesheet" href="/js/jquery-3.4.1.js">
    <link rel="stylesheet" href="/js/jquery.dataTables.js"> --}}

    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/js/jquery.dataTables.js"></script>

    {{--

        <link rel="stylesheet" href="{{ URL::asset('resources/assets/css/jquery.dataTables.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('../resources/assets/js/jquery-3.4.1.js') }}">
        <link rel="stylesheet" href="{{ URL::asset('../resources/assets/js/jquery.dataTables.js') }}"> --}}


    {{--
    {!! Html::style('../adminlte2/resources/assets/css/bootstrap.css') !!}
    {!! Html::style('../resources/assets/css/jquery.dataTables.css') !!}
    {!! Html::style('../resources/assets/js/jquery-3.4.1.js') !!}
    {!! Html::style('../resources/assets/js/jquery.dataTables.js') !!}  --}}


</head>

<style type="text/css">
    .wrapper {
        width: 80%;
        margin: 0 auto;
        background: #eee;
        margin-top: 10px;
    }
</style>

<body>


<div class="box-primary">
    <div class="col-md-10 col-sm-10 col-lg-10 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
        <section class="box-body">
            <div class="panel-heading">
                <b>Labor Info</b>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table-bordered labor">
                    <thead>
                    <th>Labor ID</th>
                    <th>Name</th>
                    <th>Project Id</th>
                    <th>Present</th>
                    <th>Labor Rate</th>
                    <th>Cost</th>
                    </thead>
                    <tbody>

                    @foreach ($labors as $labor)
                        <tr>
                            <td>lb0000{{ $labor->id }}</td>
                            <td>{{ $labor->name }}</td>
                            <td>PR000011</td>
                            <td>23</td>
                            <td>{{ $labor->rate }}</td>
                            <td>25000</td>
                            {{-- <td style="max-width: 95px; min-width: 30">
                            <a type="links" href="{{ route('labors.edit', ['id' => $labor->id]) }}" style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                            <a type="button" data-toggle="modal" data-target="#applicantDeleteModal"style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a></td>
 --}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
<script type="text/javascript">
    $('.labor').DataTable({
        select: true,
        "order": [[0, "desc"]],
        "scrollY": "380px",
        "scrollCollapse": true,
        "paging": true,
        "bProcessing": true,
    });

</script>
{{-- <script type="text/javascript">
	alert('sadhdhjwd');
</script> --}}
</html>

