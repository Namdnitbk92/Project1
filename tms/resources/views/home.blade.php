@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body"> 
                    <table id="my-table" cellspacing="0" width="100%">
                        <thead>
                            <th>Col1</th> 
                            <th>Col2</th> 
                            <th>Col3</th> 
                            <th>Col4</th> 
                        </thead>
                        <tbody>
                            <tr>
                                <td>123</td>
                                <td>12</td>
                                <td>33</td>
                                <td>44</td>
                            </tr>
                            <tr>
                                <td>123</td>
                                <td>12</td>
                                <td>33</td>
                                <td>44</td>
                            </tr>
                            <tr>
                                <td>123</td>
                                <td>12</td>
                                <td>33</td>
                                <td>4455</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        app.useDataTable(['asd','sss','ttt'],[[12,23,44],[12,23,44],[12,23,44],[12,23,44]],{id : 'my-table'});   
</script>
@endsection
